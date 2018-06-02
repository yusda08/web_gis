<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jembatan
 *
 * @author yusda08
 */
    defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Temp.php");

class Jembatan extends Temp {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_jembatan');
        $this->load->model('Model_aksi');
        $this->load->library('form_validation');
    }

    function index() {
        $data = $this->layout();
        $record['javasc'] = $this->load->view('home/js', NULL, TRUE);
        $record['itemjembatan'] = $this->Model_jembatan->getAll();
        $data['content'] = $this->load->view('home/form_jembatan', $record, TRUE);
        $this->load->view('temp_home/layout', $data);
    }
    
    function create(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('namajembatan', 'Nama Jembatan', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $data['namajembatan'] = $this->input->post('namajembatan');
                $data['keterangan'] = $this->input->post('keterangan');
                if ($this->Model_aksi->insert('tbl_jembatan', $data)) {
                    $status = 'success';
                    $msg = "Data jembatan berhasil disimpan";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menyimpan data jembatan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function edit(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('id_jembatan', 'ID Jembatan', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_jembatan');
                if ($id!=null) {
                    $status = 'success';
                    $msg = $this->Model_jembatan->read($id);
                }else{
                    $status = 'error';
                    $msg = "Data jembatan tidak ditemukan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function update(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('namajembatan', 'Nama Jembatan', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            $this->form_validation->set_rules('id_jembatan', 'ID Jembatan', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_jembatan');
                $data['namajembatan'] = $this->input->post('namajembatan');
                $data['keterangan'] = $this->input->post('keterangan');
                if ($this->Model_aksi->update('id_jembatan',$id,'tbl_jembatan',$data)) {
                    $status = 'success';
                    $msg = "Data jembatan berhasil diupdate";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat mengupdate data jembatan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    function delete(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            //kita validasi inputnya dulu
            $this->form_validation->set_rules('id_jembatan', 'ID Jembatan', 'trim|required');
            if ($this->form_validation->run()==false) {
                $status = 'error';
                $msg = validation_errors();
            }else{
                $id = $this->input->post('id_jembatan');
                if ($this->Model_aksi->delete('id_jembatan',$id,'tbl_jembatan')) {
                    $status = 'success';
                    $msg = "Data jembatan berhasil dihapus";
                }else{
                    $status = 'error';
                    $msg = "terjadi kesalahan saat menghapus data jembatan";
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
 
}
