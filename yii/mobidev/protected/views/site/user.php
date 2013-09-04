<?php
$this->pageTitle=Yii::app()->name;
$this->widget('zii.widgets.CListView', array(
    'id' => 'gridUser',
    'itemView'=>'_user',
    'dataProvider' => new CActiveDataProvider('Users', array(
            'criteria'=>array(
	    "condition"=>"login = '$_GET[owner]'",        
    ),
           // 'pagination' => array(  
           //     'pageSize' => 2,  
           // ),
    )),
    //...... columns display list.....
));
?>
