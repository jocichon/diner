<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    //echo '<h1>Welcome to My Diner!</h1>';
    $view = new Template();
    echo $view->render('views/home.html');
}
);

//Define a breakfast route
$f3->route('GET /breakfast', function() {
//    echo '<h1>Breakfast Menu</h1>';
    $view = new Template();
    echo $view->render('views/menus/breakfast.html');
}
);

//Define a lunch route
$f3->route('GET /lunch', function() {
//    echo '<h1>Lunch</h1>';
    $view = new Template();
    echo $view->render('views/menus/lunch.html');
}
);

//Define a dinner route
$f3->route('GET /dinner', function() {
//    echo '<h1>Dinner</h1>';
    $view = new Template();
    echo $view->render('views/menus/dinner.html');
}
);

//Define a route to orderform1
$f3->route('GET /orderform1', function() {
//    echo '<h1>Order Form 1</h1>';
    $view = new Template();
    echo $view->render('views/orderforms/orderform1.html');
}
);

//Define a route to orderform2
$f3->route('GET /orderform2', function() {
//    echo '<h1>Order Form 2</h1>';
    $view = new Template();
    echo $view->render('views/orderforms/orderform2.html');
}
);

//Define a route to summary
$f3->route('GET /summary', function() {
//    echo '<h1>Summary</h1>';
    $view = new Template();
    echo $view->render('views/summary.html');
}
);




//Run fat free
$f3->run();
