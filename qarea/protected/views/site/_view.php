<?php
/* @var $this CategoryController */
/* @var $data Category */
?>
<div class="view">
    <h2>
        <?php
        $subcategory = Subcategory::model()->with('category')->findAll(
                array("condition" => "parent_category = $data->id")
        );
        echo $data->name;
        ?>
    </h2><br />
    <?php
    foreach ($subcategory as $k => $v)
        print CHtml::link(CHtml::encode($subcategory[$k]->name), array('list', 'id' => $subcategory[$k]->id)) . '   ';
    ?>
</div>