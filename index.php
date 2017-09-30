<?php
	error_reporting( error_reporting() & ~E_NOTICE );

	// Module Redirectories
	$modules = array(
		"users" => array(
			"directory" => "users",
            "url_match" => "/users(.*)/i",
            "auth_required" => false,
			"routes" => array(
				"/users\/login/i" => "viewLogin",
				"/users\/process\/login/i" => "processLogin",
				"/users\/process\/logout/i" => "processLogout",
                "/users\/.*/i" => "viewLogin",
            )
		),
		"management" => array(
			"directory" => "management",
            "url_match" => "/management(.*)/i",
            "auth_required" => true,
            "routes" => array(
                "/management\/.*/i" => "viewDefault"
            )
		),
		"content" => array(
			"directory" => "content",
			"url_match" => "/^(?!MODULES).*/i",
			"auth_required" => false,
            "routes" => array(
                "/.*/i" => "viewIndex"
            )
		)
	);

	require_once('modules/database/database.php');	
	session_start();

	function requireToVar($file){
		ob_start();
		require($file);
		return ob_get_clean();
	}

	function route(){
		global $modules;
		$url = $_GET['path'];
		$module = matchModule($url);
		$module_name = $module['directory'];
		list($route, $function) = matchRoute($url, $module);

		if($module['auth_required']){
			if(!isset($_SESSION['username']) || !isset($_SESSION['login_token'])){
				header('Location:/users/login', true, 302); exit;					
			}else{
				$db = (new Database())->getDatabase();	
				$username = $_SESSION['username'];		
				$client_hash = $_SESSION['login_token'];
				$res = $db->query("SELECT * FROM u_users WHERE username='$username' AND login_token='$client_hash'");
				if($res->num_rows < 1){
					header('Location:/users/process/logout', true, 302); exit;	
				}
			}
		}

		$dir_sep = DIRECTORY_SEPARATOR;
		$file = "modules$dir_sep$module_name$dir_sep$module_name" . "_controller.php";

		if (!file_exists($file)) {
            echo "Error loading template file ($file).";
		}

		require($file);
		$controller_name = ucfirst($module_name) . "_Controller";
		$controller = new $controller_name($function, array("route" => $route, "path" => explode('/', $url)));
	}

	function matchModule($str){
		global $modules;
		foreach($modules as $modulename => $module){
			$url_match = str_replace('MODULES', getModuleNamesRegex(), $module['url_match']);
			if(preg_match($url_match, $str)){
				return $module;
			}
		}
	}

	function matchRoute($str, $module){
		foreach($module['routes'] as $route => $function){
			if(preg_match($route, $str)){
				return array($route, $function);
			}
		}
	}

	function getModuleNamesRegex(){
		global $modules;
		return implode(array_keys($modules), '|');
	}

	route();
?>

