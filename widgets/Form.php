<?php

namespace widgets;


use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


/**
 * Class Form
 * @package widgets
 *
 * @property Model $model
 * @property string $action
 * @property string $formId
 */
class Form extends Widget
{
    public $formId;
    public $model;
    public $action='';

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if (!is_object($this->model)) throw new InvalidConfigException(self::class.'::model = null');
        if ($this->formId === null) $this->formId = 'form-'.$this->id;
        $this->action = Url::to($this->action);
        ob_start();
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        $content = ob_get_clean();
        return ''
            .Html::beginForm(null, null, [
                'id' => $this->formId,
                'class' => 'js-form',
                'data-action' => $this->action,
            ])
                .$content
            .Html::endForm()
        .'';
    }

    /**
     * @param string $attr
     * @param string|boolean $validate
     * @return string
     */
    public function inputText($attr='', $validate=false)
    {
        if ($attr === '') return '';
        $id = Html::getInputId($this->model, $attr);
        return ''
            .Html::activeLabel($this->model, $attr, ['for' => $id])
            .Html::activeInput('text', $this->model, $attr, [
                'id' => $id,
                'data-validate' => $validate,
            ])
            .Html::tag('div', $this->model->getFirstError($attr), ['id' => $id.'-error'])
        .'';
    }

    /**
     * @param string $attr
     * @param string|boolean $validate
     * @return string
     */
    public function inputPassword($attr='', $validate=false)
    {
        if ($attr === '') return '';
        $id = Html::getInputId($this->model, $attr);
        return ''
            .Html::activeLabel($this->model, $attr, ['for' => $id])
            .Html::activePasswordInput($this->model, $attr, [
                'id' => $id,
                'data-validate' => $validate,
            ])
            .Html::tag('div', $this->model->getFirstError($attr), ['id' => $id.'-error'])
        .'';
    }

    public function textarea($attr='', $opt=[])
    {
        if ($attr === '') return '';
        $id = Html::getInputId($this->model, $attr);
        return ''
            .Html::activeLabel($this->model, $attr, ['for' => $id])
            .Html::activeTextarea($this->model, $attr, [
                'id' => $id,
                'data-validate' => false,
                'rows' => ArrayHelper::getValue($opt, 'rows', 3),
            ])
            .Html::tag('div', $this->model->getFirstError($attr), ['id' => $id.'-error'])
        .'';
    }

    /**
     * @param $attr
     * @return string
     */
    public function checkbox($attr='')
    {
        if ($attr === '') return '';
        $id = Html::getInputId($this->model, $attr);
        return ''
            .Html::beginTag('label', ['class' => 'checkbox'])
                .Html::activeCheckbox($this->model, $attr, ['label' => false, 'id' => $id])
                .Html::tag('span', '', ['class' => 'checkbox-style'])
                .Html::tag('span', $this->model->getAttributeLabel($attr), ['class' => 'checkbox-txt'])
            .Html::endTag('label')
            .Html::tag('div', $this->model->getFirstError($attr), ['id' => $id.'-error'])
        .'';
    }

    public function inputFile($attr='')
    {
        if ($attr === '') return '';
        $id = Html::getInputId($this->model, $attr);
        return ''
            .Html::beginTag('div', ['class' => 'row align-items-center'])
                .Html::beginTag('div', ['class' => 'col'])
                    .Html::activeLabel($this->model, $attr, ['class' => 'right'])
                .Html::endTag('div')
                .Html::beginTag('div', ['class' => 'col-auto'])
                    .Html::a('Прекрепить', null, ['class' => 'btn btn-blue'])
                .Html::endTag('div')
            .Html::endTag('div')
            .Html::tag('div', $this->model->getFirstError($attr), ['id' => $id.'-error'])
        .'';
    }

    /**
     * @param string $content
     * @param boolean $loader
     * @return string
     */
    public function submit($content='', $loader=true)
    {
        if ($content === '') return '';
        return Html::submitButton($content, [
            'class' => 'btn btn-blue',
            'data-loader' => $loader,
        ]);
    }

    /**
     * @param string $attr
     * @return string
     */
    public function error($attr='')
    {
        if ($attr === '') return '';
        $id = Html::getInputId($this->model, $attr);
        return Html::tag('div', $this->model->getFirstError($attr), ['id' => $id.'-error']);
    }

}