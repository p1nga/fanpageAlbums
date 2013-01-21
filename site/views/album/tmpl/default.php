<?php
//NO DIRECT ACCESS ALLOWED
defined('_JEXEC') or die;

$album_view = 'thumb';
if ($album_view == 'thumb'){
    require_once('components/com_fanpagealbums/views/album/tmpl/thumb_album.php');
  } else {
    require_once('components/com_fanpagealbums/views/album/tmpl/slide_album.php');    
 }

?>