<?php
/**
 * Created by IntelliJ IDEA.
 * User: sergey
 * Date: 14.08.17
 * Time: 10:00
 */

//echo "test";
//exit;

include_once ($_SERVER['DOCUMENT_ROOT'] . '/nad/Model.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/nad/view/View.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/nad/Controller.php');

//include_once($_SERVER['DOCUMENT_ROOT'] . '/nad/index.php');
//include_once($_SERVER['DOCUMENT_ROOT'] . '/pas/html/index.php');
//include_once($_SERVER['DOCUMENT_ROOT'] . '/sendmail/sendmail.php');

/*spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});*/

//$welcome = new NAD();
//$HTML = new HTML();
//$sendmail = new sendmail();

error_reporting(0); // Turn off error reporting
//error_reporting(E_ALL); // Report all errors

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

$view->htmlIndex();