<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

//Common for all pages
require_once("model/DAL/Dal.php");
require_once("model/Person.php");
require_once("model/PersonList.php");
require_once("model/Item.php");
require_once("model/ItemList.php");
require_once("view/html/parent/PageParent.php");
require_once("view/html/parent/Index/Index.php");
require_once("view/html/parent/Index/BigWishList.php");
require_once("view/html/parent/Index/PersonWishList.php");
require_once("view/html/common/common.php");
require_once("controller/Master.php");

$index = new \View\Index();
$master = new \controller\Master($index);
$master->doApplication();



print_r ($_GET);
print_r ($_POST);
