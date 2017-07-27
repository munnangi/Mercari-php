<?php

/**
 * Created by PhpStorm.
 * User: munna
 * Date: 6/14/2017
 * Time: 6:07 PM
 */
class magicMethods
{
    private $items= array();

    public function __call($name,$arguments)
    {
        echo "calling method".$name ."with arguments".implode(',',$arguments);
    }

    public function __set($key,$value)

    {
        $this->items[$key] = $value;
        echo "<pre>";print_r($this->items);
    }

    public function __get($key)
    {
        return $this->items[$key];
    }
}