<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/dialogflow/v2/intent.proto

namespace Google\Cloud\Dialogflow\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The response message for [Intents.BatchUpdateIntents][google.cloud.dialogflow.v2.Intents.BatchUpdateIntents].
 *
 * Generated from protobuf message <code>google.cloud.dialogflow.v2.BatchUpdateIntentsResponse</code>
 */
class BatchUpdateIntentsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * The collection of updated or created intents.
     *
     * Generated from protobuf field <code>repeated .google.cloud.dialogflow.v2.Intent intents = 1;</code>
     */
    private $intents;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Cloud\Dialogflow\V2\Intent>|\Google\Protobuf\Internal\RepeatedField $intents
     *           The collection of updated or created intents.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Dialogflow\V2\Intent::initOnce();
        parent::__construct($data);
    }

    /**
     * The collection of updated or created intents.
     *
     * Generated from protobuf field <code>repeated .google.cloud.dialogflow.v2.Intent intents = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getIntents()
    {
        return $this->intents;
    }

    /**
     * The collection of updated or created intents.
     *
     * Generated from protobuf field <code>repeated .google.cloud.dialogflow.v2.Intent intents = 1;</code>
     * @param array<\Google\Cloud\Dialogflow\V2\Intent>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setIntents($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Dialogflow\V2\Intent::class);
        $this->intents = $arr;

        return $this;
    }

}

