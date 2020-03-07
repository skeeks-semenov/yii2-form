<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form\fields;

use skeeks\cms\backend\widgets\forms\NumberInputWidget;
use skeeks\yii2\form\Field;
use yii\helpers\ArrayHelper;

/**
 * Class TextField
 * @package skeeks\yii2\form\fields
 */
class NumberField extends Field
{
    /**
     * @var array
     */
    public $elementOptions = [];

    /**
     * @var int
     */
    public $step = 1;

    /**
     * @var bool 
     */
    public $append = false;

    /**
     * @var bool 
     */
    public $prepend = false;

    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        $field = parent::getActiveField();

        $this->elementOptions = ArrayHelper::merge([
            'type' => 'number',
            'step' => $this->step,
        ], (array)$this->elementOptions);

        $widgetConfig = [
            "options" => $this->elementOptions,
            "append" => $this->append,
            "prepend" => $this->prepend,
        ];
        
        return $field->widget(NumberInputWidget::class, $widgetConfig);
    }
}