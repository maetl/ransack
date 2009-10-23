<?php $this->wrap('layout'); ?>

	<div class="project">
		<h2><?php echo $project->title; ?></h2>
		<p><?php echo $project->description; ?></p>
		<div class="button"><a href="/build/start/<?php echo $project->name; ?>">Build</a></div>
	</div>
	
	<div class="log">
		
		<?php foreach($project->builds as $build): ?>
			<ul>
				<li>
					<p class="build-label <?php echo $build->isGreen() ? 'pass' : 'fail'; ?>"><a href="/build/<?php echo $build->identifier; ?>"><?php echo $build->project->title; ?>: <?php echo $build->identifier; ?> at <?php echo $build->at->format('Y-n-d H:i:s'); ?></a></p>
					<p class="build-summary"><?php echo ($build->isComplete) ? 'Completed in [%] seconds.' : 'Failed.'; ?></p>
					<p><?php echo $build->log ?></p>
				</li>
			</ul>			
		<?php endforeach; ?>
		
	</div>
	
