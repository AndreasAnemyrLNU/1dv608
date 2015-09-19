<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//required controllers
require_once('controller/doAuth.php');
//required views
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/SmartQuestionsView.php');
//required models
require_once('model/DateTimeModel.php');
require_once('model/LoginModel.php');
require_once('model/SmartQuestionsModel.php');

//CREATE OBJECTS OF THE MODELS
$timeStamp = new \model\DateTimeModel();
$loginModel = new \model\LoginModel();
$smartQuestionsModel = new \model\SmartQuestionsModel();

//CREATE OBJECTS OF THE VIEWS
$loginView = new \view\LoginView($loginModel);
$dateTimeView = new \view\DateTimeView($timeStamp);
$layoutView = new \view\LayoutView();
$smartQuestionsView = new \view\SmartQuestionsView($smartQuestionsModel);

//CREATE OBJECTS OF THE CONTROLLERS
$doAuth = new \controller\doAuth
                                    (
                                        $loginView,
                                        $loginModel,
                                        $smartQuestionsView,
                                        $smartQuestionsModel
                                    );

$doAuth->tryAuth();

$layoutView->render(false, $loginView, $dateTimeView);

var_dump($_POST);