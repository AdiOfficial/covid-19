<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Query_m
 *
 * @author sigit
 */
class Query_m extends CI_Model {

    //put your code here

    function getDetailByEmail($username) {
        return $this->db->query("SELECT * FROM tb_user WHERE username='$username'");
    }

    function getDetailUser($username, $password) {
        return $this->db->query("SELECT * FROM tb_user WHERE 
            username='$username' AND password=md5('$password')");
    }

    function updateAccount($table, $data, $where) {
        $this->db->where($where);
        $this->db->update('tb_user', $data);
        return $this->db->affected_rows();
    }

    function registerToDb($table, $dataInsert) {
        $this->db->insert($table, $dataInsert);
        return $this->db->affected_rows();
    }

    function removeAccountFromDb() {
        
    }

}
