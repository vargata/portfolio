<?php

class db
{    
    private $conn;
    
    private $db_host;
    private $db_user;
    private $db_pwd;
    private $db_name;
    
    private $sql_list = array();
    private $param_list = array();
    
    function __construct($db_host, $db_user, $db_pwd, $db_name){
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pwd = $db_pwd;
        $this->db_name = $db_name;
    }
    
    function add_query($sql_name, $sql){
        $this->sql_list[$sql_name] = $sql;
    }
    
    function add_params($sql_name, string $type_string, array $params){
        $this->param_list[$sql_name] = array("type_string" => $type_string, "params" => $params);
    }
    
    function connect_db(){
        $ret = true;
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->conn = @mysqli_connect($this->db_host, $this->db_user, $this->db_pwd, $this->db_name);
        if(!$this->conn){
            $ret = false;
        }
        return $ret;
    }
    
    function get_Data($sql_name){
        if($this->conn){
            $returndata = array();
            
            $sql = $this->sql_list[$sql_name];
            $stmt = mysqli_prepare($this->conn, $sql);
            if(isset($this->param_list[$sql_name])){
                $stmt->bind_param($this->param_list[$sql_name]["type_string"], ...$this->param_list[$sql_name]["params"]);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            
            $counter = 0;
            while($row = $result->fetch_assoc()){
                foreach($row as $key => $value)
                    $returndata["row" . $counter][$key] = $value;
                $counter++;
            }
            
            $stmt->close();
            return $returndata;
        }
    }
    
    Function save_Data($sql_name){
        $returndata = false;
        if($this->conn){
            $sql = $this->sql_list[$sql_name];
            $stmt = mysqli_prepare($this->conn, $sql);
            if(isset($this->param_list[$sql_name])){
                $stmt->bind_param($this->param_list[$sql_name]["type_string"], ...array_values($this->param_list[$sql_name]["params"]));
            }
            $stmt->execute();
            $returndata = $stmt->affected_rows;
            if($returndata < 1)
                $returndata = 0;
        }
        $stmt->close();
        return $returndata;
    }
    
    function close_db(){
        if($this->conn)
            $this->conn->close();
    }
}

?>