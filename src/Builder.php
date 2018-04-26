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
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

/**
 * @property ActiveField $activeField;
 * @property Model       $model;
 * @property Model[]     $models;
 * @property Field[]     $fields;
 *
 * Class Builder
 * @package skeeks\cms\form
 */
class Builder extends Component
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


    public function init()
    {
        parent::init();

        $this->_initFields();
    }

    public function render()
    {
        if ($this->_fields) {
            foreach ($this->_fields as $field) {

                if ($field instanceof Element) {
                    if ($this->_activeForm) {
                        $field->activeForm = $this->_activeForm;
                    }

                    echo $field->run();
                }

            }
        }
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

            $config = [];

            if ($field instanceof Field) {
                $result[] = $field;
            } elseif ($field instanceof Element) {
                $result[] = $field;
            } elseif (is_array($field)) {

                $config = ArrayHelper::merge([
                    'class'      => TextField::class,
                    'builder'    => $this,
                    'attribute'  => $this->_getClearAttributeName($key),
                    'model'      => $this->_getModelByKey($key),
                    'activeForm' => $this->_activeForm,
                ], $field);
            } elseif (is_string($field) && is_string($key)) {
                $config = [
                    'class'      => $field,
                    'builder'    => $this,
                    'attribute'  => $this->_getClearAttributeName($key),
                    'model'      => $this->_getModelByKey($key),
                    'activeForm' => $this->_activeForm,
                ];
            } elseif (is_string($field) && is_int($key)) {
                $config = [
                    'class'      => TextField::class,
                    'builder'    => $this,
                    'attribute'  => $this->_getClearAttributeName($field),
                    'model'      => $this->_getModelByKey($field),
                    'activeForm' => $this->_activeForm,
                ];
            } else {
                throw new InvalidConfigException('!!!');
            }

            if ($config) {
                $className = ArrayHelper::getValue($config, 'class');
                if (!is_subclass_of($className, Field::class)) {
                    ArrayHelper::remove($config, 'model');
                    ArrayHelper::remove($config, 'attribute');
                }
                $result[] = \Yii::createObject($config);
            }


        }

        $this->_fields = $result;
        return $this;
    }

    protected function _getClearAttributeName($name)
    {
        if ($pos = strpos($name, '.')) {
            return substr($name, $pos + 1, strlen($name));
        } else {
            return $name;
        }
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
     * @param ActiveForm $activeForm
     * @return $this
     */
    public function setActiveForm(ActiveForm $activeForm = null)
    {
        $this->_activeForm = $activeForm;
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
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->_model = $model;
        return $this;
    }

    /**
     * @return Model[]
     */
    public function getModels()
    {
        return $this->_models;
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
     * @return array|Field[]
     */
    public function getFields()
    {
        return $this->_fields;
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
}