<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form;

/**
 * Interface IHasForm
 * @package skeeks\yii2\form
 */
interface IHasForm
{
    /**
     * @see Builder
     * @return array
     */
    public function builderFields();

    /**
     * @see Builder
     * @return array
     */
    public function builderModels();

    /**
     * @return string
     */
    //public function renderActiveForm();
}