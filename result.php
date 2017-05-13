<?php

	$style = isset($_POST['style'])? intval($_POST['style']): 0;
	$layout = isset($_POST['layout'])? intval($_POST['layout']): 0;
	$padding = isset($_POST['padding'])? intval($_POST['padding']): 0;
	$separator = isset($_POST['separator'])? substr($_POST['separator'], 0, 1): ';';

	$format = isset($_POST['format'])? strip_tags($_POST['format']): 'html';
	$text = isset($_POST['input'])? $_POST['input']: '';
	if ($format == 'html') $text = strip_tags($text);

	require_once "BoxChars.php";
	$box = new BoxChars();
	$box->setText($text);
	$box->setStyle($style);
	$box->setLayout($layout);
	$box->setPadding($padding);
	$box->setSeparator($separator);

	if ($format == 'text') {
		header('Content-Type: text/plain; charset=utf-8');
		echo $box->text();
		exit();
	}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Result</title>
</head>
<body>
<h1>Result</h1>
<p>|
	style=<?php echo $box->getStyle() ?>|
	layout=<?php echo $box->getLayout() ?>|
	padding=<?php echo $box->getPadding() ?>|
	separator=<?php echo $box->getSeparator() ?>|
</p>
<?php
	echo $box->html();
?>
<p><a href=".">Form</a></p>
</body>
</html>
