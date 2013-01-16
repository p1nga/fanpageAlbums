<?php
/**
 * @version     1.0.8
 * @package     com_fanpageAlbums
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU LESSER GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 * @author      Part-One <pastor399@gmail.com> - http://www.part-one.net
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

/**
 * Supports an HTML select list of categories
 */
class JFormFieldCustom_field extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'text';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		return implode($html);
	}
}