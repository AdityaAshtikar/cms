<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<link rel="stylesheet" href="assets/bs4/bs4.min.css">
	<link rel="stylesheet" href=<?php if(isset($cssStyle)) echo $cssStyle;?>>
	<script src="assets/bs4/jquery.min.js"></script>
	<script src="assets/bs4/jqueryui.min.js"></script>
	<script src="assets/bs4/popper.min.js"></script>
	<script src="assets/bs4/bs4.min.js"></script>
</head>
<body>