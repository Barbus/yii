<?php

/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
$this->widget('zii.widgets.CListView', array(
    'id' => 'gridUser',
    'itemView' => '_view',
    'dataProvider' => new CActiveDataProvider('Category', array(
        'pagination' => array(
            'pageSize' => 50,
        ),
            )),
));
?>

