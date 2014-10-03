<div class="view">
    <h2>
        <?php
        echo CHtml::link(CHtml::encode($data->titles), array('detail', 'id' => $_GET['id'], 'product_id' => $data->ids));
        ?>
    </h2>
    <h4>
        <?php
        $color = "red";
        echo "<p><font color=$color>$data->prices  грн</font>" . '   по ценам ' . $data->min_price . ' ... ' . $data->max_price . ' грн, в ' . $data->shop_count . ' магазинах<br />';
        ?>
    </h4>
    <?php echo $data->descriptions; ?>
</div>


