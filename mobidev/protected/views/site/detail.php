<?php

$this->widget('zii.widgets.CListView', array(
    'id' => 'gridUser',
    'itemView'=>'_detail',
    'dataProvider' => new CActiveDataProvider('Mobidev', array(
	     'criteria'=>array(
	      "condition"=>"name = '$_GET[d1]'",
    ),
            //'data'=>$model->name,
            //'pagination' => array(  
           //     'pageSize' => 50,  
           // ),
    )),
    //...... columns display list.....
));

?>
