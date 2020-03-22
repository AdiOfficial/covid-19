<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hacked
 *
 * @author sigit
 */
class Hacked extends CI_Controller {

    function register() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama = $this->input->post('nama');
        // $terdaftarPada = $this->input->post('terdaftarPada');

        //prepare the data
        $dataInsert = [
        	'username' => $username,
        	'password' => md5($password),
        	'nama' => $nama,
        	'terdaftar_pada' => date('Y-m-d H:i:s')
        ];
        //do insert
        $result = $this->query->registerToDb('tb_user', $dataInsert);
        if($result > 0){
        	echo json_encode(['message' => 'registrasi berhasil', 'code' => 200]);
        }else{
        	echo json_encode(['message' => 'registrasi gagal', 'code' => 500]);
        }


    }

    function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('paswd');

        $data['data'] = [];
        $result = $this->query->getDetailUser($username, $password);
        // var_dump($result);

        //check the rows
        $rows = $result->num_rows();
        if($rows > 0){
        	$data['data'] = $result->row();
        	$data['message'] = 'data found';
        	$data['code'] = 200;
        	print(json_encode($data));
        }else{
        	echo json_encode(['message' => 'data tidak ada', 'code' => 500]);
        }
    }

    function update_profile() {
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');

        //prepare data for update
        $dataUpdate = [
        	'nama' => $nama,
        	'password' => $password
        ];

        //prepare the where clause
        $whereClause = [
        	'username' => $username
        ];

        //do update
        $result = $this->query->updateAccount('tb_user', $dataUpdate, $whereClause);
        if($result > 0){
        	echo json_encode(['message' => 'data berhasil diubah', 'code' => 200]);
        }else{
        	echo json_encode(['message' => 'data gagal diubah', 'code' => 500]);
        }
    }

    function get_detail_by_email()
    {
        $username = $this->input->post('username');
        $res = $this->query->getDetailByEmail($username);
        if($res->num_rows() > 0){
            $data['data'] = $res->row();
            $data['message'] = 'data ditemukan';
            $data['code'] = 200;
            echo json_encode($data);
        }else{
            echo json_encode(['message' => "data tidak ada", 'code' => 404]);
        }
    }

    function delete_account() {
        
    }
}
