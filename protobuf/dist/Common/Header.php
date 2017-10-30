<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/common.proto

namespace Common;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Protobuf type <code>common.Header</code>
 */
class Header extends \Google\Protobuf\Internal\Message
{
    /**
     * <code>bytes channel_header = 1;</code>
     */
    private $channel_header = '';
    /**
     * <code>bytes signature_header = 2;</code>
     */
    private $signature_header = '';

    public function __construct() {
        \GPBMetadata\Common\Common::initOnce();
        parent::__construct();
    }

    /**
     * <code>bytes channel_header = 1;</code>
     */
    public function getChannelHeader()
    {
        return $this->channel_header;
    }

    /**
     * <code>bytes channel_header = 1;</code>
     */
    public function setChannelHeader($var)
    {
        GPBUtil::checkString($var, False);
        $this->channel_header = $var;
    }

    /**
     * <code>bytes signature_header = 2;</code>
     */
    public function getSignatureHeader()
    {
        return $this->signature_header;
    }

    /**
     * <code>bytes signature_header = 2;</code>
     */
    public function setSignatureHeader($var)
    {
        GPBUtil::checkString($var, False);
        $this->signature_header = $var;
    }

}
