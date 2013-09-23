<ul>
    <?php
    foreach ($types as $type)
        echo '<li>' . CHtml::link($type->name, array('site/list', 'id' => $_GET['id'], 'man_id' => $type->id)) . '</li>';
    ?>
</ul> 
