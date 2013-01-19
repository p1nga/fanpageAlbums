<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
class FanpageAlbumsModelAlbum extends JModelItem
{
    protected $DisplayParams;
    protected $AlbumID;
    protected $AlbumName;
    protected $PhotoList;
    protected $fbAPI;
    
    public function getDisplayParams()
    {
        $comParams = JComponentHelper::getParams('com_fanpageAlbums');
        $param = new stdClass();
        $param->Type = $comParams->get('libType');
        $param->AppId = $comParams->get('appId');
        $param->AppSecret = $comParams->get('appSecret');
        $this->DisplayParams = $param;
        
            if ($this->DisplayParams->Type == 0){
                $this->fbAPI = JFBConnectFacebookLibrary::getInstance();
            }else{
                require_once('components/com_fanpagealbums/FacebookSDK/facebook.php');
                $config = array();
                $config['appId'] = $this->DisplayParams->AppId;
                $config['secret'] = $this->DisplayParams->AppSecret;
                $config['fileUpload'] = false; // optional
                $this->fbAPI = new Facebook($config);            
            }
        return $this->DisplayParams;
    }
    
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
        $query = "SELECT name FROM album WHERE aid = '" . $this->AlbumID . "'";
        $result =  $this->fbAPI->api( array(
                                 'method' => 'fql.query',
                                 'query' => $query,
                         ));
         $this->AlbumName = $result[0]['name'];
         return $this->AlbumName;
    }
    
    public function getPhotoList()
    {
        $query = "SELECT pid, src, src_big FROM photo WHERE aid = '" . $this->AlbumID . "'";
        $results =  $this->fbAPI->api( array(
                                 'method' => 'fql.query',
                                 'query' => $query, ));
         $this->PhotoList = $results;
         return $this->PhotoList;
    }
}