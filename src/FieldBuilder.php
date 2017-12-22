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
 * Class BackendFormField
 * @package skeeks\cms\backend
 */
class FieldBuilder extends Component
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
     * @var array|Field[]
     */
    protected $_fields = [];


    public function render()
    {
        $this->_initFields();

        if ($this->_fields) {
            foreach ($this->_fields as $field) {
                echo $field->activeField;
            }
        }
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
     * @param array $fields
     * @return $this
     */
    public function setFields($fields = [])
    {
        $this->_fields = $fields;
        return $this;
    }

    /**
     * @param array $fields
     * @throws InvalidConfigException
     */
    protected function _initFields()
    {
        if (!$this->_fields) {
            return $this;
        }

        $result = [];

        foreach ($this->_fields as $key => $field) {
            if ($field instanceof Field) {
                $result[] = $field;
            } elseif (is_string($field)) {
                $result[] = \Yii::createObject([
                    'class' => Field::class,
                    'attribute' => $field,
                    'model' => $this->_model,
                    'activeForm' => $this->_activeForm,
                ]);
            } elseif (is_array($field)) {

                $config = ArrayHelper::merge([
                    'class' => Field::class,
                    'attribute' => $key,
                    'model' => $this->_model,
                    'activeForm' => $this->_activeForm,
                ], $field);

                $result[] = \Yii::createObject($config);
            } else {
                throw new InvalidConfigException('!!!');
            }
        }

        $this->_fields = $result;
        return $this;
    }
}