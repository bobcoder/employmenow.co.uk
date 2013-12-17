<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */

class Login{

    public static function find($arr = array()){
        global $db;

        if(empty($arr)){
            $st = $db->prepare("SELECT * FROM jobs");
        }
        else if($arr['industry']){
            $st = $db->prepare("SELECT * FROM jobs WHERE industry_id=:industry");
        }
        else{
            throw new Exception("Unsupported property!");
        }

                // This will execute the query, binding the $arr values as query parameters
        $st->execute($arr);

        // Returns an array of Job objects:
        return $st->fetchAll(PDO::FETCH_CLASS, "Jobs");
    }
}?>