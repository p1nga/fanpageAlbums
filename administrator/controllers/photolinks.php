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

jimport('joomla.application.component.controllerform');

/**
 * Photolinks controller class.
 */
class FanpageAlbumsControllerPhotolinks extends JControllerForm
{

    function __construct() {
        $this->view_list = 'facebookphotolinks';
        parent::__construct();
    }

}