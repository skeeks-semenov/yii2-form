<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */
/* @var $this yii\web\View */
/* @var $fieldSetElement \skeeks\yii2\form\fields\FieldSet */
$fieldSet = $fieldSetElement->activeForm->fieldSet($fieldSetElement->name);
echo $builder->render();
$fieldSet::end();