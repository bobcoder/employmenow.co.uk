<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
/* This controller renders the industry pages */

class IndustryController{
    public function handleRequest(){
        $ind = Industry::find(array('id'=>$_GET['industry']));

        if(empty($ind)){
            throw new Exception("There is no such Industry!");
        }

        // Fetch all the industries:
        $industries = Industry::find();

        // Fetch all the jobs in this industry:
        $job = Jobs::find(array('industry'=>$_GET['industry']));

        // $industries and $jobs are both arrays with objects
        $job->description = "stuff";

        render('industry',array(
            'title'			=> 'Browsing '.$ind[0]->name,
            'industry'	=> $industries,
            'job'		=> $job
        ));
    }
}
?>