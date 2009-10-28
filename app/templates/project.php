<?php $this->wrap('layout'); ?>

	<div class="project">
		<h2><?php echo $project->title; ?></h2>
		<p><?php echo $project->description; ?></p>
		<div class="button"><a href="/build/start/<?php echo $project->name; ?>">Build</a></div>
	
		<?php

			$passes = $project->getPassCountSeries();
			$fails = $project->getFailCountSeries();		

		?>

		<img src="http://chart.apis.google.com/chart?chs=400x145&cht=ls&chm=B,629F24,0,0,0|B,AF2015,1,1,0&chco=629F24,AF2015&chd=t:<?php echo $passes, "|", $fails; ?>
">

	</div>
	
	<div class="log">
		<h2>Build History</h2>	
		<br>

		<?php foreach($project->builds as $build): ?>
			<ul>
				<li>
					<p class="build-label <?php echo $build->isGreen() ? 'pass' : 'fail'; ?>"><a href="/build/<?php echo $build->identifier; ?>"><?php echo $build->project->title; ?>: <?php echo $build->identifier; ?> at <?php echo $build->at->format('H:i, jS M'); ?></a></p>
				</li>
			</ul>			
		<?php endforeach; ?>
		
	</div>
	
