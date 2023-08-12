<?php
/*
 * @package    SW JProjects Component
 * @version    1.7.0
 * @author Septdir Workshop, <https://septdir.com>, Sergey Tolkachyov <https://web-tolk.ru>
 * @сopyright (c) 2018 - August 2023 Septdir Workshop, Sergey Tolkachyov. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link https://septdir.com, https://web-tolk.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;

class SWJProjectsTableKeys extends Table
{
	/**
	 * Constructor.
	 *
	 * @param   JDatabaseDriver &$db  Database connector object
	 *
	 * @since  1.3.0
	 */
	function __construct(&$db)
	{
		parent::__construct('#__swjprojects_keys', 'id', $db);

		// Set the alias since the column is called state
		$this->setColumnAlias('published', 'state');
	}
}