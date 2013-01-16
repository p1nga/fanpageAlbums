<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 */
class FANPAGEALBUMSViewAlbum extends JView
{
    // Overwriting JView display method
    function display($tpl = null) 
    {
            $document = JFactory::getDocument();
            $document->addStyleSheet(JURI::root().'components/com_fanpageAlbums/views/Album/shadowbox/shadowbox.css');
            $document->addScript(JURI::root() . 'components/com_fanpageAlbums/views/Album/shadowbox/shadowbox.js' );
            $document->addStyleSheet(JURI::root().'components/com_fanpageAlbums/views/Album/tmpl/default.css');

            // Send Album Id To The Model, From URL
                $model = & $this->getModel('Album');
                $model->setAlbumID(JRequest::getVar('aid'));

            // Get Data Back From The Model
                $this->AlbumID = $this->get('AlbumID');
                $this->AlbumName = $this->get('AlbumName');
                $this->PhotoList = $this->get('PhotoList');

            // Modify The Breadcrumb.
                $app	= JFactory::getApplication();
                $pathway = $app->getPathway();
                $pathway->addItem($this->AlbumName);
                
            // Display the view
                parent::display($tpl);
    }
}

?>
