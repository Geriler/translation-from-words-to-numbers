<?php
require_once "./numbers.php";
$_POST['number'] = mb_strtolower($_POST['number']);
preg_match_all('/\w+/mu', $_POST['number'], $matches);
$matches = $matches[0];
$numRegex = sizeof($matches);
$summ = 0;
$million = 0;
$thousand = 0;
for ($i = 0; $i < $numRegex; $i++) {
	if (preg_match('/миллион/mu', $matches[$i])) {
		$million = $i;
		break;
	}
}
for ($i = 0; $i < $numRegex; $i++) {
	if (preg_match('/тысяч/mu', $matches[$i])) {
		$thousand = $i;
		break;
	}
}
$summ = solve(0, $million, $matches, $numbers, $summ, 1000000);
$summ = solve($million, $thousand, $matches, $numbers, $summ, 1000);
$summ = solve($thousand, $numRegex, $matches, $numbers, $summ, 1);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Перевод из слов в числа</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/style.css">
	</head>
	<body>
		<div class="container">
			<h2>Перевод из слов в числа</h2>
			<hr>
			<div class="form">
				<form action="index.php" method="post">
					<input type="text" name="number" value="<?=$_POST['number']?>">
					<input class="btn btn-primary" type="submit" value="Перевести">
				</form>
			</div>
			<hr>
			<div class="number">
				<p>
					<?=$summ?>
				</p>
			</div>
		</div>
	</body>
</html>
