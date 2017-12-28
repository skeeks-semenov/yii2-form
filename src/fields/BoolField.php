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
 * Class BoolField
 * @package skeeks\yii2\form\fields
 */
class BoolField extends Field
{
    const ELEMENT_RADIO_LIST = 'radioList';
    const ELEMENT_CHECKBOX = 'checkbox';

    /**
     * @var string
     */
    public $formElement = self::ELEMENT_RADIO_LIST;

    /**
     * @var array
     */
    public $elementOptions = [];

    /**
     * @var int
     */
    public $trueValue = 1;

    /**
     * @var int
     */
    public $falseValue = 0;

    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        $field = parent::getActiveField();
        return $field->{$this->formElement}($this->getItems(), $this->elementOptions);
    }

    /**
     * @return array
     */
    public function getItems() {
        return [
            $this->trueValue => \Yii::$app->formatter->asBoolean(1),
            $this->falseValue => \Yii::$app->formatter->asBoolean(0)
        ];
    }
}