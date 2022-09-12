<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/dialogflow/v2/intent.proto

namespace Google\Cloud\Dialogflow\V2\Intent\Message;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Browse Carousel Card for Actions on Google.
 * https://developers.google.com/actions/assistant/responses#browsing_carousel
 *
 * Generated from protobuf message <code>google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard</code>
 */
class BrowseCarouselCard extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. List of items in the Browse Carousel Card. Minimum of two
     * items, maximum of ten.
     *
     * Generated from protobuf field <code>repeated .google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.BrowseCarouselCardItem items = 1;</code>
     */
    private $items;
    /**
     * Optional. Settings for displaying the image. Applies to every image in
     * [items][google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.items].
     *
     * Generated from protobuf field <code>.google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.ImageDisplayOptions image_display_options = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $image_display_options = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Cloud\Dialogflow\V2\Intent\Message\BrowseCarouselCard\BrowseCarouselCardItem>|\Google\Protobuf\Internal\RepeatedField $items
     *           Required. List of items in the Browse Carousel Card. Minimum of two
     *           items, maximum of ten.
     *     @type int $image_display_options
     *           Optional. Settings for displaying the image. Applies to every image in
     *           [items][google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.items].
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Dialogflow\V2\Intent::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. List of items in the Browse Carousel Card. Minimum of two
     * items, maximum of ten.
     *
     * Generated from protobuf field <code>repeated .google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.BrowseCarouselCardItem items = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Required. List of items in the Browse Carousel Card. Minimum of two
     * items, maximum of ten.
     *
     * Generated from protobuf field <code>repeated .google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.BrowseCarouselCardItem items = 1;</code>
     * @param array<\Google\Cloud\Dialogflow\V2\Intent\Message\BrowseCarouselCard\BrowseCarouselCardItem>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setItems($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Dialogflow\V2\Intent\Message\BrowseCarouselCard\BrowseCarouselCardItem::class);
        $this->items = $arr;

        return $this;
    }

    /**
     * Optional. Settings for displaying the image. Applies to every image in
     * [items][google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.items].
     *
     * Generated from protobuf field <code>.google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.ImageDisplayOptions image_display_options = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return int
     */
    public function getImageDisplayOptions()
    {
        return $this->image_display_options;
    }

    /**
     * Optional. Settings for displaying the image. Applies to every image in
     * [items][google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.items].
     *
     * Generated from protobuf field <code>.google.cloud.dialogflow.v2.Intent.Message.BrowseCarouselCard.ImageDisplayOptions image_display_options = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param int $var
     * @return $this
     */
    public function setImageDisplayOptions($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Dialogflow\V2\Intent\Message\BrowseCarouselCard\ImageDisplayOptions::class);
        $this->image_display_options = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BrowseCarouselCard::class, \Google\Cloud\Dialogflow\V2\Intent_Message_BrowseCarouselCard::class);
