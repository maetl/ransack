<?php $this->wrap('layout'); ?>
	
	<div class="project">
		<h2>Latest Builds</h2>
	</div>
	
	<?php foreach($builds as $build): ?>
	
	<div class="log">
		<ul>
			<li>
				<p class="build-label"><a href="/build/<?php echo $build->identifier; ?>"><?php echo $build->project->title; ?>: <?php echo $build->identifier; ?> at <?php echo $build->at->format('Y-n-d H:i:s'); ?></a></p>
				<p class="build-summary"><?php echo ($build->isComplete) ? 'Completed in [%] seconds.' : 'Failed.'; ?></p>
				<p><?php echo $build->log ?></p>
			</li>
		</ul>
	</div>
	
	<?php endforeach; ?>
	