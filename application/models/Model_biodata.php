<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Biodata
 *
 * @author Asus
 */
class Model_biodata extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->db_pg = $this->load->database('pg_db', TRUE);
    }

    public function getBiodata() {
        $query = $this->db_pg->query("select * from biodata");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function insert_bio($table, $data) {
        //insert $table($data) values($data);
        $this->db_pg->insert($table, $data);
        return $this->db_pg->affected_rows();
    }

}
