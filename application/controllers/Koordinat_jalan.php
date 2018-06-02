<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Koordinat_jalan
 *
 * @author Asus
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Temp.php");

class Koordinat_jalan extends Temp {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_koordinatjalan');
        $this->load->model('Model_jalan');
        $this->load->model('Model_aksi');
        $this->load->library('form_validation');
        $this->load->library('cart');
    }

    //put your code here
    //crud koordinat jalan ()
    function index() {
        $data = $this->layout();
        $record['javasc'] = $this->load->view('home/js', NULL, TRUE);
        $record['itemdatajalan'] = $this->Model_jalan->getAll();
        $record['itemkoordinatjalan'] = $this->Model_koordinatjalan->getAll();
        $data['content'] = $this->load->view('home/koordinatjalan_form', $record, TRUE);
        $this->load->view('temp_home/layout', $data);
    }


    function tambahkoordinatjalan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            if ($this->cart->contents() == null) {
                $data = array(
                    'id' => 1,
                    'qty' => 1,
                    'price' => 1,
                    'jenis' => 'jalan',
                    'name' => 1,
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude')
                );

                $this->cart->insert($data);
                $status = "success";
                $msg = "<div class='alert alert-success'>Data berhasil disimpan</div>";
            } else {
                $urut = 0;
                foreach ($this->cart->contents() as $jalan) {
                    $urut += 1;
                }
                $data = array(
                    'id' => $urut + 1,
                    'qty' => 1,
                    'price' => 1,
                    'jenis' => 'jalan',
                    'name' => $urut + 1,
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude')
                );

                $this->cart->insert($data);
                $status = "success";
                $msg = "<div class='alert alert-success'>Data berhasil disimpan</div>";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }

    function hapusdaftarkoordinatjalan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $hapus = $this->cart->destroy();
            $status = 'success';
            $msg = 'data koordinat berhasil dihapus';

            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }

    function simpandaftarkoordinatjalan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_jalan', 'Data Jalan', 'trim|required');
            if ($this->form_validation->run() == false) {
                $status = 'error';
                $msg = validation_errors();
            } else {
                if ($this->Model_koordinatjalan->getbyidjalan($this->input->post('id_jalan'))->num_rows() != null) {
                    $status = 'error';
                    $msg = 'polyline jalan yang bersangkutan sudah ada, hapus terlebih dahulu';
                } else {
                    if ($this->Model_koordinatjalan->create()) {
                        $status = 'success';
                        $msg = 'data berhasil disimpan';
                        $this->cart->destroy();
                    } else {
                        $status = 'error';
                        $msg = 'terjadi kesalahan saat menyimpan koordinat';
                    }
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }

    function hapuspolylinejalan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            if ($this->Model_koordinatjalan->deletebyidjalan($this->input->post('id_jalan'))) {
                $status = 'success';
                $msg = 'data berhasil dihapus';
            } else {
                $status = 'error';
                $msg = 'terjadi kesalahan saat menghapus data';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
        }
    }

    function viewpolylinejalan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            if ($this->Model_koordinatjalan->getbyidjalan($this->input->post('id_jalan'))->num_rows() != null) {
                $status = 'success';
                $msg = $this->Model_koordinatjalan->getbyidjalan($this->input->post('id_jalan'))->result();
                $datajalan = $this->Model_jalan->read($this->input->post('id_jalan'));
            } else {
                $status = 'error';
                $msg = 'data tidak ditemukan';
                $datajalan = null;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg, 'datajalan' => $datajalan)));
        }
    }
}
