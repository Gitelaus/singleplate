<?

    require_once('modules/templating/controller.php');
    require_once('modules/templating/template.php');
    require_once('content_model.php');

class Content_Controller extends Controller{

        function viewIndex(){
            $model = new Content_Model();
            $template = new Template($this->getModuleDirectory(), 'index.php', 0, "modules/content/views/_header.php", "modules/content/views/_footer.php");
            $template->assign('form', $model->getFormFields(1));
            $template->render();
        }

        public function getModuleDirectory(){
            $explode_path = explode(DIRECTORY_SEPARATOR, __FILE__);
            $mod_path = str_replace(end($explode_path), '', __FILE__);
            return $mod_path;
        }
    }

?>