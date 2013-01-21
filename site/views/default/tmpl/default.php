<?php
//NO DIRECT ACCESS ALLOWED
defined('_JEXEC') or die;

//print_r ($this->DisplayParams);

$Albums = $this->AlbumList;     //List Of Albums And There Details
$columns = $this->DisplayParams->Columns;       //Display Parameters - Table Columns
$rows = $this->DisplayParams->Rows;     //Display Parameters - Table Rows

$page = JRequest::getVar('page', 1);        //Which Page To Display?
$show = JRequest::getVar('show', false);    //Show All Albums On Page?

if($page < 1)       
    $page = 1;

$limit = $columns * $rows;
$nav_code = '';

if($show == 'all')
{
    $pages = ceil(count($Albums) / $limit);
    $nav_code .= ('<div id="fb_album_nav">');
    for ($i = 1; $i <= $pages; $i++)
        $nav_code .= ('<a href=?page=' . $i . '>' . $i . '</a>');
    $nav_code .= ('<a href=?show=all>All</a>');
    $nav_code .= ('</div>');
    $limit = count($Albums);
}else{
    $pages = ceil(count($Albums) / $limit);
    $nav_code .= ('<div id="fb_album_nav">');
    for ($i = 1; $i <= $pages; $i++)
        $nav_code .= ('<a href=?page=' . $i . '>' . $i . '</a>');
    $nav_code .= ('<a href=?show=all>All</a>');
    $nav_code .= ('</div>');
}


echo('<table id="fb_lite_container">');
echo('<tr>');

$colEnd = 0;
$count_thumbs = 0;
$start = ($page - 1) * $limit;
$count = 0;
    foreach($this->ThumbsList as $Thumb)
    {
        if($count >= $start)
        {
            if($count_thumbs < $limit)
            {
                $src_small = $Thumb->src_small;
                if ($colEnd == $columns){
                    echo('</tr><tr>'); $colEnd = 0;}  
                echo('<td>');
                //$onClick = 'openbox("' . $Thumb->name . '")';
                echo("<a href='?option=com_fanpagealbums&view=album&aid=" . $Thumb->aid . "'><div class='fbL_album_thumb' style='background-image: url(" .
                                                         $src_small. ")'> </div></a>");
                echo("<a href='?option=com_fanpagealbums&view=album&aid=" . $Thumb->aid . "'><div class='album_title'>". $Thumb->name . "</div></a>");
                echo('</td>'); 
                $colEnd++; $count_thumbs++;
            }
        }else{
            $count++;
        }
    }
    
echo('</tr>');
echo('</table>');
echo ($nav_code);
?>