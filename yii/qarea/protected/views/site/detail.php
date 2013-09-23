<?php
$this->pageTitle = 'Детали товара';
$this->breadcrumbs = array(
    'Детали товара',
);

$color = "red";

$query = Yii::app()->db->createCommand()
        ->select('product.title, product.description, price.price, shop.name, max(price.price) AS max_price, min(price.price) AS min_price, count(price.id) AS price_count, count(shop.id) AS shop_count, avg(price.price) AS avg_price')
        ->from('price')
        ->leftJoin('product', 'price.product = product.id')
        ->leftJoin('shop', 'price.shop = shop.id')
        ->where("price.product=$_GET[product_id]")
        ->queryAll();

$query2 = Yii::app()->db->createCommand()
        ->select('price.price, product.description, shop.name')
        ->from('price')
        ->leftJoin('product', 'price.product = product.id')
        ->leftJoin('shop', 'price.shop = shop.id')
        ->where("price.product=$_GET[product_id]")
        ->queryAll();
?>

<div class="detail">
    <div class="detail_left">
        <h3>
            <?php echo $query[0]['title']; ?>
        </h3><br />
        <?php echo $query[0]['description']; ?>	
    </div>
    <div class="detail_center">
        <?php
        echo "Средняя цена:<br /><p><font color=$color>" . round($query[0]['avg_price']) . "  грн</font><br />";
        echo 'от <b>' . $query[0]['min_price'] . '</b> до <b>' . $query[0]['max_price'] . '</b> грн';
        ?>
    </div>
    <div class="detail_right">
        <?php
        echo 'Всего <b>' . $query[0]['price_count'] . '</b> предложений в <b>' . $query[0]['shop_count'] . '</b> магазинах<br />';
        foreach ($query2 as $k => $v) {
            echo '<b>' . $query2[$k]['price'] . '</b>  грн  ' . $query2[$k]['name'] . '<br />';
        }
        ?>
    </div>
</div>