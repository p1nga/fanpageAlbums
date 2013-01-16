<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * HelloWorld Model
 */
class FanpageAlbumsModelAlbum extends JModelItem
{
    protected $AlbumID;
    protected $AlbumName;
    protected $PhotoList;
    
    public function setAlbumID($aid)
    {
        $this->AlbumID = $aid;
    }
    public function getAlbumID()
    {
        return $this->AlbumID;
    }
    
    public function getAlbumName()
    {   
        $jfbcLibrary = JFBConnectFacebookLibrary::getInstance();
        $query = "SELECT name FROM album WHERE aid = '" . $this->AlbumID . "'";
        $result = $jfbcLibrary->api( array(
                                 'method' => 'fql.query',
                                 'query' => $query,
                         ));
         $this->AlbumName = $result[0]['name'];
         return $this->AlbumName;
    }
    
    public function getPhotoList()
    {// Should Include Else Here To Use Facebook SDK instead of JFBConnect API in the future.
        
        $jfbcLibrary = JFBConnectFacebookLibrary::getInstance();
        $query = "SELECT pid, src, src_big FROM photo WHERE aid = '" . $this->AlbumID . "'";

        //Run Query
        $results = $jfbcLibrary->api( array(
                                 'method' => 'fql.query',
                                 'query' => $query,
                         ));
         $this->PhotoList = $results;
         return $this->PhotoList;
    }
}