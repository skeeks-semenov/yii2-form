<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form;

use yii\widgets\ActiveForm;

/**
 * Interface IElement
 * @package skeeks\yii2\form
 */
interface IElement
{
    /**
     * @return string
     */
    public function render();

    /**
     * @param ActiveForm $activeForm
     * @return $this
     */
    public function setActiveForm(ActiveForm $activeForm);

    /**
     * @return ActiveForm
     */
    public function getActiveForm();

    /**
     * @param Builder $builder
     * @return $this
     */
    public function setBuilder(Builder $builder);

    /**
     * @return Builder
     */
    public function getBuilder();
}