<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form\fields;

use skeeks\yii2\form\Field;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class TextareaField extends Field
{
    /**
     * @var array
     */
    public $elementOptions = [];

    /**
     * @return \yii\widgets\ActiveField
     */
    public function getActiveField()
    {
        $field = parent::getActiveField();
        return $field->textarea($this->elementOptions);
    }
}