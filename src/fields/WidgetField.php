<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form\fields;

use skeeks\yii2\form\Field;

/**
 * Class WidgetField
 * @package skeeks\yii2\form\fields
 */
class WidgetField extends Field
{
    /**
     * @var string
     */
    public $widgetClass;

    /**
     * @var array
     */
    public $widgetConfig = [];

    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        $field = parent::getActiveField();
        return $field->widget($this->widgetClass, $this->widgetConfig);
    }
}