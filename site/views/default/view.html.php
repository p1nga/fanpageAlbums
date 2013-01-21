<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 */
class FANPAGEALBUMSViewDefault extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
            $document = JFactory::getDocument();
            $document->addStyleSheet(JURI::root().'components/com_fanpagealbums/views/default/tmpl/default.css');
            $document->addStyleSheet(JURI::root().'components/com_fanpagealbums/views/default/shadowbox/shadowbox.css' );
            $document->addScript(JURI::root() . 'components/com_fanpagealbums/views/default/shadowbox/shadowbox.js' );		
                // Assign data to the view
                $this->DisplayParams = $this->get('DisplayParams');
		$this->AlbumList = $this->get('AlbumList');
                $this->ThumbsList = $this->get('ThumbsList');
		// Display the view
		parent::display($tpl);
	}
}

?>
