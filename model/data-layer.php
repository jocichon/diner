<?php

/*  328/diner/model/data-layer.php
    Returns data for the diner app
    This is part of the MODEL
    Eventually, this will read/write the DB

     * PDO - Using Prepared Statements
        1. Define the query (test first!)
            $sql = “…”;
        2. Prepare the statement
            $statement = $dbh->prepare($sql);
        3. Bind the parameters
            $statement->bindParam(param_name, value, type);
        4. Execute
            $statement->execute();
        5. Process the result, if there is one
*/

//echo $_SERVER['DOCUMENT_ROOT'];
require_once($_SERVER['DOCUMENT_ROOT'].'/../mando-pdo-config.php');

class DataLayer
{
    /**
     * @var PDO The database connection object
     */
    private $_dbh; //common name for this variable database handle

    /**
     * DataLayer constructor
     */
    function __construct()
    {
        try {
            //Instantiate a database object
            $this->_dbh = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
           //echo 'Connected to database!!';
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Get the meals for the order1 form
    static function getMeals()
    {
        $meals = array("breakfast", "brunch", "lunch", "dinner");
        return $meals;
    }

    // Get the condiments for the order2 form
    static function getCondiments()
    {
        $condiments = array("ketchup", "mustard", "mayo", "sriracha");
        return $condiments;
    }
}