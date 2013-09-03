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


/*

  $this->widget('zii.widgets.grid.CGridView', array(  
        'id' => 'itemGrid',  
        'dataProvider' => $itemsProvider,  
        'enablePagination' => true,
        
        'columns' => array(  
            array(  
                'name' => 'Name',  
                'value' => '$data["name"]',  
                'sortable' => true,  
                'filter' => false,  
            ),
            array(  
                'name' => 'Owner',  
                'value' => 'CHtml::link(CHtml::encode($data["owner"]))'  
            ), 
            array(  
                'name' => 'Description',  
                'value' => '$data["description"]'  
            ),
            array( 'class'=>'CLinkColumn',
                        'header'=>'Homepage',
                        'labelExpression'=>'$data->homepage',
                        //'urlExpression'=>'Yii::app()->createUrl("",array("homepage"=>$data->homepage))',
                        //'linkHtmlOptions'=>array('title'=>'homepage')
                        ),
            array(  
                'name' => 'Watchers',  
                'value' => '$data["watchers"]'  
            ),
            array(  
                'name' => 'Forks',  
                'value' => '$data["forks"]'  
            ),            
          //  array(
	//	'class'=>'CButtonColumn',
	//	'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
	//),
        )  
    ));  
*/


$this->pageTitle=Yii::app()->name;
?>


