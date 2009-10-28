<?php $this->wrap('layout'); ?>

	<div class="project">
		<h2><a href="/project/<?php echo $build->project->name ?>"><?php echo $build->project->title ?></a> &raquo; Build <?php echo $build->identifier; ?></h2>
		<p><?php echo $build->at->format('Y-n-d H:i:s'); ?></p>
	</div>
	
	<div class="log">
		<ul>
		
		<?php foreach($build->tests as $test): ?>
			
		<li>
			<p class="build-label <?php echo $build->isGreen() ? 'pass' : 'fail'; ?>"><?php echo $test->passes; ?> passes, <?php echo $test->failures; ?> failures, and <?php echo $test->exceptions; ?> exceptions.</p>
			<div class="build-summary">
				<pre><?php echo wordwrap($test->output, 112); ?></pre>
			</div>
		</li>
			
		<?php endforeach; ?>
		
		<?php foreach($build->reports as $report): ?>
		<li>	
			<p class="build-label"><?php echo $report->identifier; ?></p>
			<p><?php echo $report->summary; ?></p>
			<div class="build-summary"><pre><?php echo $report->report; ?></pre>
		</div></li>
		<?php endforeach; ?>
		</ul>
	</div>
	
