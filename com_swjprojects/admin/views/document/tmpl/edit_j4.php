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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
HTMLHelper::stylesheet('com_swjprojects/admin-j4.min.css', array('version' => 'auto', 'relative' => true));

Factory::getDocument()->getWebAssetManager()
	->usePreset('choicesjs')
	->useScript('webcomponent.field-fancy-select');
Factory::getDocument()->addScriptDeclaration('
	document.addEventListener("DOMContentLoaded", function () {
		document.querySelectorAll("select").forEach(function (element) {
			new Choices(element);
		});
	});
	Joomla.submitbutton = function(task)
	{
		if (task == "document.cancel" || document.formvalidator.isValid(document.getElementById("item-form")))
		{
			Joomla.submitform(task, document.getElementById("item-form"));
		}
	};
');
?>
<form action="<?php echo Route::_('index.php?option=com_swjprojects&view=document&id=' . $this->item->id); ?>"
	  method="post" name="adminForm" id="item-form" class="form-validate translate-tabs" enctype="multipart/form-data">
	<fieldset class="row title-alias form-vertical mb-3">
		<div class="col-12 col-md-6">
			<?php echo LayoutHelper::render('components.swjprojects.translate.field', array(
				'forms' => $this->translateForms, 'name' => 'title')); ?>
		</div>
		<div class="col-12 col-md-6">
			<?php echo $this->form->renderField('alias'); ?>
		</div>
	</fieldset>
	<div class="main-card">
		<div class="row">
			<div class="col-lg-9">
				<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'general', 'class')); ?>
				<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'general', Text::_('JGLOBAL_FIELDSET_CONTENT')); ?>
				<fieldset class="w-100">
					<h3 class="mb-3">
						<?php echo LayoutHelper::render('components.swjprojects.translate.text',
							'COM_SWJPROJECTS_DOCUMENT_INTROTEXT'); ?>
					</h3>
					<?php echo LayoutHelper::render('components.swjprojects.translate.input', array(
						'forms' => $this->translateForms, 'name' => 'introtext')); ?>
					<hr>
					<h3 class="mb-3">
						<?php echo LayoutHelper::render('components.swjprojects.translate.text',
							'COM_SWJPROJECTS_DOCUMENT_FULLTEXT'); ?>
					</h3>
					<?php echo LayoutHelper::render('components.swjprojects.translate.input', array(
						'forms' => $this->translateForms, 'name' => 'fulltext')); ?>
				</fieldset>
				<?php echo HTMLHelper::_('uitab.endTab'); ?>


				<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'metadata', Text::_('JGLOBAL_FIELDSET_METADATA_OPTIONS')); ?>
				<fieldset class="form-horizontal">
					<?php echo LayoutHelper::render('components.swjprojects.translate.fieldset', array(
						'forms' => $this->translateForms, 'name' => 'metadata')); ?>
				</fieldset>
				<?php echo HTMLHelper::_('uitab.endTab'); ?>
				<?php echo HTMLHelper::_('uitab.endTabSet'); ?>
			</div>
			<div class="col-lg-3 bg-light border border-left">
				<fieldset>
					<?php echo $this->form->renderFieldset('global'); ?>
				</fieldset>
			</div>
		</div>
	</div>
	</div>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="return" value="<?php echo Factory::getApplication()->input->getCmd('return'); ?>"/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>