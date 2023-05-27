<?php

/**
 * 328/diner/classes/order.php
 *
 * This class represents a customer order from the diner
 *
 * @author Jo Cichon
 * @date 03/26/2023
 * @version 1.0
 */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Default constructor for order, no parameters
     */
    function __construct()
    {
        $this->_food = "";
        $this->_meal = "";
        $this->_condiments = "";
    }

    /**
     * Get food from order
     * @return string food item
     */
    public function getFood()
    {
        return $this->_food;
    }

    /**
     * Get meal from order
     * @return string meal item
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * Get condiments from order
     * @return string condiments item
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }


    /**
     * Set food for order
     * @param string $food
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * Set meal for order
     * @param string $meal
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * Set condiments for order
     * @param string $condiments
     */
    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }

}

//$testOrder = new Order();
//$testOrder->setFood("burrito");
//$testOrder->setMeal("lunch");
//$testOrder->setCondiments("salsa, sour cream");
//
//echo "Today for " . $testOrder->getMeal() . ", I am going to order a "
//    . $testOrder->getFood() . " with " . $testOrder->getCondiments() . " on the side";
//
////how to print the Object in PHP
////var_dump($testOrder);
////print_r($testOrder);
//
////more readable
//echo "<pre>";
//var_dump($testOrder);
//echo "<pre>";
