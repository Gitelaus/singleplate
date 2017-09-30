<?php

require_once('modules/database/database.php');

class Content_Model {

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
//        print_r($res->fetch_all());die;
//        while($row = $res->fetch_assoc()){
//            print_r($row);
//        }
//        die;
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}
?>