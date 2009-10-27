<?php $this->wrap('layout'); ?>

<div class="col-b">

<?php if (empty($projects)): ?>
	
	<div class="project">
		<h2>No projects are installed...</h2>
	</div>

<?php else: ?>	

	<div class="project">
		<p>Projects:</p>

		<?php foreach($projects as $project): ?>

		<h3>&raquo; <a href="/project/<?php echo $project->name; ?>"><?php echo $project->title; ?></a></h3>

		<?php endforeach; ?>

	</div>

<?php endif; ?>

</div>

<div class="col-a">
	
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
				<p class="build-label <?php echo $build->isGreen() ? 'pass' : 'fail'; ?>"><a href="/build/<?php echo $build->identifier; ?>"><?php echo $build->project->title; ?>: <?php echo $build->identifier; ?> at <?php echo $build->at->format('H:i, jS M'); ?></a></p>
			</li>
		</ul>
	</div>
	
	<?php endforeach; endif; ?>

</div>
