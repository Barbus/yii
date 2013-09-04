<?php
/* @var $this SiteController */

$this->widget('zii.widgets.CListView', array(
    'id' => 'gridUser',
    'itemView'=>'_view',
    'dataProvider' => new CActiveDataProvider('Mobidev', array(
            //'data'=>$model->name,
            'pagination' => array(  
                'pageSize' => 50,  
            ),
    )),
    //...... columns display list.....
));

$this->pageTitle=Yii::app()->name;
?>


