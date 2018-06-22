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
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Temp.php");
class Biodata extends Temp{
    //put your code here
        public function __construct() {
        parent::__construct();
        $this->load->model('Model_biodata');
    }

    public function index() {
        $data = $this->layout();
        $record['javasc'] = $this->load->view('home/js', NULL, TRUE);
        $record['getBiodata'] = $this->Model_biodata->getBiodata();
        $data['content'] = $this->load->view('home/biodata', $record, TRUE);
        $this->load->view('temp_home/layout', $data);
    }
    
    function create() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $this->form_validation->set_rules('nik', 'NIK', 'trim|required');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            if ($this->form_validation->run() == false) {
                $status = 'error';
                $msg = validation_errors();
            } else {
                $data['nik'] = $this->input->post('nik');
                $data['nama'] = $this->input->post('nama');
                $data['alamat'] = $this->input->post('alamat');
                if ($this->Model_biodata->insert_bio('biodata', $data)) {
                    $status = 'success';
                    $msg = "Data jalan berhasil disimpan";
                } else {
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menyimpan data jalan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }
}
