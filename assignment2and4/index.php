<?php

//INCLUDE THE FILES NEEDED...
//views
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
//models
require_once('model/DateTimeModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE MODELS
$timeStamp = new \model\DateTimeModel();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView($timeStamp);
$lv = new LayoutView();



$lv->render(false, $v, $dtv);



////Tmp test here...
//var_dump(new \model\DateTimeModel());