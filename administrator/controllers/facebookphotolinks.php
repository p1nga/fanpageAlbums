<?php
/**
 * @version     1.0.8
 * @package     com_fanpageAlbums
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU LESSER GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 * @author      Part-One <pastor399@gmail.com> - http://www.part-one.net
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Facebookphotolinks list controller class.
 */
class FanpageAlbumsControllerFacebookphotolinks extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'photolinks', $prefix = 'FanpageAlbumsModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
    
    
	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application
		JFactory::getApplication()->close();
	}
    
    
    
}