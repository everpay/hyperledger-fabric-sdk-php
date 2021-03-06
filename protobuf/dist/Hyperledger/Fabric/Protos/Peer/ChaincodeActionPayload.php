<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: peer/transaction.proto

namespace Hyperledger\Fabric\Protos\Peer;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * ChaincodeActionPayload is the message to be used for the TransactionAction's
 * payload when the Header's type is set to CHAINCODE.  It carries the
 * chaincodeProposalPayload and an endorsed action to apply to the ledger.
 *
 * Generated from protobuf message <code>protos.ChaincodeActionPayload</code>
 */
class ChaincodeActionPayload extends \Google\Protobuf\Internal\Message
{
    /**
     * This field contains the bytes of the ChaincodeProposalPayload message from
     * the original invocation (essentially the arguments) after the application
     * of the visibility function. The main visibility modes are "full" (the
     * entire ChaincodeProposalPayload message is included here), "hash" (only
     * the hash of the ChaincodeProposalPayload message is included) or
     * "nothing".  This field will be used to check the consistency of
     * ProposalResponsePayload.proposalHash.  For the CHAINCODE type,
     * ProposalResponsePayload.proposalHash is supposed to be H(ProposalHeader ||
     * f(ChaincodeProposalPayload)) where f is the visibility function.
     *
     * Generated from protobuf field <code>bytes chaincode_proposal_payload = 1;</code>
     */
    private $chaincode_proposal_payload = '';
    /**
     * The list of actions to apply to the ledger
     *
     * Generated from protobuf field <code>.protos.ChaincodeEndorsedAction action = 2;</code>
     */
    private $action = null;

    public function __construct() {
        \GPBMetadata\Peer\Transaction::initOnce();
        parent::__construct();
    }

    /**
     * This field contains the bytes of the ChaincodeProposalPayload message from
     * the original invocation (essentially the arguments) after the application
     * of the visibility function. The main visibility modes are "full" (the
     * entire ChaincodeProposalPayload message is included here), "hash" (only
     * the hash of the ChaincodeProposalPayload message is included) or
     * "nothing".  This field will be used to check the consistency of
     * ProposalResponsePayload.proposalHash.  For the CHAINCODE type,
     * ProposalResponsePayload.proposalHash is supposed to be H(ProposalHeader ||
     * f(ChaincodeProposalPayload)) where f is the visibility function.
     *
     * Generated from protobuf field <code>bytes chaincode_proposal_payload = 1;</code>
     * @return string
     */
    public function getChaincodeProposalPayload()
    {
        return $this->chaincode_proposal_payload;
    }

    /**
     * This field contains the bytes of the ChaincodeProposalPayload message from
     * the original invocation (essentially the arguments) after the application
     * of the visibility function. The main visibility modes are "full" (the
     * entire ChaincodeProposalPayload message is included here), "hash" (only
     * the hash of the ChaincodeProposalPayload message is included) or
     * "nothing".  This field will be used to check the consistency of
     * ProposalResponsePayload.proposalHash.  For the CHAINCODE type,
     * ProposalResponsePayload.proposalHash is supposed to be H(ProposalHeader ||
     * f(ChaincodeProposalPayload)) where f is the visibility function.
     *
     * Generated from protobuf field <code>bytes chaincode_proposal_payload = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setChaincodeProposalPayload($var)
    {
        GPBUtil::checkString($var, False);
        $this->chaincode_proposal_payload = $var;

        return $this;
    }

    /**
     * The list of actions to apply to the ledger
     *
     * Generated from protobuf field <code>.protos.ChaincodeEndorsedAction action = 2;</code>
     * @return \Hyperledger\Fabric\Protos\Peer\ChaincodeEndorsedAction
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * The list of actions to apply to the ledger
     *
     * Generated from protobuf field <code>.protos.ChaincodeEndorsedAction action = 2;</code>
     * @param \Hyperledger\Fabric\Protos\Peer\ChaincodeEndorsedAction $var
     * @return $this
     */
    public function setAction($var)
    {
        GPBUtil::checkMessage($var, \Hyperledger\Fabric\Protos\Peer\ChaincodeEndorsedAction::class);
        $this->action = $var;

        return $this;
    }

}

