<?php
session_start();

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
assert_options(ASSERT_ACTIVE, 0);
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
require_once('model/DALAuthentication.php');
require_once('model/userModel.php');
//required exceptions
require_once('exception/ExceptionDALAuthentication.php');
require_once('exception/FailedLoginWithoutAnyEnteredFieldsException.php');
require_once('exception/FailedLoginWithOnlyUserNameException.php');
require_once('exception/FailedLoginWithOnlyPasswordException.php');
require_once('exception/FailedLoginWithWrongPassWordButExistingUserNameException.php');

//CREATE OBJECTS OF THE MODELS
$timeStamp = new \model\DateTimeModel();
$loginModel = new \model\LoginModel();
$smartQuestionsModel = new \model\SmartQuestionsModel();
$dalauthenticationModel = new \model\DALAuthentication();

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
                                        $smartQuestionsModel,
                                        $dalauthenticationModel
                                    );

$doAuth->tryAuth();

$layoutView->render($loginModel->getIsAuthenticated(), $loginView, $dateTimeView);


var_dump($_SESSION);

//TODO > START
assert
(
    false,
    "Not Yet implemented! " .
    "//TODO " .
    "?" .
    " in the Class: ".  __CLASS__ . " and the line " .  __LINE__
);
//TODO < END
