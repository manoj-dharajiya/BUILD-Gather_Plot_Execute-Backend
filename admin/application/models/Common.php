<?php
class Common extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function fnInsertData($tableName,$insertData){
        $this->db->insert($tableName, $insertData);
        return $this->db->insert_id();
    }
    function fnUpdateData($tableName, $updateData, $whereArr) {
        $this->db->where($whereArr);
        $this->db->update($tableName, $updateData);
    }
    function fnGetWhere($tableName, $whereArr) {
        $query = $this->db->get_where($tableName, $whereArr);
        return $query->result_array();
    }
    function fnSelectWhere($fields, $tableName, $whereArr) {
        $this->db->select($fields);
        $query = $this->db->get_where($tableName, $whereArr);
        return $query->result_array();
    }
    function fnDeleteWhere($tableName, $whereArr) {
        foreach ($whereArr as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->delete($tableName);            
    }
    function fnGetAllData($tableName){
        $query = $this->db->get($tableName);
        return $query->result_array();
    }
    function fnCustomQuery($str){
        $query = $this->db->query($str);
        return $query->result_array();
    }
    function fnRunQuery($str){
        $this->db->query($str);
    }
    function fnGetOptions($option){
        $values = $this->fnGetWhere('settings',array('option_key' => $option));
        return ($values)?$values[0]['option_value']:"";
    }
    function fnGetUnserializeOptions($option){
        $values = $this->fnGetWhere('settings',array('option_key' => $option));        
        return ($values)?unserialize(base64_decode($values[0]['option_value'])):"";
    }    
}