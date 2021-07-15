<?php
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
$url_base = $protocol . $_SERVER['HTTP_HOST'];
$url_loc = $_SERVER['REQUEST_URI'];
$title = "Images";

function get_ratio($a, $b)
{
	$size = 0;
	// base size
	if ($a >= 1080) {
		$size += 1;
	}
	// ratio
	if (($a * 2) < $b) {
		$size += 3;
	} elseif (($a * 1.3) < $b) {
		$size += 2;
	} else {
		$size += 1;
	}
	return strval($size);
}
function get_img_prty($size)
{
	$width = $size[0];
	$height = $size[1];

	$classW = get_ratio($height, $width);
	$classH = get_ratio($width, $height);

	return "w-$classW h-$classH";
}

// path to directory to scan
$directory = "/*";
$dir = ".";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$dir = $_GET["dir"];
	if (isset($dir)) {
		$dir = htmlspecialchars($_GET["dir"]);
		// title
		if ($dir != '') {
			$title = strpos($dir, "/") === false ? $dir : substr($dir, strpos($dir, "/") + 1);
		}
	} else {
		$dir = "";
	}
}
$directory = $dir . $directory;

// url
$url_loc = substr($url_loc, 0, strrpos($url_loc, '.php') + 1);
$url_loc = substr($url_loc, 0, strrpos($url_loc, '/') + 1);

// get all image files with a .jpg extension.
$images = glob("" . $directory . "*.{JPG,jpg,jpeg,png,gif}", GLOB_BRACE);
$run = count($images);
$ref_folder = $url_base . $url_loc . "list.php?dir=";
$dirRef = $ref_folder . $dir;

// search current folder
$switch = "	<a href=\"$dirRef\" style=\" margin: auto; \">
				<i class=\"far fa-folder\" style=\"font-size: 5em; margin: auto; padding: 3vh; \"> Check Sub-Directory</i>
			</i></a>";

$content = "<div class=\"grid\" id=\"gallery\" >";

// select first 20 images in randomized array
$imgs = array_slice($images, 0, $run);
natsort($imgs);

// images class=\"image-popup\"
$i = 0;
foreach ($imgs as $img) {
	$img_size = getimagesize($img);
	$img_kind = get_img_prty($img_size);
	$content .= "<div class=\"grid-item $img_kind\" >
				<div class=\"image\">
				<a href=\"$img\" target=\"_blank\">
				<img src=\"$img\"/ loading=\"lazy\" alt=\"$img\">
				</a></div></div>";
}
$content .= "</div>";

unset($imgs);

include 'styles/Template.php';
