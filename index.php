<?php

//This turns on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    //echo '<h1>Welcome to My Diner!</h1>';
    $view = new Template();
    echo $view->render('views/home.html');
}
);

//breakfast route
$f3->route('GET /breakfast', function() {
//    echo '<h1>Breakfast Menu</h1>';
    $view = new Template();
    echo $view->render('views/menus/breakfast.html');
}
);

//lunch route
$f3->route('GET /lunch', function() {
//    echo '<h1>Lunch</h1>';
    $view = new Template();
    echo $view->render('views/menus/lunch.html');
}
);

//dinner route
$f3->route('GET /dinner', function() {
//    echo '<h1>Dinner</h1>';
    $view = new Template();
    echo $view->render('views/menus/dinner.html');
}
);

//Happy Hour route
$f3->route('GET /happy-hour', function() {
//    echo '<h1>Happy Hour</h1>';
    $view = new Template();
    echo $view->render('views/menus/happy-hour.html');
}
);

//route to orderform1
$f3->route('GET|POST /orderform1', function($f3) {

    //if the form has been posted...
    //Auto-global arrays: $_SERVER, $_POST, $_GET, $_SESSION, etc.
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        //Get the data
        //This is a test to see if it's working
        //Array ( [food] => oatmeal [meal] => breakfast )
        //print_r($_POST);
        $food = $_POST['food'];
        $meal = $_POST['meal'];
        echo "For " . $meal . " I am going to have " . $food;

        //Validate the data

        //Store the data in the session array
        //$_SESSION['food'] = $food; (This is the php way to store a variable in a $_SESSION array)
        $f3->set('SESSION.food', $food); //fatFree way to store a variable to a $_SESSION array
        $f3->set('SESSION.meal', $meal);
        //Redirect to orderform2 route
        $f3->reroute('orderform2');
    }

    ///else go to view...
    $view = new Template();
    echo $view->render('views/orderforms/orderform1.html');
}
);

//route to orderform2
$f3->route('GET|POST /orderform2', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //print_r($_POST);
        //Get data
        $conds = implode(", ", $_POST['conds']); //implode converts the array into a comma delimited string

        //assign data to a session array
        $f3->set('SESSION.conds', $conds);

        //reroute to the summary page
        $f3->reroute('orderform2');
    }

    //echo '<h1>Order Form 2</h1>';
    $view = new Template();
    echo $view->render('views/orderforms/orderform2.html');
}
);

//route to summary
$f3->route('GET /summary', function() {
//    echo '<h1>Summary</h1>';
    $view = new Template();
    echo $view->render('views/summary.html');
}
);




//Run fat free
$f3->run();
