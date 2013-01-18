<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * HelloWorld Model
 */
class FanpageAlbumsModelDefault extends JModelItem
{

    protected $AlbumList;
    protected $ThumbsList = array();
    protected $DisplayParams;
    protected $fbAPI;
    
    public function getDisplayParams()
    {
        $app = JFactory::getApplication();
        
        $comParams = JComponentHelper::getParams('com_fanpageAlbums');
        $params = $app->getParams();
        
        $param = new stdClass();
        $param->PageID = $params->get('pageid');
        $param->Columns = $params->get('columns');
        $param->Rows = $params->get('rows');
        $param->Type = $comParams->get('libType');
        $param->AppId = $comParams->get('appId');
        $param->AppSecret = $params->get('appSecret');
        $this->DisplayParams = $param;
            //Setup Which Facebook API To Use. 
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
    
    public function getAlbumList()
    {
        //READ VIEW PARAMETERS
        $pageID = $this->DisplayParams->PageID;

        $query = "SELECT aid, name, cover_pid FROM album WHERE owner = " . $pageID .
                 " AND type = 'normal' AND name != 'Cover Photos' AND name != 'Profile Pictures'";
        $results = $this->fbAPI->api( array(
                                 'method' => 'fql.query',
                                 'query' => $query, ));
        $this->AlbumList = $results;
        return $this->AlbumList;
    }
    
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////

    public function getThumbsList()
    {	
        function search_array($needle, $haystack) 
        {
            if(in_array($needle, $haystack)) {
                     return true;
            }
            foreach($haystack as $element) {
                     if(is_array($element) && search_array($needle, $element))
                              return true;
            }
                   return false;
        }
        
        function fqlPhoto($cover)
        {
            $query = 'SELECT images FROM photo WHERE pid = "' . $cover . '"';
            $thumb = $this->fbAPI->api( array(
                                    'method' => 'fql.query',
                                    'query' => $query,
                            ));
            return $thumb;
        }
        
        $dbo = JFactory::getDbo();
        $dbQuery = $dbo->getQuery(true);
	
	//Select All pid In Table
	$dbQuery->select('pid');
            $dbQuery->from('#__fanpagealbums');
            $dbo->setQuery($dbQuery);

            //$existing contains the pid of exis
            $existing = $dbo->loadResultArray();
            
        //Does PID, Details Exist In Database?
        $ThumbList = array();
        foreach ($this->AlbumList as $Album)
        {
            $src_small = "";
            if (search_array($Album['cover_pid'], $existing) == true)
            {
                $dbQuery = $dbo->getQuery(true);

                //Select All pid In Table
                $dbQuery->select('src_small');
                $dbQuery->from('#__fanpagealbums');
                $dbQuery->where('pid = "' . $Album['cover_pid'] . '"');
                $dbo->setQuery($dbQuery);
                
                $src_small = $dbo->loadResult();
                
            }else
            {
                //if it does not exist, query the photo details using fql
                $photo = fqlPhoto($Album['cover_pid']);				
                // Create and populate an object.
                $insert = new stdClass();
                $insert->pid = $Album['cover_pid'];
                $insert->album_name = $Album['name'];
                $insert->src_small=$photo[0]['images'][6]['source'];
                $insert->src_large=$photo[0]['images'][0]['source'];
                $src_small = $insert->src_small;
                try {
                        // Insert the object into fanpageAlbums table.
                        $result = JFactory::getDbo()->insertObject('#__fanpagealbums', $insert);
                        unset($result);
                }catch (Exception $e) {
                        return $e;
                } 
            }

            $Thumb = new stdClass();
            $Thumb->aid = $Album['aid'];
            $Thumb->name = $Album['name'];
            $Thumb->src_small = $src_small;
            
            $ThumbList[] = $Thumb;
        }
       //Return List Of Thumbnail Details
        $this->ThumbsList = $ThumbList;
        return $this->ThumbsList;
    }
}