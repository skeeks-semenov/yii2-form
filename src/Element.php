<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form;

use yii\base\Component;
use yii\widgets\ActiveForm;

/**
 * @property Builder    $builder;
 * @property ActiveForm $activeForm;
 *
 * Class Element
 * @package skeeks\cms\form
 */
class Element extends Component implements IElement
{
    const EVENT_BEFORE_RENDER = 'beforeRender';
    const EVENT_AFTER_RENDER = 'afterRender';

    /**
     * @var Builder
     */
    public $_builder;

    /**
     * @var ActiveForm
     */
    protected $_activeForm;

    /**
     * @return string
     */
    public function run()
    {
        $this->trigger(self::EVENT_BEFORE_RENDER);
        $result = $this->render();
        $this->trigger(self::EVENT_AFTER_RENDER);
        return $result;
    }

    /**
     * @return string
     */
    public function render()
    {
        return (string)'';
    }

    /**
     * @return ActiveForm
     */
    public function getActiveForm()
    {
        return $this->_activeForm;
    }
    /**
     * @param ActiveForm $activeForm
     * @return $this
     */
    public function setActiveForm(ActiveForm $activeForm = null)
    {
        $this->_activeForm = $activeForm;
        return $this;
    }
    /**
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->_builder;
    }
    /**
     * @param Builder $formBuilder
     * @return $this
     */
    public function setBuilder(Builder $builder)
    {
        $this->_builder = $builder;
        return $this;
    }

}