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
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

/**
 * @property ActiveField $activeField;
 * @property string $attribute;
 *
 * Class BackendFormField
 * @package skeeks\cms\backend
 */
class Field extends Component implements IField
{
    /**
     * @var ActiveForm
     */
    protected $_activeForm;

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
    public $label = null;
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
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        if (!$this->_activeForm || !$this->_model || !$this->_attribute) {
            throw new InvalidConfigException('Not found form or model or attribute');
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
     * @param ActiveForm $activeForm
     * @return $this
     */
    public function setActiveForm(ActiveForm $activeForm)
    {
        $this->_activeForm = $activeForm;
        return $this;
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
}