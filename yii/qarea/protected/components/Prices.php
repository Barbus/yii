<?php

Yii::import('zii.widgets.CPortlet');

class Prices extends CPortlet {

    public $title = 'Минимальная цена, грн:';
    public $showOn = array();

    protected function renderContent() {
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;

        if (!in_array($controller . '/' . $action, $this->showOn)) {
            return;
        }

        foreach (range(0, 7000, 1000) as $value)
            $prices[] = $value;
        array_shift($prices);

        foreach ($prices as $k => $v) {
            if (isset($_GET['man_id']))
                echo CHtml::link($prices[$k], array('site/list', 'id' => $_GET['id'], 'min' => $prices[$k], 'man_id' => $_GET['man_id'])) . '   ';
            else
                echo CHtml::link($prices[$k], array('site/list', 'id' => $_GET['id'], 'min' => $prices[$k])) . '   ';
        }
    }

}

?>
