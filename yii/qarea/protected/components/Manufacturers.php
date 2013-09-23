<?php

Yii::import('zii.widgets.CPortlet');

class Manufacturers extends CPortlet {

    public $title = 'Производитель:';
    public $showOn = array();
    public $maxTags = 20;

    protected function renderContent() {
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;

        if (!in_array($controller . '/' . $action, $this->showOn)) {
            return;
        }

        $types = Manufacturer::model()->findAll();

        $this->render('manufacturers', array('types' => $types));
    }

}
