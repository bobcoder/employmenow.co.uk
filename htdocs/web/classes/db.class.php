<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
 class Fav{
 	public function favExists($uid, $jid){
		$sql = "SELECT * FROM favorites WHERE user_id=$uid AND job_id=$jid";
		$result = mysql_query($sql);
		$numrows = mysql_num_rows ( $result );//GET count
		if($numrows <>0){
			return true;//FAV already in DB
		}else{
			return false;//Go ahead and add fav
		}
 	}
 }
?>