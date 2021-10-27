<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright 2010 SkeekS
 * @date 06.03.2017
 */

namespace skeeks\yii2\form;

use skeeks\cms\backend\events\ViewRenderEvent;
use yii\base\Component;
use yii\widgets\ActiveForm;

/**
 * @property Builder    $builder;
 * @property ActiveForm $activeForm;
 * @property string     $id;
 *
 * Class Element
 * @package skeeks\cms\form
 */
class Element extends Component implements IElement
{
    const EVENT_BEFORE_RENDER = 'beforeRender';
    const EVENT_AFTER_RENDER = 'afterRender';
    /**
     * @var int a counter used to generate [[id]] for widgets.
     * @internal
     */
    public static $counter = 0;
    /**
     * @var string the prefix to the automatically generated widget IDs.
     * @see getId()
     */
    public static $autoIdPrefix = 'fe';
    /**
     * @var Builder
     */
    public $_builder;
    /**
     * @var ActiveForm
     */
    protected $_activeForm;
    private $_id;
    /**
     * @return string
     */
    public function run()
    {
        $e = new ViewRenderEvent();
        $this->trigger(self::EVENT_BEFORE_RENDER, $e);

        $result = '';
        if ($e->content) {
            $result .= $e->content;
        }

        if ($e->isRenderContent) {
            try {
                $result .= $this->render();
            } catch (\Exception $exception) {
                $result .= $exception->getMessage();
            }
        }

        $e = new ViewRenderEvent();
        $this->trigger(self::EVENT_AFTER_RENDER, $e);

        if ($e->content) {
            $result .= $e->content;
        }

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
    /**
     * Returns the ID of the widget.
     * @param bool $autoGenerate whether to generate an ID if it is not set previously
     * @return string ID of the widget.
     */
    public function getId($autoGenerate = true)
    {
        if ($autoGenerate && $this->_id === null) {
            $this->_id = static::$autoIdPrefix.static::$counter++;
        }

        return $this->_id;
    }


    /**
     * Sets the ID of the widget.
     * @param string $value id of the widget.
     */
    public function setId($value)
    {
        $this->_id = $value;
    }
}