<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_koordinatjalan
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_koordinatjalan extends CI_Model {

    public function create(){
        foreach ($this->cart->contents() as $koordinat) {
            $data = array('id_jalan' => $this->input->post('id_jalan'),
                'latitude'=>$koordinat['latitude'],
                'longitude'=>$koordinat['longitude']);
            $query = $this->db->insert('koordinatjalan', $data);
        }
        return $query;
    }
    public function getAll(){
        $query = $this->db->get('koordinatjalan');//mengambil semua data koordinat jalan
        return $query;
    }
    public function getbyidjalan($id){
        $this->db->where('id_jalan', $id);
        $query = $this->db->get('koordinatjalan');//mengambil semua data koordinat jalan
        return $query;
    }
    public function read($id){
        $this->db->where('id_koordinatjalan', $id);//mengambil data koordinat jalan berdasarkan id_koordinatjalan
        $query = $this->db->get('koordinatjalan');
        return $query;
    }
    public function update(){
        $data = array('id_jalan'=>$this->input->post('id_jalan'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'));
        $this->db->where('id_koordinatjalan', $this->input->post('id_koordinatjalan'));//mengupdate berdasarkan id_koordinatjalan
        $query = $this->db->update('koordinatjalan', $data);
        return $query;
    }
    public function delete(){
        $this->db->where('id_koordinatjalan', $this->input->post('id_koordinatjalan'));//menghapus berdasarkan id_koordinatjalan
        $query = $this->db->delete('koordinatjalan');
        return $query;
    }
    public function deletebyidjalan($id){
        $this->db->where('id_jalan', $id);//menghapus berdasarkan id_koordinatjalan
        $query = $this->db->delete('koordinatjalan');
        return $query;
    }

}

/* End of file model_koordinatjalan.php */
/* Location: ./application/models/model_koordinatjalan.php */