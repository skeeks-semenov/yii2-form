<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form;

use skeeks\yii2\form\fields\TextField;
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
class FormFieldsBuilder extends Component
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
     * @var Model[]
     */
    protected $_models;

    /**
     * @var array|Field[]
     */
    protected $_fields = [];


    public function render()
    {
        $this->_initFields();

        if ($this->_fields) {
            foreach ($this->_fields as $field) {
                echo $field->render();
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
     * @param Model[] $models
     * @return $this
     */
    public function setModels($models = [])
    {
        $this->_models = $models;
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
     * @param string $key
     * @return mixed|Model
     * @throws InvalidConfigException
     */
    protected function _getAdditionalModel($key)
    {
        $model = null;

        if (!$this->_models) {
            throw new InvalidConfigException('!!!');
        }

        $model = ArrayHelper::getValue($this->_models, $key);

        if (!$model) {
            throw new InvalidConfigException('!!!');
        }

        return $model;
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
            } elseif (is_array($field)) {

                $config = ArrayHelper::merge([
                    'class' => TextField::class,
                    'attribute' => $this->_getClearAttributeName($key),
                    'model' => $this->_getModelByKey($key),
                    'activeForm' => $this->_activeForm,
                ], $field);

                $result[] = \Yii::createObject($config);
            } elseif (is_string($field) && is_string($key)) {
                $result[] = \Yii::createObject([
                    'class' => $field,
                    'attribute' => $this->_getClearAttributeName($key),
                    'model' => $this->_getModelByKey($key),
                    'activeForm' => $this->_activeForm,
                ]);
            } elseif (is_string($field) && is_int($key)) {
                $result[] = \Yii::createObject([
                    'class' => TextField::class,
                    'attribute' => $this->_getClearAttributeName($field),
                    'model' => $this->_getModelByKey($field),
                    'activeForm' => $this->_activeForm,
                ]);
            } else {
                throw new InvalidConfigException('!!!');
            }
        }

        $this->_fields = $result;
        return $this;
    }

    /**
     * @param $key
     * @return mixed|Model
     */
    protected function _getModelByKey($key)
    {
        if ($pos = strpos($key, '.')) {
            $modelName = substr($key, 0, $pos);
            return $this->_getAdditionalModel($modelName);
        } else {
            return $this->_model;
        }
    }


    protected function _getClearAttributeName($name)
    {
        if ($pos = strpos($name, '.')) {
            return substr($name, $pos + 1, strlen($name));
        } else {
            return $name;
        }
    }


}