<?php
/**
 * @package    SW JProjects Component
 * @version    __DEPLOY_VERSION__
 * @author     Septdir Workshop - www.septdir.com
 * @copyright  Copyright (c) 2018 - 2019 Septdir Workshop. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link       https://www.septdir.com/
 */

defined('_JEXEC') or die;


/**
 * @package    SW JProjects Component
 * @version    __DEPLOY_VERSION__
 * @author     Septdir Workshop - www.septdir.com
 * @copyright  Copyright (c) 2018 - 2019 Septdir Workshop. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link       https://www.septdir.com/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Pagination\Pagination;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

class SWJProjectsViewDocumentation extends HtmlView
{
	/**
	 * Model state variables.
	 *
	 * @var  Joomla\CMS\Object\CMSObject
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected $state;

	/**
	 * Documents array
	 *
	 * @var  array
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected $items;

	/**
	 * Pagination object.
	 *
	 * @var  Pagination
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected $pagination;

	/**
	 * Form object for search filters.
	 *
	 * @var  Form
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public $filterForm;

	/**
	 * The active search filters.
	 *
	 * @var  array
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public $activeFilters;

	/**
	 * View sidebar.
	 *
	 * @var  string
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public $sidebar;

	/**
	 * Display the view.
	 *
	 * @param   string  $tpl  The name of the template file to parse.
	 *
	 * @throws  Exception
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public function display($tpl = null)
	{
		$this->state         = $this->get('State');
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Add title and toolbar
		$this->addToolbar();

		// Prepare sidebar
		SWJProjectsHelper::addSubmenu('documentation');
		$this->sidebar = JHtmlSidebar::render();

		// Check for errors
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode('\n', $errors), 500);
		}

		return parent::display($tpl);
	}

	/**
	 * Add title and toolbar.
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected function addToolbar()
	{
		$canDo   = SWJProjectsHelper::getActions('com_swjprojects', 'documentation');
		$toolbar = Toolbar::getInstance('toolbar');

		// Set page title
		ToolbarHelper::title(Text::_('COM_SWJPROJECTS') . ': ' . Text::_('COM_SWJPROJECTS_DOCUMENTATION'), 'cube');

		// Add create button
		if ($canDo->get('core.create'))
		{
			ToolbarHelper::addNew('document.add');
		}

		// Add publish & unpublish buttons
		if ($canDo->get('core.edit.state'))
		{
			ToolbarHelper::publish('documentation.publish', 'JTOOLBAR_PUBLISH', true);
			ToolbarHelper::unpublish('documentation.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}

		// Add delete/trash buttons
		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			ToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'documentation.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			ToolbarHelper::trash('documentation.trash');
		}

		// Add preferences button
		if ($canDo->get('core.admin') || $canDo->get('core.options'))
		{
			ToolbarHelper::preferences('com_swjprojects');
		}

		// Add support button
		$link     = 'https://www.septdir.com/support#solution=SWJProjects';
		$download = LayoutHelper::render('components.swjprojects.toolbar.link',
			array('link' => $link, 'text' => 'COM_SWJPROJECTS_SUPPORT', 'icon' => 'support', 'new' => true));
		$toolbar->appendButton('Custom', $download, 'support');

		// Add donate button
		$link     = 'https://www.septdir.com/donate#solution=swjprojects';
		$download = LayoutHelper::render('components.swjprojects.toolbar.link',
			array('link' => $link, 'text' => 'COM_SWJPROJECTS_DONATE', 'icon' => 'heart', 'new' => true));
		$toolbar->appendButton('Custom', $download, 'donate');
	}

	/**
	 * Returns an array of fields the table can be sorted by.
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value.
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected function getSortFields()
	{
		return [
			'd.state'         => Text::_('JSTATUS'),
			'd.id'            => Text::_('JGRID_HEADING_ID'),
			'd.title'         => Text::_('JGLOBAL_TITLE'),
			'project_title'  => Text::_('COM_SWJPROJECTS_PROJECT'),
			'd.ordering'      => Text::_('JGRID_HEADING_ORDERING')
		];
	}
}