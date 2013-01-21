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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_fanpagealbums/assets/css/fanpagealbums.css');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'photolinks.cancel' || document.formvalidator.isValid(document.id('photolinks-form'))) {
			Joomla.submitform(task, document.getElementById('photolinks-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_fanpagealbums&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="photolinks-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_FANPAGEALBUMS_LEGEND_PHOTOLINKS'); ?></legend>
			<ul class="adminformlist">
                
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
				<li><?php echo $this->form->getLabel('pid'); ?>
				<?php echo $this->form->getInput('pid'); ?></li>
				<li><?php echo $this->form->getLabel('album_name'); ?>
				<?php echo $this->form->getInput('album_name'); ?></li>
				<li><?php echo $this->form->getLabel('src_small'); ?>
				<?php echo $this->form->getInput('src_small'); ?></li>
				<li><?php echo $this->form->getLabel('src_large'); ?>
				<?php echo $this->form->getInput('src_large'); ?></li>


            </ul>
		</fieldset>
	</div>


	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>