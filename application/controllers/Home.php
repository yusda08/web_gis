<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author yusda08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Temp.php");

class Home extends Temp {

    public function __construct() {
        parent::__construct();
    }

//    public function admin() {
//        if ($this->session->userdata('is_login')) {
//            $a = $this->session->userdata('is_login');
//            if ($a['level_user'] == 1) {
//                $data = $this->layout_admin();
//                $data['name_page'] = 'Dasboard';
//                $data['name_page_small'] = 'Admin';
//                $record['javasc'] = $this->load->view('admin/js', NULL, TRUE);
//                $record['ttl_hr'] = $this->Model_transaksi->get_transOrderJoinDetailWhereTgl(date('Y-m-d'));
//                $record['total'] = $this->Model_transaksi->get_transOrderJoinDetail();
//                $record['ttl_pengeluaran_hr'] = $this->Model_transaksi->get_transPengeluaranWhereTgl(date('Y-m-d'));
//                $record['ttl_pengeluaran'] = $this->Model_transaksi->get_transPengeluaran();
//                $data['content'] = $this->load->view('admin/dasboard', $record, TRUE);
//                $this->load->view('temp_admin/layout', $data);
//            } else {
//                redirect('login');
//            }
//        }
//    }

    public function index() {
        $data = $this->layout();
        $record['javasc'] = $this->load->view('home/js', NULL, TRUE);
        $data['content'] = $this->load->view('home/baranda', $record, TRUE);
        $this->load->view('temp_home/layout', $data);
    }

}
