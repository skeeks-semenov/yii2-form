<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form\fields;

use skeeks\cms\forms\IActiveFormHasFieldSets;
use skeeks\yii2\form\Builder;
use skeeks\yii2\form\Field;

/**
 * Class FieldSetField
 * @package skeeks\yii2\form\fields
 */
class FieldSet extends Field
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $fields = [];

    /**
     * @return \yii\widgets\ActiveField
     */
    public function render()
    {
        if (!$this->name) {
            $this->name = $this->attribute;
        }

        //$builder = clone $this->builder;

        $builder = new Builder([
            'model'      => $this->model,
            'models'     => $this->builder->models,
            'fields'     => $this->fields,
            'activeForm' => $this->activeForm,
        ]);

        if ($this->activeForm instanceof IActiveFormHasFieldSets) {

            return \Yii::$app->view->render('@skeeks/yii2/form/views/field-set', [
                'builder' => $builder,
                'fieldSetElement' => $this
            ]);
        } else {
            //TODO: depricated
            echo $this->activeForm->fieldSet($this->name);
             $builder = new Builder([
                'model'      => $this->model,
                'models'     => $this->builder->models,
                'fields'     => $this->fields,
                'activeForm' => $this->activeForm,
            ]);
            echo $builder->render();
            echo $this->activeForm->fieldSetEnd();
        }

    }
}