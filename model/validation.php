<?php

/*  328/diner/model/validation.php
    Contains functions to validate data
    in the diner app
    This is part of the MODEL
*/

class Validate
{
//This function returns true if the meal variable is not empty and if it's in the array
    static function validMeal($meal)
    {
        return (!empty($meal) && in_array($meal, DataLayer::getMeals()));
    }

    /* validFood() static function
        validates that the data
         - trim()  eliminates white spaces on both sides of the string
         - strlen($food) >= 2  it has at least 2 characters
         - !ctype_digit($food)  is not all numbers
     */
    static function validFood($food)
    {
        $food = trim($food);
        return (strlen($food) >= 2 && !ctype_digit($food));
    }

    static function validCondiments($userCondiments)
    {
        $condiments = DataLayer::getCondiments();

        //check each user condiment against the array of condiments
        foreach ($userCondiments as $userCondiment) {
            if (!in_array($userCondiment, $condiments)) {
                return false;
            }
        }
        return true;
    }
}

