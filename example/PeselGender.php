<?php
require __DIR__.'/../vendor/autoload.php';

use TomaszKr\Pesel as Pesel;

$pesel = new Pesel("07241619910");

?>

<html>
<head>
<title> Pesel All </title>
</head>
<body>
<table>
	<tr>
		<th>Number PESEL</th>
		<td><?= $pesel->getNumber(); ?></td>	
	</tr>
	<tr>
		<th>isCorrect</th>
		<td><?= $pesel->isCorrect()? "TRUE" : "FALSE"; ?></td>	
	</tr>
	<tr>
		<th>Gender</th>
		<td><?= $pesel->whatGender(); ?></td>	
	</tr>
</table>
</body>
</html>
