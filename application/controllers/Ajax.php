<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('LOGIN'))
        {
            redirect(site_url());
        }

        $this->content['title'] = "";
        $this->content['user'] = $this->session->userdata('LOGIN');
        $this->load->model('Users_model', 'users');
    }

    public function customer_status()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post('id') != "")
            {
                $this->db->query('UPDATE `customer` SET `IsActive` = IF(`IsActive` = 1, 0, 1) WHERE `CustID` = "' . $this->input->post("id") . '"');
                echo '1';
            }
            else
                return FALSE;
        }
    }

    public function getCustomer()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post('id') != "")
            {
                $result = $this->users->getCustomer($this->input->post('id'));
                if ($result)
                    echo json_encode($result);
                else
                    return FALSE;
            }
        }
    }

    public function getAssets()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post('id') != "")
            {
                $result = $this->users->getAssetsByID($this->input->post('id'));
                if ($result)
                    echo json_encode($result);
                else
                    return FALSE;
            }
        }
    }

    public function getContact()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->input->post('id') != "")
            {
                $result = $this->users->getContactByID($this->input->post('id'));
                if ($result)
                    echo json_encode($result);
                else
                    return FALSE;
            }
        }
    }

}
