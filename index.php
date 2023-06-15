<?php

//This turns on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the needed files
require_once('vendor/autoload.php');

//For testing only
$dataLayer = new DataLayer();

//Instance of the Base class
$f3 = Base::instance();
$con = new Controller($f3);

//Define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
}
);

//breakfast route
$f3->route('GET /breakfast', function() {
    $GLOBALS['con']->breakfast();
}
);

//lunch route
$f3->route('GET /lunch', function() {
    $GLOBALS['con']->lunch();
}
);

//dinner route
$f3->route('GET /dinner', function() {
    $GLOBALS['con']->dinner();
}
);

//Happy Hour route
$f3->route('GET /happy-hour', function() {
    $GLOBALS['con']->happyHour();
}
);

//route to orderform1
$f3->route('GET|POST /orderform1', function($f3) {
    $GLOBALS['con']->orderform1();
});


//route to orderform2
$f3->route('GET|POST /orderform2', function($f3) {
    $GLOBALS['con']->orderform2();
}
);

//route to summary
$f3->route('GET /summary', function() {
    $GLOBALS['con']->summary();
}
);

//Run fat free
$f3->run();
