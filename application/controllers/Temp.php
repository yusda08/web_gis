<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Temp
 *
 * @author yusda08
 */
class Temp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function layout() {
        $data['head'] = $this->load->view('temp_home/head', NULL, TRUE);
        $data['nav'] = $this->load->view('temp_home/nav', NULL, TRUE);
        $data['nav_header'] = $this->load->view('temp_home/nav_header', NULL, TRUE);
        $data['footer'] = $this->load->view('temp_home/footer', NULL, TRUE);
        return $data;
    }

}
