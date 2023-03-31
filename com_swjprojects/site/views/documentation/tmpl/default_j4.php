<?php
/*
 * @package    SW JProjects Component
 * @version    __DEPLOY_VERSION__
 * @author     Septdir Workshop - www.septdir.com
 * @copyright  Copyright (c) 2018 - 2022 Septdir Workshop. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link       https://www.septdir.com/
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

?>
<div id="SWJProjects" class="documentation">
	<div class="project info mb-3">
		<h1><?php echo $this->project->title . ' - ' . Text::_('COM_SWJPROJECTS_DOCUMENTATION'); ?></h1>
		<div>
			<?php if (!empty($this->project->categories)): ?>
				<strong><?php echo Text::_('COM_SWJPROJECTS_CATEGORIES'); ?>: </strong>
				<?php $i = 0;
				foreach ($this->project->categories as $category)
				{
					if ($i > 0) echo ', ';
					$i++;
					echo '<a href="' . $category->link . '">' . $category->title . '</a>';
				}
				?>
			<?php else: ?>
				<strong><?php echo Text::_('COM_SWJPROJECTS_CATEGORY'); ?>: </strong>
				<a href="<?php echo $this->category->link; ?>">
					<?php echo $this->category->title; ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-md-3">
			<div class="card">
				<?php if ($icon = $this->project->images->get('icon')): ?>
					<a href="<?php echo $this->project->link; ?>">
						<?php echo HTMLHelper::image($icon, $this->project->title, array('class' => 'card-img-top')); ?>
					</a>
				<?php endif; ?>
				<div class="card-body">
					<ul class="list-unstyled small">
						<li>
							<strong><?php echo Text::_('COM_SWJPROJECTS_DOWNLOAD_TYPE'); ?>: </strong>
							<?php echo Text::_('COM_SWJPROJECTS_DOWNLOAD_TYPE_' . $this->project->download_type); ?>
						</li>
						<?php if ($this->project->download_type === 'paid' && $this->project->payment->get('price')): ?>
							<li>
								<strong><?php echo Text::_('COM_SWJPROJECTS_PRICE'); ?>: </strong>
								<span class="text-success"><?php echo $this->project->payment->get('price'); ?></span>
							</li>
						<?php endif; ?>
						<?php if ($this->project->version): ?>
							<li>
								<strong><?php echo Text::_('COM_SWJPROJECTS_VERSION'); ?>: </strong>
								<a href="<?php echo $this->project->version->link; ?>">
									<?php echo $this->project->version->version; ?>
								</a>
							</li>
						<?php endif; ?>
						<?php if ($this->project->downloads): ?>
							<li>
								<strong><?php echo Text::_('COM_SWJPROJECTS_STATISTICS_DOWNLOADS'); ?>: </strong>
								<?php echo $this->project->downloads; ?>
							</li>
						<?php endif; ?>

						<?php if ($this->project->hits): ?>
							<li>
								<strong><?php echo Text::_('COM_SWJPROJECTS_STATISTICS_HITS'); ?>: </strong>
								<?php echo $this->project->hits; ?>
							</li>
						<?php endif; ?>
					</ul>
					<div class="text-center">
						<?php if ($this->project->download_type === 'paid' && $this->project->payment->get('link') && !empty($item->version)): ?>
							<a href="<?php echo $this->project->payment->get('link'); ?>"
							   class="btn btn-success col-12">
								<?php echo Text::_('COM_SWJPROJECTS_BUY'); ?>
							</a>
						<?php elseif ($this->project->download_type === 'free' && !empty($item->version)): ?>
							<a href="<?php echo $this->project->download; ?>" class="btn btn-primary col-12"
							   target="_blank">
								<?php echo Text::_('COM_SWJPROJECTS_DOWNLOAD'); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="mb-3">
				<a href="<?php echo $this->project->link; ?>"
				   class="btn btn-outline-primary btn-sm ms-1 mb-1">
					<?php echo Text::_('COM_SWJPROJECTS_PROJECT'); ?>
				</a>
				<a href="<?php echo $this->project->versions; ?>"
				   class="btn btn-outline-primary btn-sm ms-1 mb-1">
					<?php echo Text::_('COM_SWJPROJECTS_VERSIONS'); ?>
				</a>
				<?php if ($this->project->documentation): ?>
					<a href="<?php echo $this->project->documentation; ?>"
					   class="btn btn-outline-primary btn-sm ms-1 mb-1">
						<?php echo Text::_('COM_SWJPROJECTS_DOCUMENTATION'); ?>
					</a>
				<?php endif; ?>
				<?php if ($urls = $this->project->urls->toArray()): ?>
					<?php foreach ($urls as $txt => $url):
						if (empty($url)) continue; ?>
						<a href="<?php echo $url; ?>" target="_blank"
						   class="btn btn-outline-primary btn-sm ms-1 mb-1">
							<?php echo Text::_('COM_SWJPROJECTS_URLS_' . $txt); ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<?php if (empty($this->items)) : ?>
				<div class="alert alert-info">
					<span class="icon-info-circle" aria-hidden="true"></span><span
							class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
					<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
				</div>
			<?php else : ?>
				<div class="documentationList">
					<div class="items">
						<?php foreach ($this->items as $item) : ?>
							<div class="item-<?php echo $item->id; ?> card mb-3">
								<div class="card-body">
									<h5 class="card-title">
										<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
									</h5>
									<?php if (!empty($item->introtext)): ?>
										<p><?php echo nl2br($item->introtext); ?></p>
									<?php endif; ?>
									<div class="text-end">
										<a href="<?php echo $item->link; ?>"
										   class="btn btn-outline-primary btn-sm ms-1 mb-1">
											<?php echo Text::_('COM_SWJPROJECTS_MORE'); ?>
										</a>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
					<div class="pagination">
						<?php echo $this->pagination->getPagesLinks(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>