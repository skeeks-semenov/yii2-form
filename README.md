Yii2 form area for SkeekS CMS
===================================

Links
------
* [Web site](https://cms.skeeks.com)
* [Author](https://skeeks.com)


```php

<?php $form = \yii2\widgets\ActiveForm::begin(); ?>


<? echo (new \skeeks\yii2\form\Builder([
    'model'      => $model,
    'activeForm' => $form,
    'fields'     => [
            
    ],
]))->render(); ?>
    
<?php \yii2\widgets\ActiveForm::end(); ?>

```
___

> [![skeeks!](https://skeeks.com/img/logo/logo-no-title-80px.png)](https://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](https://skeeks.com) | [cms.skeeks.com](https://cms.skeeks.com)



