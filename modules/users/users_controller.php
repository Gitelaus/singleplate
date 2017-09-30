<?php

    require_once('modules/templating/controller.php');
    require_once('modules/templating/template.php');
    
    class Users_Controller extends Controller{

        public function viewLogin(){
            $template = new Template($this->getModuleDirectory(), 'login.php');
            $template->assign('', '');
            $template->render();
        }

        public function processLogin(){
            $this->checkLogin($_POST['username'], $_POST['password']);      
            $this->viewLogin();
        }

        public function processLogout(){
            session_unset($_SESSION['username']);
            header('Location:/users/login');
        }

        function checkLogin($username, $password){
            $db = (new Database())->getDatabase();
            $stripped_username = $db->real_escape_string($username);
            $stripped_password = $db->real_escape_string($password);            
            $res = $db->query("SELECT * FROM u_users WHERE username='$username' AND password='$password'");
            if($res->num_rows >= 1){
                $row = $res->fetch_assoc();
                $login_token = password_hash($stripped_username . $_SERVER['REMOTE_ADDR'], PASSWORD_DEFAULT);
                $update = $db->query("UPDATE u_users SET login_token='$login_token' WHERE id='" . $row['id'] .  "'");
                $_SESSION['username'] = $stripped_username;
                $_SESSION['login_token'] = $login_token;
                header('Location:/management/index');
            }
        }
        

        public function getModuleDirectory(){
            $explode_path = explode(DIRECTORY_SEPARATOR, __FILE__);
            $mod_path = str_replace(end($explode_path), '', __FILE__);
            return $mod_path; 
        }


    }
?>