<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_koordinatjembatan
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_koordinatjembatan extends CI_Model {

    public function create(){
        $data = array('id_jembatan' => $this->input->post('id_jembatan'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'));
        $query = $this->db->insert('tbl_koordinatjembatan', $data);
        return $query;
    }
    public function getAll(){
        $query = $this->db->get('tbl_koordinatjembatan');//mengambil semua data koordinat jembatan
        return $query;
    }
    public function getbyidjembatan($id){
        $this->db->where('id_jembatan', $id);
        $query = $this->db->get('tbl_koordinatjembatan');
        return $query;
    }
    public function read($id){
        $this->db->where('id_koordinatjembatan', $id);//mengambil data koordinat jembatan berdasarkan id_koordinatjembatan
        $query = $this->db->get('tbl_koordinatjembatan');
        return $query;
    }
    public function update(){
        $data = array('id_jembatan'=>$this->input->post('id_jembatan'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'));
        $this->db->where('id_koordinatjembatan', $this->input->post('id_koordinatjembatan'));//mengupdate berdasarkan id_koordinatjembatan
        $query = $this->db->update('tbl_koordinatjembatan', $data);
        return $query;
    }
    public function delete(){
        $this->db->where('id_koordinatjembatan', $this->input->post('id_koordinatjembatan'));//menghapus berdasarkan id_koordinatjembatan
        $query = $this->db->delete('tbl_koordinatjembatan');
        return $query;
    }
    public function deletebyidjembatan($id){
        $this->db->where('id_jembatan', $id);
        $query = $this->db->delete('tbl_koordinatjembatan');
        return $query;
    }

}

/* End of file model_koordinatjembatan.php */
/* Location: ./application/models/model_koordinatjembatan.php */