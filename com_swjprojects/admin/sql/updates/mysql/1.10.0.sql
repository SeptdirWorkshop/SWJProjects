/*
 * @package    SW JProjects Component
 * @version    __DEPLOY_VERSION__
 * @author Septdir Workshop, <https://septdir.com>, Sergey Tolkachyov <https://web-tolk.ru>
 * @сopyright (c) 2018 - October 2023 Septdir Workshop, Sergey Tolkachyov. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link https://septdir.com, https://web-tolk.ru
 */

ALTER TABLE `#__swjprojects_projects` ADD `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `#__swjprojects_projects` ADD `created_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_projects` ADD `modified_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_projects` ADD `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `#__swjprojects_versions` ADD `created_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_versions` ADD `modified_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_versions` ADD `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `#__swjprojects_keys` ADD `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `#__swjprojects_keys` ADD `created_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_keys` ADD `modified_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_keys` ADD `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `#__swjprojects_documentation` ADD `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `#__swjprojects_documentation` ADD `created_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_documentation` ADD `modified_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_documentation` ADD `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `#__swjprojects_categories` ADD `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `#__swjprojects_categories` ADD `created_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_categories` ADD `modified_by` int(10) unsigned NOT NULL;
ALTER TABLE `#__swjprojects_categories` ADD `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;