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

    $food = "";
    $meal = "";

    //if the form has been posted...
    //Auto-global arrays: $_SERVER, $_POST, $_GET, $_SESSION, etc.
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        //Get the data from the POST array if POST is set
        var_dump($_POST);
        //food
        if (isset($_POST['food'])) {
            $food = $_POST['food'];
        }
        //meal
        if (isset($_POST['meal'])) {
            $meal = $_POST['meal'];
        }

        //TEST
        echo "The meal is set to " . $meal;
        echo "The food is set to " . $food;


        //Instantiate Order object and add it to the SESSION array
        $newOrder = new Order();
        //TEST
        echo "<pre>";
        var_dump($newOrder);
        echo "<pre>";

        //Validate the data and add it to the session array as a field of the object
        //Validation function is defined in the model
        //meal
        if (Validate::validMeal($meal)) {
            $newOrder->setMeal($meal);
        } //if data is invalid set an error variable in the F3 hive
        else {
            $f3->set('errors["$meal"]', 'Invalid meal selected');
        }

        //food
        if (Validate::validFood($food)) {
            //Store data in a SESSION array as the food field in the Order object
            $newOrder->setFood($food);
        } else {
            $f3->set('errors["$food"]', 'Invalid food selected');
        }

        //if there are no errors (if the array is empty)
        if(empty($f3->get('errors'))) {
            //Add the object to the session array
            $f3->set('SESSION.order', $newOrder);
            ///Reroute to orderform2
            $f3->reroute('orderform2');
        }
    }

    //Get the data from DataLayer class and add to hive
    $f3->set('meals', DataLayer::getMeals());

    //Display a view page
    $view = new Template();
    echo $view->render('views/orderforms/orderform1.html'); //why no directory in path in tina's code?
});


//route to orderform2
$f3->route('GET|POST /orderform2', function($f3) {

    //initialize the condiments array
    $selectedCondiments = array();

    //if the form has been posted...
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        //if condiments have been selected...
        if (!empty($_POST['conds'])) {

            //assign the condiments to the array
            $selectedCondiments = $_POST['conds'];

            //validate the selected condiments (function defined in model)
            if (Validate::validCondiments($selectedCondiments)) {

                //implode the selectedCondiments array
                //implode converts the array into a comma delimited string
                $condString = implode($selectedCondiments);

                //get the order object from the session array
                // and then set the order condiments field to the condString
                $f3->get('SESSION.order')->setCondiments($condString);

            } else {
                //set an error because someone is attempting to enter bad data into the database.
                $f3->set('errors["conds"]', 'GO AWAY EVILDOER!');
            }
        }

        //reroute to the summary page iff there are no error in the error array
        if (empty($f3->get('errors'))) {
            $f3->reroute('summary');
        }
    }

    //if not posted get the data from the DataLayer class and add it to the hive
    $f3->set('condiments', DataLayer::getCondiments());

    $view = new Template();
    echo $view->render('views/orderforms/orderform2.html');
}
);

//route to summary
$f3->route('GET /summary', function() {
//    echo '<h1>Summary</h1>';
    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
}
);




//Run fat free
$f3->run();
