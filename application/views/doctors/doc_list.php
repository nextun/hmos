<h1><?php echo $header;?>
<table border="1">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Mobile</th>
		<th>Action</th>


	</tr>
	<?php 
	foreach ($doctorslist as $rows) {
		echo	"<tr>
				<td>".$rows->id."</td>
				<td>".$rows->name."</td>
				<td>".$rows->mobile."</td>
				<td>Edit Delete</td>
			</tr>";

	} 
	?>
</table>
<?php echo $pages;?>