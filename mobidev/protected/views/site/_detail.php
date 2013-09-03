<div class="index">
<?php
$con = Contributors::model()->findAll(
array("condition"=>"repo_name = '$data->name'")
);
echo '<h4>'.$con[0]['fullname'].'</h4><br />';
?>
<div class="description">
<?php
echo 'Description : '.$data->description.'<br />';
echo 'watchers : '.$data->watchers.'<br />';
echo 'forks : '.$data->forks.'<br />';
echo 'open_issues : '.$data->open_issues.'<br />';
echo 'homepage : '.CHtml::link($data->homepage, $data->homepage).'<br />';
echo 'GitHub repo : '.CHtml::link($data->url, $data->url).'<br />';
echo 'created at : '.$data->created;
?>
</div>
<div class="contributors_text">
<?php
echo '<h4>Contributors :</h4><br />';
?>
</div>
<div class="contributors">
<?php
foreach ($con as $k=>$v)
  {  
    echo CHtml::link($con[$k]->login, $con[$k]->html_url);    
    if ($con[$k]->like == '0')
      echo CHtml::button('Like',array('submit' => array('site/like', 'd1'=>$data->name, 'd2'=>$data->owner, 'like_detail'=>$con[$k]->id))).'<br />';
    else
      echo CHtml::button('Unlike',array('submit' => array('site/like', 'd1'=>$data->name, 'd2'=>$data->owner, 'unlike_detail'=>$con[$k]->id))).'<br />';
      ?>
      <div style="clear:both;"></div>
      <?php
  }
  ?>
 </div>
</div>