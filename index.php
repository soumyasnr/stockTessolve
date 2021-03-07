<!DOCTYPE html>
<html>
<head>
	<title>Stock Tool</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<table width="600">
		<form action="upload.php" method="post" enctype="multipart/form-data">
		<!-- <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data"> -->

			<tr>
				<td width="20%">Select file</td>
				<td width="80%"><input type="file" name="file" id="file" required /></td>
			</tr>
			<tr>
				<td width="20%">Company Name</td>
				<td width="80%"><input type="text" name="company" id="company" required/></td>
			</tr>
			<tr>
				<td width="20%">Start date</td>
				<td width="80%"><input type="date" name="startDate" id="startDate" required /></td>
			</tr>
			<tr>
				<td width="20%">End date</td>
				<td width="80%"><input type="date" name="endDate" id="endDate" required /></td>
			</tr>
			<tr>
				<td>Submit</td>
				<td><input type="submit" name="submit" /></td>
				<input type="reset" value="Clear" />
			</tr>

		</form>
	</table>
</body>
</html>
