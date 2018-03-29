<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\form\traits;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
trait THasForm
{
    public function builderFields()
    {
        return [];
    }

    public function builderModels()
    {
        return [];
    }
}