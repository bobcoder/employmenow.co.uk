<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
 /* These are helper functions */

function render($template,$vars = array()){
//echo "views/$template.php";
    // This function takes the name of a template and
    // a list of variables, and renders it.

    // This will create variables from the array:
    extract($vars);

    // It can also take an array of objects
    // instead of a template name.
    if(is_array($template)){

        // If an array was passed, it will loop
        // through it, and include a partial view
        foreach($template as $k){

            // This will create a local variable
            // with the name of the object's class

            $cl = strtolower(get_class($k));
            $$cl = $k;

            include "views/_$cl.php";
        }

    }
    else {
    	//echo "Here";
       include "views/$template.php";

    }
}
// Helper function for title formatting:
function formatTitle($title = ''){
	if($title){
		$title.= ' | ';
	}

	$title .= $GLOBALS['defaultTitle'];

	return $title;
}
function truncateText($text, $limit){
    $strings = $text;
      if (strlen($text) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          if(sizeof($pos) >$limit)
          {
            $text = substr($text, 0, $pos[$limit]) . '...';
          }
          return $text;
      }
      return $text;
}
?>