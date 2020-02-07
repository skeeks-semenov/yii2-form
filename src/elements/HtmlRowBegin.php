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
use yii\helpers\Html;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class HtmlRowBegin extends HtmlBlock
{
    /**
     * @var array
     */
    public $elementOptions = [];

    /**
     * @var bool 
     */
    public $noGutters = false;
    
    public function init()
    {
        Html::addCssClass($this->elementOptions, "row");
        
        if ($this->noGutters) {
            Html::addCssClass($this->elementOptions, "no-gutters");
        }
        
        $this->content = Html::beginTag("div", $this->elementOptions);
    }
}