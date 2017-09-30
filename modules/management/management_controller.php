<?php

    require_once('modules/templating/controller.php');
    require_once('modules/templating/template.php');
    require_once('management_model.php');
    

    class Management_Controller extends Controller{

        var $routes = array(
            ""
        );

        public function viewDefault($data){
            $model = new Management_Model();
            $template = new Template($this->getModuleDirectory(), 'index.php');
            $template->assign('sub-navigation', $this->_viewSubNavigation($data));
            $template->assign('sub-content', $this->_viewMainContent($data));
            $template->render();
        }

        public function _viewSubNavigation($data){
            $model = new Management_Model();
            $template = new Template($this->getModuleDirectory(), '_sub_navigation.php', true);
            $items = array();
            $type = $data['path'][1];

            if($type == 'forms'){
                $items = $model->getForms();
            }

            $template->assign('items', $items);
            return $template->render();
        }

        public function _viewMainContent($data){
            $model = new Management_Model();
            $template = new Template($this->getModuleDirectory(), '_sub_content_window.php', true);
            $id = $data['path'][2];
            $type = $data['path'][1];
            if($type == 'forms'){
                $items = $model->getForms();
            }
            $template->assign('form', $model->getForm($id));
            $template->assign('form_fields', $model->getFormFields($id));
            return $template->render();
        }

        public function getModuleDirectory(){
            $explode_path = explode(DIRECTORY_SEPARATOR, __FILE__);
            $mod_path = str_replace(end($explode_path), '', __FILE__);
            return $mod_path; 
        }


    }
?>