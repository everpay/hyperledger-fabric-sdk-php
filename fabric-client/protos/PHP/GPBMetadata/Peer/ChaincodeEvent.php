<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: peer/chaincode_event.proto

namespace GPBMetadata\Peer;

class ChaincodeEvent
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(hex2bin(
            "0af0010a1a706565722f636861696e636f64655f6576656e742e70726f74" .
            "6f120670726f746f73225a0a0e436861696e636f64654576656e7412140a" .
            "0c636861696e636f64655f6964180120012809120d0a0574785f69641802" .
            "2001280912120a0a6576656e745f6e616d65180320012809120f0a077061" .
            "796c6f616418042001280c42660a226f72672e68797065726c6564676572" .
            "2e6661627269632e70726f746f732e706565724215436861696e636f6465" .
            "4576656e745061636b6167655a296769746875622e636f6d2f6879706572" .
            "6c65646765722f6661627269632f70726f746f732f70656572620670726f" .
            "746f33"
        ));

        static::$is_initialized = true;
    }
}
