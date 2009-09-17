<h1>Ransack</h1>

<h2>Projects</h2>

<table>
<?php foreach($projects as $project): ?>
<tr>
<td><?php echo $project->name; ?></td>
</tr>
<?php endforeach; ?>
</table>