<?php

class Template {
    var $module_name;
    var $file;
    var $values;
    var $partial;
    var $header;
    var $footer;

    public function __construct($module_path, $file, $partial = 0, $header = "modules/templating/_header.php", $footer = "modules/templating/_footer.php") {
        $module_w = explode('\\', $module_path);
        end($module_w);prev($module_w);
        $this->module_name = current($module_w);
        $this->file = $module_path . "views" . DIRECTORY_SEPARATOR . $file;
        $this->partial = $partial;
        $this->header = $header;
        $this->footer = $footer;
    }

    public function assign($key, $value){
        $this->values[$key] = $value;
    }

    public function render(){
        if (!file_exists($this->file)) {
            return "Error loading template file ($this->file).";
        }
        $p = $this->values;
        $p['module'] = $this->module_name;
        if($this->partial){
            ob_start();
            include($this->file);
            $template = ob_get_contents();
            ob_end_clean();
            return $template;
        }else{
            include($this->header);
            include($this->file);
            include($this->footer);
        }
    }
}

?>