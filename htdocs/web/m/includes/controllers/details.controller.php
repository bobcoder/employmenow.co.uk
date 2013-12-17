<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
/* This controller renders the industry pages */

class DetailsController{
    public function handleRequest(){
        $dets = Details::find(array('jobs_id'=>$_GET['details']));
        if(empty($dets)){
            throw new Exception("There is no such Job!");
        }
        // $industries and $jobs are both arrays with objects

        render('details',array(
            'title'			=> 'Job Details',
            'details' => $dets
        ));

    }
}
?>