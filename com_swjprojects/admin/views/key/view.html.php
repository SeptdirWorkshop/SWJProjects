<?php
/**
 * @package    SW JProjects Component
 * @version    __DEPLOY_VERSION__
 * @author     Septdir Workshop - www.septdir.com
 * @copyright  Copyright (c) 2018 - 2020 Septdir Workshop. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link       https://www.septdir.com/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Version;

class SWJProjectsViewKey extends HtmlView
{
	/**
	 * Model state variables.
	 *
	 * @var  Joomla\CMS\Object\CMSObject
	 *
	 * @since  1.3.0
	 */
	protected $state;

	/**
	 * Form object.
	 *
	 * @var  Form
	 *
	 * @since  1.3.0
	 */
	protected $form;

	/**
	 * Key object.
	 *
	 * @var  object
	 *
	 * @since  1.3.0
	 */
	protected $item;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse.
	 *
	 * @throws  Exception
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since  1.3.0
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');

		// Check for errors
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode('\n', $errors), 500);
		}

		// Add title and toolbar
		$this->addToolbar();

		// Re-generate field
		if (empty($this->item->id))
		{
			$this->form->removeField('key_regenerate');
		}

		return parent::display($tpl);
	}

	/**
	 * Add title and toolbar.
	 *
	 * @throws  Exception
	 *
	 * @since  1.3.0
	 */
	protected function addToolbar()
	{
		$isNew     = ($this->item->id == 0);
		$canDo     = SWJProjectsHelper::getActions('com_swjprojects', 'key', $this->item->id);
		$toolbar   = Toolbar::getInstance('toolbar');
		$isJoomla4 = (new Version())->isCompatible('4.0');

		// Disable menu
		Factory::getApplication()->input->set('hidemainmenu', true);

		// Set page title
		$title = ($isNew) ? Text::_('COM_SWJPROJECTS_KEY_ADD') : Text::_('COM_SWJPROJECTS_KEY_EDIT');
		ToolbarHelper::title(Text::_('COM_SWJPROJECTS') . ': ' . $title, 'cube');

		// Add apply & save buttons
		if ($canDo->get('core.edit'))
		{
			ToolbarHelper::apply('key.apply');
			ToolbarHelper::save('key.save');
		}

		// Add save new button
		if ($canDo->get('core.create'))
		{
			ToolbarHelper::save2new('key.save2new');
		}

		// Add cancel button
		ToolbarHelper::cancel('key.cancel', 'JTOOLBAR_CLOSE');

		// Add support button
		$link = 'https://www.septdir.com/support#solution=SWJProjects';
		if ($isJoomla4 == true)
		{
			$toolbar->linkButton('support')
				->url($link)
				->buttonClass('btn')
				->icon('icon-support')
				->attributes(['target' => '_blank'])
				->text(Text::_('COM_SWJPROJECTS_SUPPORT'));
		}
		else
		{
			$download = LayoutHelper::render('components.swjprojects.toolbar.link',
				array('link' => $link, 'text' => 'COM_SWJPROJECTS_SUPPORT', 'icon' => 'support', 'new' => true));
			$toolbar->appendButton('Custom', $download, 'support');
		}

		// Add donate button
		$link = 'https://www.septdir.com/donate#solution=swjprojects';
		if ($isJoomla4 == true)
		{
			$toolbar->linkButton('donate')
				->url($link)
				->buttonClass('btn')
				->icon('icon-heart')
				->attributes(['target' => '_blank'])
				->text(Text::_('COM_SWJPROJECTS_DONATE'));
		}
		else
		{
			$download = LayoutHelper::render('components.swjprojects.toolbar.link',
				array('link' => $link, 'text' => 'COM_SWJPROJECTS_DONATE', 'icon' => 'heart', 'new' => true));
			$toolbar->appendButton('Custom', $download, 'donate');
		}
	}
}