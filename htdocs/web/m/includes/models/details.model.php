<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */

class Details{

    /*
        The find static method selects categories
        from the database and returns them as
        an array of Job objects.
    */

    public static function find($arr = array()){
        global $db;


        if($arr['jobs_id']){
            $st = $db->prepare("SELECT * FROM jobs WHERE jobs_id=:jobs_id");

        }
        else{
            throw new Exception("Unsupported property!");
        }



                // This will execute the query, binding the $arr values as query parameters
        $st->execute($arr);

        // Returns an array of Job objects:
        return $st->fetchAll(PDO::FETCH_CLASS, "Details");
    }
}?>