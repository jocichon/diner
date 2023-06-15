<?php

/**
 * 328/application/controller.php
 *
 * This class represents the controller for the job app project.
 * @author Jo Cichon
 * @date 06/06/2023
 * @version 2.0
 */
class Controller
{
    //F3 object
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function breakfast()
    {
        $view = new Template();
        echo $view->render('views/menus/breakfast.html');
    }

    function lunch()
    {
        $view = new Template();
        echo $view->render('views/menus/lunch.html');
    }

    function dinner()
    {
        //    echo '<h1>Dinner</h1>';
        $view = new Template();
        echo $view->render('views/menus/dinner.html');
    }

    function happyHour()
    {
        //    echo '<h1>Happy Hour</h1>';
        $view = new Template();
        echo $view->render('views/menus/happy-hour.html');
    }

    function orderform1()
    {

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
                $this->_f3->set('errors["$meal"]', 'Invalid meal selected');
            }

            //food
            if (Validate::validFood($food)) {
                //Store data in a SESSION array as the food field in the Order object
                $newOrder->setFood($food);
            } else {
                $this->_f3->set('errors["$food"]', 'Invalid food selected');
            }

            //if there are no errors (if the array is empty)
            if(empty($this->_f3->get('errors'))) {
                //Add the object to the session array
                $this->_f3->set('SESSION.order', $newOrder);
                ///Reroute to orderform2
                $this->_f3->reroute('orderform2');
            }
        }

        //Get the data from DataLayer class and add to hive
        $this->_f3->set('meals', DataLayer::getMeals());

        //Display a view page
        $view = new Template();
        echo $view->render('views/orderforms/orderform1.html'); //why no directory in path in tina's code?
    }

    function orderform2()
    {

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
                    $this->_f3->get('SESSION.order')->setCondiments($condString);

                } else {
                    //set an error because someone is attempting to enter bad data into the database.
                    $this->_f3->set('errors["conds"]', 'GO AWAY EVILDOER!');
                }
            }

            //reroute to the summary page iff there are no error in the error array
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('summary');
            }
        }

        //if not posted get the data from the DataLayer class and add it to the hive
        $this->_f3->set('condiments', DataLayer::getCondiments());

        $view = new Template();
        echo $view->render('views/orderforms/orderform2.html');
    }

    function summary() {
        //    echo '<h1>Summary</h1>';
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }

}
