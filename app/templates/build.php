<?php $this->wrap('layout'); ?>

	<div class="project">
		<h2><?php echo $build->project->title ?> &raquo; Build <?php echo $build->identifier; ?></h2>
		<p><?php echo $build->at->format('Y-n-d H:i:s'); ?></p>
	</div>
	
	<div class="log">
		<h3 class="build-label"><?php echo $build->summary; ?></h3>
		
		<?php foreach($build->reports as $report): ?>
			
		<div class="report">
			<h5><?php echo $report->identifier; ?></h5>
			<p><?php echo $report->summary; ?></p>
			<pre><?php echo $report->report; ?></pre>
		</div>
			
		<?php endforeach; ?>
		
	</div>
	
