<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
 class Industry{

    /*
        The find static method selects categories
        from the database and returns them as
        an array of Industry objects.
    */

    public static function find($arr = array()){
        global $db;

        if(empty($arr)){
            //$st = $db->prepare("SELECT * FROM industries");
            $st = $db->prepare("SELECT ind.name, ind.id,
        COALESCE(GROUP_CONCAT(job.industry_id), 'default_value') AS ind_id,
        COUNT(job.industry_id) AS industry_count
        FROM industries ind
        LEFT JOIN jobs job ON ind.id = job.industry_id
        GROUP BY ind.id");
        //AND job.approved='0'
        }else if($arr['id']){
            $st = $db->prepare("SELECT * FROM industries WHERE id=:id");
        }
        else{
            throw new Exception("Unsupported property!");
        }

                // This will execute the query, binding the $arr values as query parameters
        $st->execute($arr);

        // Returns an array of Industry objects:
        return $st->fetchAll(PDO::FETCH_CLASS, "Industry");
    }

}
?>