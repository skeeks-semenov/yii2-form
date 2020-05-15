<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form\fields;

use skeeks\yii2\form\Field;
use yii\helpers\ArrayHelper;

/**
 * Class BoolField
 * @package skeeks\yii2\form\fields
 */
class BoolField extends Field
{
    const ELEMENT_RADIO_LIST = 'radioList';
    const ELEMENT_CHECKBOX = 'checkbox';
    const ELEMENT_LISTBOX = 'listBox';

    /**
     * @var string
     */
    public $formElement = self::ELEMENT_CHECKBOX;

    /**
     * @var array
     */
    public $elementOptions = [];

    /**
     * @var int
     */
    public $trueValue = 1;

    /**
     * @var string
     */
    public $trueLabel;

    /**
     * @var int
     */
    public $falseValue = 0;

    /**
     * @var string
     */
    public $falseLabel;


    public $nullLabel = '--';

    /**
     * @var bool
     */
    public $allowNull = true;

    public function init()
    {
        parent::init();

        if (!$this->trueLabel) {
            $this->trueLabel = \Yii::$app->formatter->asBoolean(1);
        }

        if (!$this->falseLabel) {
            $this->falseLabel = \Yii::$app->formatter->asBoolean(0);
        }
    }
    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        $field = parent::getActiveField();

        if ($this->allowNull) {
            $this->formElement = self::ELEMENT_LISTBOX;
            $this->elementOptions['size'] = 1;
        }
        
        if ($this->formElement === self::ELEMENT_CHECKBOX) {
            return $field->{$this->formElement}($this->elementOptions, false);
            /*$items = [
                $this->trueValue => ''
            ];
            return $field->checkboxList($items, $this->elementOptions);*/
        } else {
            return $field->{$this->formElement}($this->getItems(), $this->elementOptions);
        }

        
    }

    /**
     * @return array
     */
    public function getItems()
    {
        $result = [];

        if ($this->allowNull) {
            $result = [
                null => $this->nullLabel
            ];
        }

        $result = ArrayHelper::merge($result, [
            $this->trueValue  => $this->trueLabel,
            $this->falseValue => $this->falseLabel,
        ]);

        return $result;
    }
}