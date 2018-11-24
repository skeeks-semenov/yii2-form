<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\form\elements;

use skeeks\yii2\form\Element;
use skeeks\yii2\form\fields\HtmlBlock;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class HtmlRowEnd extends HtmlBlock
{
    public function init()
    {
        $this->content = "</div>";
    }
}