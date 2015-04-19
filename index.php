<?php
session_start();

$site_root = "http://mastodon.tk";

// include "lib/Load.php";
foreach (glob("util/*.php") as $filename) {
    include $filename;
}

if (!empty($_GET['l'])) {
	if (Language::exists($_GET['l'])) {
		$language = $_GET['l'];
	} else {
		$language = Language::best();
		$url = "";
		$break = explode('/', $_SERVER['REQUEST_URI']);
		foreach($break as $item) {
			if ($item != null && $item != "" && !empty($item) && $item != "refresh" && $item != $_GET['l']) {
				$url .= "/".$item;
			}
		}
		$url .= "/".$language;
		header("Location: ".$url);
		exit;
	}
} else {
	$language = Language::best();
	$url = "";
	$break = explode('/', $_SERVER['REQUEST_URI']);
	foreach($break as $item) {
		if ($item != null && $item != "" && !empty($item) && $item != "refresh") {
			$url .= "/".$item;
		}
	}
	$url .= "/".$language;
	header("Location: ".$url);
	exit;
}

//var_dump(Language::get_missing($language));

$cache = new Cache();
//$cache->disable();

if (isset($_SESSION['post_data'])) {
    $_POST = $_SESSION['post_data'];
    $_SERVER['REQUEST_METHOD'] = 'POST';
    unset($_SESSION['post_data']);
    //var_dump($_POST);
    $alert = "<div class='alert alert-danger alert-dismissible' role='alert'>
		  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  <h4>".$_POST['title']."</h4><p>".$_POST['message']."</p>
		</div>";
}

if (empty($_GET['u']) && empty($_GET['c']) && empty($_GET['r'])) {
	include("view/Header.php");
	$cache->start();
	include("view/Footer.php");
	$cache->close();
	exit;
}

foreach (glob("model/*.php") as $filename) {
    include $filename;
}

if (!empty($_GET['u']) && !empty($_GET['c']) && !empty($_GET['r']) && $_GET['r'] == "refresh") {
	$cache->remove();
	if (class_exists(Resque)) {
		Resque::enqueue("defaut", "CacheJob", array(
			'username' => $_GET['u'],
			'console' => $_GET['c']
		), true);
	}
	$url = "";
	$break = explode('/', $_SERVER['REQUEST_URI']);
	foreach($break as $item) {
		if ($item != null && $item != "" && !empty($item) && $item != "refresh") {
			$url .= "/".$item;
		}
	}
	header("Location: ".$url);
	exit;
}

echo "<!-- Selected language is ".$language." -->\n";

if (!empty($_GET['u']) && !empty($_GET['c'])) {
	$username = rawurlencode(trim($_GET['u']));
	$console = $_GET['c'];
	include("view/StartupRequests.php");
	include("view/Header.php");
	$cache->start();
	include("view/Player.php");
	include("view/Footer.php");
	$cache->close();
} else {
	header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
	if (isset($_SERVER['HTTP_REFERER'])) {
  	$_SESSION['post_data'] = array("title" => "Missing information", "message" => "You need to specify both the console and the username.");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	exit;
}

?>