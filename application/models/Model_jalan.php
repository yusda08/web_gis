<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_jalan
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jalan extends CI_Model {

    public function getAll() {
        $query = $this->db->get('tbl_jalan');
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read($id) {
        $this->db->where('id_jalan', $id);
        $query = $this->db->get('tbl_jalan');
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

}
