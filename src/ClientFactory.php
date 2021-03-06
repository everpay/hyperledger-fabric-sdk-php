<?php

/**
 * Copyright 2017 American Express Travel Related Services Company, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
 * or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

declare(strict_types=1);

namespace AmericanExpress\HyperledgerFabricClient;

use AmericanExpress\HyperledgerFabricClient\Channel\ChannelFactory;
use AmericanExpress\HyperledgerFabricClient\Config\ClientConfigInterface;
use AmericanExpress\HyperledgerFabricClient\EndorserClient\EndorserClientManager;
use AmericanExpress\HyperledgerFabricClient\Exception\InvalidArgumentException;
use AmericanExpress\HyperledgerFabricClient\Exception\UnexpectedValueException;
use AmericanExpress\HyperledgerFabricClient\Header\HeaderGenerator;
use AmericanExpress\HyperledgerFabricClient\Nonce\RandomBytesNonceGenerator;
use AmericanExpress\HyperledgerFabricClient\Peer\PeerFactory;
use AmericanExpress\HyperledgerFabricClient\Signatory\MdanterEccSignatory;
use AmericanExpress\HyperledgerFabricClient\Transaction\TransactionIdentifierGenerator;
use AmericanExpress\HyperledgerFabricClient\User\UserContextFactory;

/**
 * Factory class that simplifies the creation of a `Client` instance
 *
 * #### Example Usage
 *
 * ```php
 * $config = ClientConfigFactory::fromFile(new \SplFileObject('config.php'));
 * $client = ClientFactory::fromConfig($config);
 * ```
 */
class ClientFactory
{
    /**
     *
     * Factory method that instantiates a `Client` object from an instance of `ClientConfigurationInterface`
     *
     * The `$organization` parameter can be optionally provided to select the desired organization, if the configuration
     * includes multiple organizations
     *
     * @param ClientConfigInterface $config
     * @param string|null $organization
     * @return Client
     * @throws InvalidArgumentException
     */
    public static function fromConfig(
        ClientConfigInterface $config,
        string $organization = null
    ): Client {
        try {
            $user = UserContextFactory::fromConfig($config, $organization);
        } catch (UnexpectedValueException $e) {
            throw new InvalidArgumentException('Could not create Client; invalid organization config');
        }

        $signatory = new MdanterEccSignatory($config->getHashAlgorithm());

        try {
            $nonceGenerator = new RandomBytesNonceGenerator($config->getNonceSize());
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException('Could not create Client; invalid nonce size', 0, $e);
        }

        $transactionContextFactory = new TransactionIdentifierGenerator($nonceGenerator, $config->getHashAlgorithm());

        $headerGenerator = new HeaderGenerator($transactionContextFactory, $config->getEpoch());

        $endorserClients = new EndorserClientManager();

        $peerFactory = new PeerFactory($endorserClients);

        $channelFactory = new ChannelFactory($headerGenerator, $peerFactory);

        return new Client($user, $signatory, $channelFactory);
    }
}
