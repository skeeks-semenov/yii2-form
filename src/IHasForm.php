<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\form;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
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
     * TODO: подумать.
     * @return string
     */
    //public function renderActiveForm();
}