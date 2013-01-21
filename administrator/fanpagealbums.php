<?php
/**
 * @version     1.0.8
 * @package     com_fanpagealbums
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU LESSER GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 * @author      Part-One <pastor399@gmail.com> - http://www.part-one.net
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_fanpagealbums')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JController::getInstance('FanpageAlbums');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
