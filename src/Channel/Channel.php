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

namespace AmericanExpress\HyperledgerFabricClient\Channel;

use AmericanExpress\HyperledgerFabricClient\Chaincode\Chaincode;
use AmericanExpress\HyperledgerFabricClient\Chaincode\ChaincodeProposalProcessorInterface;
use AmericanExpress\HyperledgerFabricClient\Proposal\ResponseCollection;
use AmericanExpress\HyperledgerFabricClient\ProtoFactory\ChannelHeaderFactory;
use AmericanExpress\HyperledgerFabricClient\Transaction\TransactionOptions;
use Hyperledger\Fabric\Protos\Peer\ChaincodeHeaderExtension;
use Hyperledger\Fabric\Protos\Peer\ChaincodeID;
use Hyperledger\Fabric\Protos\Peer\ChaincodeProposalPayload;

final class Channel implements ChannelInterface, ChaincodeProposalProcessorInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ChannelProposalProcessorInterface
     */
    private $client;

    /**
     * @param string $name
     * @param ChannelProposalProcessorInterface $client
     */
    public function __construct(
        string $name,
        ChannelProposalProcessorInterface $client
    ) {
        $this->name = $name;
        $this->client = $client;
    }

    /**
     * @param TransactionOptions $request
     * @param ChaincodeID $chaincodeId
     * @param mixed[] $args
     * @return ResponseCollection
     */
    public function queryByChainCode(
        TransactionOptions $request,
        ChaincodeID $chaincodeId,
        array $args = []
    ): ResponseCollection {
        $chainCode = $this->getChaincode([
            'name' => $chaincodeId->getName(),
            'version' => $chaincodeId->getPath(),
            'path' => $chaincodeId->getVersion(),
        ]);

        $functionName = array_shift($args);
        $args[] = $request;

        return $chainCode->$functionName(...$args);
    }

    /**
     *
     * Returns a named Chaincode for a channel
     *
     * @param string | array $nameOrVersionedName
     * @return Chaincode
     */
    public function getChaincode($nameOrVersionedName): Chaincode
    {
        return new Chaincode($nameOrVersionedName, $this);
    }

    /**
     *
     * Envelopes a Chaincode function invocation from a Chaincode object
     *
     * @param ChaincodeProposalPayload $payload
     * @param ChaincodeHeaderExtension $extension
     * @param TransactionOptions|null $options
     * @return ResponseCollection
     */
    public function processChaincodeProposal(
        ChaincodeProposalPayload $payload,
        ChaincodeHeaderExtension $extension,
        TransactionOptions $options = null
    ): ResponseCollection {
        $channelHeader = ChannelHeaderFactory::create($this->name);
        $channelHeader->setExtension($extension->serializeToString());

        return $this->client->processChannelProposal($channelHeader, $payload->serializeToString(), $options);
    }
}