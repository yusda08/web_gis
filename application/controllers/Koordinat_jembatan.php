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
require_once(dirname(__FILE__) . "/Temp.php");

class Koordinat_jembatan extends Temp {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_koordinatjembatan');
        $this->load->model('Model_jembatan');
        $this->load->model('Model_aksi');
        $this->load->library('form_validation');
    }

//crud koordinat jembatan
    function index() {
        $data = $this->layout();
        $record['javasc'] = $this->load->view('home/js', NULL, TRUE);
        $record['itemdatajembatan'] = $this->Model_jembatan->getAll();
        $record['itemkoordinatjembatan'] = $this->Model_koordinatjembatan->getAll();
        $data['content'] = $this->load->view('home/koordinatjembatan_form', $record, TRUE);
        $this->load->view('temp_home/layout', $data);
    }


    function simpandaftarkoordinatjembatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_jembatan', 'Data jembatan', 'trim|required');
            if ($this->form_validation->run() == false) {
                $status = 'error';
                $msg = validation_errors();
            } else {
                if ($this->Model_koordinatjembatan->getbyidjembatan($this->input->post('id_jembatan'))->num_rows() != null) {
                    $status = 'error';
                    $msg = 'marker jembatan yang bersangkutan sudah ada, hapus terlebih dahulu';
                } else {
                    if ($this->Model_koordinatjembatan->create()) {
                        $status = 'success';
                        $msg = 'data berhasil disimpan';
                    } else {
                        $status = 'error';
                        $msg = 'terjadi kesalahan saat menyimpan koordinat';
                    }
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }

    function hapusmarkerjembatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            if ($this->Model_koordinatjembatan->deletebyidjembatan($this->input->post('id_jembatan'))) {
                $status = 'success';
                $msg = 'data berhasil dihapus';
            } else {
                $status = 'error';
                $msg = 'terjadi kesalahan saat menghapus data';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }

    function viewmarkerjembatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            if ($this->Model_koordinatjembatan->getbyidjembatan($this->input->post('id_jembatan'))->num_rows() != null) {
                $status = 'success';
                $msg = $this->Model_koordinatjembatan->getbyidjembatan($this->input->post('id_jembatan'))->result();
                $datajembatan = $this->Model_jembatan->read($this->input->post('id_jembatan'));
            } else {
                $status = 'error';
                $msg = 'data tidak ditemukan';
                $datajembatan = null;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg, 'datajembatan' => $datajembatan)));
        }
    }

}

//end crud koordinat jembatan