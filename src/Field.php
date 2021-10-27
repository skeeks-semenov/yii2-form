<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form;

use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\base\ViewContextInterface;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

/**
 * @property ActiveField $activeField;
 *
 * @property string $attribute;
 * @property Model $model;
 * @property string $label;
 * @property string $value;
 *
 * Class BackendFormField
 * @package skeeks\cms\backend
 */
abstract class Field extends Element implements IField
{
    /**
     * @var Model
     */
    protected $_model;

    /**
     * @var string
     */
    protected $_attribute;

    /**
     * @var array
     */
    public $_options = [];

    /**
     * @var null|string|false
     */
    protected $_label = null;

    /**
     * @var
     */
    protected $_value;

    /**
     * @var array
     */
    public $labelOptions = [];

    /**
     * @var string|bool $content the hint content.
     */
    public $hint = null;
    /**
     * @var array
     */
    public $hintOptions = [];

    /**
     * @return string
     */
    public function render() {
        return  (string) $this->activeField;
    }

    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        if (!$this->_activeForm) {
            throw new InvalidConfigException('Not found form');
        }

        if (!$this->_model) {
            throw new InvalidConfigException('Not found model');
        }

        if (!$this->_attribute) {
            throw new InvalidConfigException('Not found attribute');
        }

        $activeField = $this->_activeForm->field($this->_model, $this->_attribute, $this->_options);

        if ($this->label !== null || $this->labelOptions) {
            $activeField->label($this->label, $this->labelOptions);
        }

        if ($this->hint !== null || $this->labelOptions) {
            $activeField->hint($this->hint, $this->hintOptions);
        }

        return $activeField;
    }

    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->_model = $model;
        return $this;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @param string $attribute
     * @return $this
     */
    public function setAttribute($attribute)
    {
        $this->_attribute = $attribute;
        return $this;
    }

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->_attribute;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options = [])
    {
        $this->_options = $options;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param string|array $label
     * @return $this
     */
    public function setLabel($label)
    {
        if (is_array($label)) {
            $this->_label = \Yii::t(
                ArrayHelper::getValue($label, 0),
                ArrayHelper::getValue($label, 1, ''),
                ArrayHelper::getValue($label, 2, []),
                ArrayHelper::getValue($label, 3)
            );
        } else if (is_string($label)) {
            $this->_label = $label;
        } else {
            $this->_label = $label;
        }
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->model->{$this->attribute};
    }
}