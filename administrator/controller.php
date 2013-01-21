<?php
/**
 * @version     1.0.8
 * @package     com_fanpagealbums
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU LESSER GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 * @author      Part-One <pastor399@gmail.com> - http://www.part-one.net
 */


// No direct access
defined('_JEXEC') or die;

class FanpageAlbumsController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/fanpagealbums.php';

		$view		= JFactory::getApplication()->input->getCmd('view', 'facebookphotolinks');
        JFactory::getApplication()->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}
}
