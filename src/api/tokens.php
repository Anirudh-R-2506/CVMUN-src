<?php
class DB {
 
    public function __construct(){
        if(!isset($this->db)){
            $conn = new mysqli("localhost","id15013809_testing","-b1jxNuDcR%hNl@b","id15013809_test");
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
  
    public function is_table_empty() {
        $result = $this->db->query("SELECT id FROM token");
        if($result->num_rows) {
            return false;
        }
  
        return true;
    }
  
   public function get_access_token() {
        $sql = $this->db->query("SELECT access_token FROM token");
        $result = $sql->fetch_assoc();
        return json_decode($result['access_token']);
    }
  
    public function get_ref_token() {
        $sql = $this->db->query("SELECT refresh_token FROM token");
        $result = $sql->fetch_assoc();
        return json_decode($result['refresh_token']);
    }
  

    public function put_access_token($token) {
        if($this->is_table_empty()) {
            $this->db->query("INSERT INTO token(access_token) VALUES('$token')");
        } else {
            $this->db->query("UPDATE token SET access_token = '$token' WHERE id = (SELECT id FROM token)");
        }
    }
    
    public function put_ref_token($token) {
        if($this->is_table_empty()) {
            $this->db->query("INSERT INTO token(refresh_token) VALUES('$token')");
        } else {
            $this->db->query("UPDATE token SET refresh_token = '$token' WHERE id = (SELECT id FROM token)");
        }
    }
}

