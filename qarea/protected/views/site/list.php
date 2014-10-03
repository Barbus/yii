<?php

$this->pageTitle = 'Список товаров';
$this->breadcrumbs = array(
    'Список товаров',
);

$this->pageTitle = Yii::app()->name;

$max = new CDbExpression("MAX(price) AS max_price");
$min = new CDbExpression("MIN(price) AS min_price");
$shop = new CDbExpression("COUNT(shop) AS shop_count");
$prices = new CDbExpression("price AS prices");
$titles = new CDbExpression("product.title AS titles");
$descriptions = new CDbExpression("product.description AS descriptions");
$ids = new CDbExpression("product.id AS ids");

$criteria = new CDbCriteria();
$criteria->with = array('product' => array('together' => true),);
$criteria->condition = "product.subcategory = $_GET[id]";

if (isset($_GET['min']))
    $criteria->addCondition("price >= $_GET[min]");

if (isset($_GET['max']))
    $criteria->addCondition("price <= $_GET[max]");

if (isset($_GET['man_id']))
    $criteria->addCondition("manufacturer = $_GET[man_id]");

if (isset($_GET['min']) && isset($_GET['man_id']))
    $criteria->addCondition("price >= $_GET[min] AND manufacturer = $_GET[man_id]");

if (isset($_GET['max']) && isset($_GET['man_id']))
    $criteria->addCondition("price <= $_GET[max] AND manufacturer = $_GET[man_id]");

$criteria->order = 'price';
$criteria->group = 'product.id';
$criteria->select = "$ids, $titles, $descriptions, $prices, $max, $min, $shop";

$this->widget('zii.widgets.CListView', array(
    'id' => 'gridUser',
    'itemView' => '_list',
    'dataProvider' => new CActiveDataProvider('Price', array(
        'criteria' => $criteria,
        'pagination' => array(
            'pageSize' => 2,
        ),
            )),
));
?>
