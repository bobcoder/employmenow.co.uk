<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */

class Register{

    public static function isRegistered($arr = array()){
        global $db;
        if(empty($arr)){
            //$st = $db->prepare("SELECT * FROM users");
        }
        else if($arr['iud']){
            $st = $db->prepare("SELECT id, email FROM users WHERE id=:uid");
        }
        else{
            throw new Exception("Unsupported property!");
        }
                // This will execute the query, binding the $arr values as query parameters
        $st->execute($arr);
        // Returns an array of Job objects:
        return $st->fetchAll(PDO::FETCH_CLASS, "Users");
    }
}?>