<?php
//NO DIRECT ACCESS ALLOWED
defined('_JEXEC') or die;
?>

<script type="text/javascript">
Shadowbox.init();
</script>

<?php

echo('<table id="fb_album" style="width:100%">');
echo('<tr class="fb_album_row">');
$count = 0;
foreach ($this->PhotoList as $Photo)
{
    if($count == 6)
    {
        echo('</tr><tr>');
        $count = 0;
    }
    $pid = $Photo['pid'];
    $thumb = $Photo['src'];
    $src = $Photo['src_big'];
    echo('<td class="fb_album_td" style="text-algin:center;">');
    echo('<a class="fb_album_a" rel="shadowbox[My Gallery]" title="' . $this->AlbumName . '" href="' . $src . '"><div class="fb_album_div" style="float:left; width:100px; height:80px; background-image: url(' . $thumb . ');"></div></a>');
    echo('</td>');
    $count++;
}
echo('</tr>');
echo('</table>');
?>