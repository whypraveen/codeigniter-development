<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('LOGIN'))
        {
            redirect(site_url());
        }
        $this->load->model("Users_model", "users");
    }

    public function index()
    {
        $this->content['cssArray'] = array('datatable/dataTables.bootstrap4.min.css', 'datatable/buttons.bootstrap4.min.css','_tables.scss');
        $this->content['jsArray'] = array('jquery.dataTables.min.js','dataTables.bootstrap4.min.js');
        
        $this->load->view('common/head', $this->content);
        $this->load->view('customers', $this->content);
        $this->load->view('common/footer', $this->content);
    }

}
