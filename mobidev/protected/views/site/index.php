<?php

$this->widget('zii.widgets.CListView', array(
    'id' => 'gridUser',
    'itemView' => '_view',
    'dataProvider' => new CActiveDataProvider('Mobidev', array(
        'pagination' => array(
            'pageSize' => 50,
        ),
            )),
));

$this->pageTitle = Yii::app()->name;
?>


