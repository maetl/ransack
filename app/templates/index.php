<?php $this->wrap('layout'); ?>
	
<?php if (empty($projects)): ?>
	
	<div class="project">
		<h2>No projects are installed...</h2>
	</div>

<?php else: ?>	



<?php foreach($projects as $project): ?>

	<div class="project">
		<p>Project:</p>
		<h3><a href="/project/<?php echo $project->name; ?>"><?php echo $project->title; ?></a></h3>
	</div>

<?php endforeach; endif; ?>

	
	<?php if (empty($builds)): ?>
		
		<div class="project">
			<h2>No projects have been built yet...</h2>
		</div>
	
	<?php else: ?>	
	
		<div class="project">
			<h2>Latest Builds</h2>
		</div>
	
	<?php foreach($builds as $build): ?>
	
	<div class="log">
		<ul>
			<li>
				<p class="build-label <?php echo $build->isGreen() ? 'pass' : 'fail'; ?>"><a href="/build/<?php echo $build->identifier; ?>"><?php echo $build->project->title; ?>: <?php echo $build->identifier; ?> at <?php echo $build->at->format('Y-n-d H:i:s'); ?></a></p>
				<p class="build-summary"><?php echo ($build->isComplete) ? 'Completed in [%] seconds.' : 'Failed.'; ?></p>
				<p><?php echo $build->log ?></p>
			</li>
		</ul>
	</div>
	
	<?php endforeach; endif; ?>
	