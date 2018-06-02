<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_jembatan
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jembatan extends CI_Model {

    public function getAll() {
        $query = $this->db->get('tbl_jembatan');
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read($id) {
        $this->db->where('id_jembatan', $id);
        $query = $this->db->get('tbl_jembatan');
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

}
