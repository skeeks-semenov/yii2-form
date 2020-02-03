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
 * @property bool|callable  $multiple;
 * @property array|callable $items;
 *
 * Class BoolField
 * @package skeeks\yii2\form\fields
 */
class SelectField extends Field
{
    /**
     * @var bool
     */
    public $allowNull = true;

    /**
     * @var string
     */
    public $nullLabel = '--';

    /**
     * @var string
     */
    protected $_items;

    /**
     * @var
     */
    protected $_multiple = false;

    /**
     * @var array
     */
    public $elementOptions = [];

    /**
     * @return bool
     */
    public function getMultiple()
    {
        if (isset($this->_multiple)) {
            if ($this->_multiple instanceof Closure) {
                return (bool)call_user_func($this->_multiple, $this);
            }
            return $this->_multiple;
        }
        return false;

    }

    public function setMultiple($multiple)
    {
        $this->_multiple = $multiple;
    }

    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        $field = parent::getActiveField();

        if ($this->multiple) {
            $this->elementOptions['multiple'] = $this->multiple;
        }

        if (!$this->multiple && !isset($this->elementOptions['size'])) {
            $this->elementOptions['size'] = 1;
        }

        return $field->listBox($this->getItems(), $this->elementOptions);
    }
    /**
     * @return array
     */
    public function getItems()
    {
        $result = [];

        if ($this->allowNull) {
            $result = [
                null => $this->nullLabel,
            ];
        }

        if (isset($this->_items)) {
            
            $items = $this->_items;
            if ($this->_items instanceof \Closure) {
                $items = call_user_func($this->_items, $this);
            }
            
            $result = ArrayHelper::merge($result, (array)$items);
        }


        return $result;
    }

    /**
     * @param $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->_items = $items;
        return $this;
    }
}