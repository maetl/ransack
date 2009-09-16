<style type="text/css">
.error { background-color:red; }
</style>

<h1>Welcome to Ransack</h1>

<p>Configure your installation:</p>

<form method="post" action="/install">

<table>

<tr <?php if (version_compare(PHP_VERSION, '5.2.0', '<')): echo 'class="error"'; endif; ?>>
	<td>PHP Version</td>
	<td><strong><?php echo PHP_VERSION ?></strong></td>
</tr>

<tr <?php if (function_exists('mysql_query') != true): echo 'class="error"'; endif; ?>>
	<td>Storage</td>
	<td><strong><?php echo $storage; ?></strong></td>
</tr>

<tr>
	<td>MySQL Host</td>
	<td><input type="text" name="DB_HOST"></td>
</tr>

<tr>
	<td>MySQL User</td>
	<td><input type="text" name="DB_USER"></td>
</tr>

<tr>
	<td>MySQL Password</td>
	<td><input type="text" name="DB_HOST"></td>
</tr>


<tr>
	<td>MySQL Database Name</td>
	<td><input type="text" name="DB_HOST"></td>
</tr>

</table>

<button>Install...</button>

</form>