<?php

Yii::import('zii.widgets.CPortlet');

class SearchBlock extends CPortlet {

    protected function renderContent() {
        echo CHtml::beginForm(array('site/index'), 'get', array('style' => 'inline')) .
        CHtml::textField('q', '', array('placeholder' => 'search...', 'class' => 'search')) .
        CHtml::endForm('');
    }

}