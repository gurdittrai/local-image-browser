<?php
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
$url_base = $protocol . $_SERVER['HTTP_HOST'];
$url_loc = $_SERVER['REQUEST_URI'];
$title = "Images";
$loc = "";

// location
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$loc = $_GET["dir"];
	if (isset($loc)) {
		$loc = htmlspecialchars($_GET["dir"]);
		$title = $loc;
	} else {
		$loc = "";
	}
}

// path to directory to scan
if ($loc == "") {
	$directory = "./*";
} else {
	$directory = $loc . "/*";
}

// get location
$url_loc = substr($url_loc, 0, strrpos($url_loc, '.php') + 1);
$url_loc = substr($url_loc, 0, strrpos($url_loc, '/') + 1);

$files = glob($directory, GLOB_ONLYDIR);
$ref = $url_base . $url_loc . "gallery.php?dir=";
$dirRef = $ref . $loc;

// search current folder
$switch = "	<a href=\"$dirRef\" style=\" margin: auto; \">
			<i class=\"far fa-images\" style=\"font-size: 5em; margin: auto; padding: 3vh; \"> Open Images Here</i>
			</i></a>";

$content = "";

// get count
$nImgs = count($files);
if ($nImgs > 0) {
	for ($i = 0; $i < $nImgs; $i++) {
		if ($files[$i][0] == '.') {
			$dir = substr($files[$i], 2);
		} else {
			$dir = $files[$i];
		}
		$dirRef = $ref . $dir;

		// get all image files with a .jpg extension.
		$images = glob("$files[$i]/*.{JPG,jpg,jpeg,png,gif}", GLOB_BRACE);

		// sort images
		sort($images);

		// check images
		if (!(count($images) > 0)) {
			$img = "assets/empty.png";
		} else {
			$img = $images[0];
		}

		$folder_name = strpos($dir, "/") ? substr($dir, strrpos($dir, '/') + 1) : $dir;
		$folder_create = date("F d Y", filectime($dir));
		$folder_modifd = date("F d Y", filemtime($dir));
		$folder_size = count($images);
		$folder_dirs = count(glob("$files[$i]/*", GLOB_ONLYDIR));

		$content .= "<a href=\"$dirRef\" target=\"_blank\" style=\"text-decoration: none;\"> 
				<div class=\"folder\"> 
				<div class=\"folder-icon\"> <img src=\"$img\" class=\"img\" /> </div>
				<div class=\"folder-info\"> 
				<div class=\"folder-title\">$folder_name</div>
				<div class=\"folder-date\">Folders: $folder_dirs</div>
				<div class=\"folder-date\">Images: $folder_size</div>
				<div class=\"folder-date\">Date Created: $folder_create</div>
				<div class=\"folder-date\">Last Modified: $folder_modifd</div>
				</div></div></a>";
	}
} else {
	$content .= "<h1>Empty</h1>";
}

include 'styles/Template_List.php';
