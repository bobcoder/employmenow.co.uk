<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
 //Add this function to create thumbnails
 /*
  *         createThumbs($ImagePath . "/", $ImagePath . "/thumbs/",120, $ui . $name);
            createThumbs($ImagePath . "/", $ImagePath . "/small/",220, $ui . $name);
            createThumbs($ImagePath . "/", $ImagePath . "/medium/",550, $ui . $name);
            createThumbs($ImagePath . "/", $ImagePath . "/large/",820, $ui . $name);
  */
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth, $fname )
{
  // open the directory
  $dir = opendir( $pathToImages );
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg' )
    {
      //echo "Creating thumbnail for {$fname} <br />";
      // load image and get image size
      $img = imagecreatefromjpeg( $pathToImages . $fname );
      $width = imagesx( $img );
      $height = imagesy( $img );
      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );
      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      // copy and resize old image into new image
      imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
      // save thumbnail into a file
      imagejpeg( $tmp_img, $pathToThumbs . $fname, 100 );
    }

  closedir( $dir );
}
?>