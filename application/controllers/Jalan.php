<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jalan
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Temp.php");

class Jalan extends Temp {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_jalan');
        $this->load->model('Model_aksi');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    function index() {
        $data = $this->layout();
        $record['javasc'] = $this->load->view('home/js', NULL, TRUE);
        $record['itemjalan'] = $this->Model_jalan->getAll();
        $data['content'] = $this->load->view('home/form_jalan', $record, TRUE);
        $this->load->view('temp_home/layout', $data);
    }

    function create() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $this->form_validation->set_rules('namajalan', 'Nama Jalan', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            if ($this->form_validation->run() == false) {
                $status = 'error';
                $msg = validation_errors();
            } else {
                $data['namajalan'] = $this->input->post('namajalan');
                $data['keterangan'] = $this->input->post('keterangan');
                if ($this->Model_aksi->insert('tbl_jalan', $data)) {
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

    function edit() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $this->form_validation->set_rules('id_jalan', 'ID Jalan', 'trim|required');
            if ($this->form_validation->run() == false) {
                $status = 'error';
                $msg = validation_errors();
            } else {
                $id = $this->input->post('id_jalan');
                if ($id != null) {
                    $status = 'success';
                    $msg = $this->Model_jalan->read($id);
                } else {
                    $status = 'error';
                    $msg = "Data jalan tidak ditemukan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }

    function update() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('namajalan', 'Nama Jalan', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            $this->form_validation->set_rules('id_jalan', 'ID Jalan', 'trim|required');
            if ($this->form_validation->run() == false) {
                $status = 'error';
                $msg = validation_errors();
            } else {
                $id = $this->input->post('id_jalan');
                $data['namajalan'] = $this->input->post('namajalan');
                $data['keterangan'] = $this->input->post('keterangan');
                if ($this->Model_aksi->update('id_jalan', $id, 'tbl_jalan', $data)) {
                    $status = 'success';
                    $msg = "Data jalan berhasil diupdate";
                } else {
                    $status = 'error';
                    $msg = "terjadi kesalahan saat mengupdate data jalan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }
    function delete(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('id_jalan', 'ID Jalan', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_jalan');
                if ($this->Model_aksi->delete('id_jalan',$id,'tbl_jalan')) {
                    $status = 'success';
                    $msg = "Data jalan berhasil dihapus";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menghapus data jalan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }

}
