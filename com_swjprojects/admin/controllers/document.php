<?php
/*
 * @package    SW JProjects Component
 * @version    1.9.0
 * @author Septdir Workshop, <https://septdir.com>, Sergey Tolkachyov <https://web-tolk.ru>
 * @сopyright (c) 2018 - October 2023 Septdir Workshop, Sergey Tolkachyov. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link https://septdir.com, https://web-tolk.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

class SWJProjectsControllerDocument extends FormController
{
	/**
	 * The URL view list variable.
	 *
	 * @var  string
	 *
	 * @since  1.4.0
	 */
	protected $view_list = 'documentation';

	/**
	 * The prefix to use with controller messages.
	 *
	 * @var  string
	 *
	 * @since  1.4.0
	 */
	protected $text_prefix = 'COM_SWJPROJECTS_DOCUMENT';
}