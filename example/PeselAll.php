<?php
require __DIR__.'/../vendor/autoload.php';

use Validation\Pesel as Pesel;

$pesel = new Pesel("07241619910");
?>

<html>
<head>
<title> Pesel all information</title>
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
		<th>Birthday</th>
		<td><?= $pesel->getBirthday()->format('Y-m-d'); ?></td>	
	</tr>
	<tr>
		<th>Gender</th>
		<td><?= $pesel->whatGender(); ?></td>	
	</tr>
</table>
</body>
</html>
