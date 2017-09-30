<?php
class Database{
    var $db;

    public function __construct(){
        $this->$db = new mysqli('localhost','root','', 'pcms');
    }

    public function getDatabase(){
        return new mysqli('localhost','root','', 'pcms');   
    }

    public function get($statement = array()){
        if(!$statement['table']){
            return null;
        }
        $table_name = $statement['table'];        
        $columns = $statement['columns'] ? $statement['columns'] : '*';
        $where = $statement['where'] ? " WHERE " . $statement['where'] : '';
        $query = "SELECT " . $columns . " FROM " . $table_name.$where;
        $res = $this->$db->query($query);
        return $res;
    }
}

?>