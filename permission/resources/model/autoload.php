<?php
/**
 * Created by PhpStorm.
 * User: Sabiduria
 * Date: 11/12/2018
 * Time: 10:01 AM
 */
function autoload($class){
    require dirname(__FILE__)."/".$class.".php";
}
spl_autoload_register('autoload');