<div class="view">
<?php

$gravatar=$data->gravatar_id;
 $this->widget('ext.yii-gravatar.YiiGravatar', array(
    "email"=>"http://www.gravatar.com/avatar/$gravatar",
    'size'=>80,
    'defaultImage'=>'http://www.amsn-project.net/images/download-linux.png',
    'secure'=>false,
    'rating'=>'r',
    'emailHashed'=>false,
    'htmlOptions'=>array(
        'alt'=>'Gravatar image',
        'title'=>'Gravatar image',
    )
));
if ($data->like == '0')
echo '</br /><br />'.CHtml::button('Like',array('submit' => array('site/like', 'd2'=>$data->login, 'like_user'=>$data->id)));
else
echo '</br /><br />'.CHtml::button('Unlike',array('submit' => array('site/like', 'd2'=>$data->login, 'unlike_user'=>$data->id)));
?>
<div class="users">
<h1>
<?php
echo $data->fullname.'<br />';
?>
</h1>
<?php
echo $data->login.'<br />';
echo 'Company : '.$data->company.'<br />';
echo 'Blog : '.CHtml::link($data->blog, $data->blog).'<br />';
echo 'Followers : '.$data->followers.'<br />';
?>
</div>
</div>