<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form;

use yii\base\Model;
use yii\widgets\ActiveForm;

/**
 * Interface IField
 * @package skeeks\yii2\form
 */
interface IField
{
    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField();

    /**
     * @param ActiveForm $activeForm
     * @return $this
     */
    public function setActiveForm(ActiveForm $activeForm);

    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model);

    /**
     * @param string $attribute
     * @return $this
     */
    public function setAttribute($attribute);

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options = []);
}