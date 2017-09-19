<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: peer/chaincode.proto

namespace Protos;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Carries the chaincode function and its arguments.
 * UnmarshalJSON in transaction.go converts the string-based REST/JSON input to
 * the []byte-based current ChaincodeInput structure.
 * </pre>
 *
 * Protobuf type <code>protos.ChaincodeInput</code>
 */
class ChaincodeInput extends \Google\Protobuf\Internal\Message
{
    /**
     * <code>repeated bytes args = 1;</code>
     */
    private $args;

    public function __construct() {
        \GPBMetadata\Peer\Chaincode::initOnce();
        parent::__construct();
    }

    /**
     * <code>repeated bytes args = 1;</code>
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * <code>repeated bytes args = 1;</code>
     */
    public function setArgs(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::BYTES);
        $this->args = $arr;
    }

}
