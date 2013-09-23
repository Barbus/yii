
<div class="index">
    <div class="name">
        <?php echo CHtml::link(CHtml::encode($data->name), array('detail', 'd1' => $data->name, 'd2' => $data->owner)) . '<br />'; ?>
    </div>
    <div class="description">
        <?php echo $data->description . '<br />'; ?>
    </div>
    <div class="watchers">
        <?php echo 'watchers : ' . $data->watchers; ?>
    </div>
    <div class="homepage">
        <?php echo CHtml::link($data->homepage, $data->homepage); ?>
    </div>
    <div class="owner">
        <?php echo CHtml::link(CHtml::encode($data->owner), array('user', 'owner' => $data->owner)); ?>
    </div>
    <div class="forks">
        <?php echo 'forks : ' . $data->forks; ?>
    </div>
    <div class="like">
        <?php
        if ($data->like == '0')
            echo CHtml::button('Like', array('submit' => array('site/like', 'like' => $data->id)));
        else
            echo CHtml::button('Unlike', array('submit' => array('site/like', 'unlike' => $data->id)));
        ?>
    </div>
    <div style="clear:both;">
    </div>
</div>