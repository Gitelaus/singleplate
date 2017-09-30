<?php

    require_once('modules/database/database.php');

    class Management_Model {
        
        var $db;
        
        function __construct(){
            global $db;
            $this->$db = new Database();
        }
        
        function getFormData($data = array()){
            
        }

        function getForms(){
            global $db;
            $res = $this->$db->get(array(
                "table" => "f_forms"
            ));
            return $res;
        }

        function getForm($id){
            global $db;
            $res = $this->$db->get(array(
                "table" => "f_forms",
                "where" => "id='$id'"
            ));
            return $res;
        }

        function getFormFields($form_id){
            global $db;
            $res = $this->$db->get(array(
                "table" => "f_form_fields",
                "where" => "form_id='$form_id'"
            ));
            return $res;
        }
    }
?>