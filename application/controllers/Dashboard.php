<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
        if ($this->input->post())
        {
            $this->form_validation->set_rules('customer_id_name', 'Customer ID Name', 'required');
            $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
            }
            else
            {
                $array = array('CustIDName' => $this->input->post('customer_id_name'), 'CustName' => $this->input->post('customer_name'), 'IsActive' => 1);
                $result = $this->users->add('customer', $array);
                if ($result)
                    setAlert('success', 'Bingo! Customer added successfully.');
                else
                    setAlert('error', 'Ooops! Unknown error. Please contact site administrator.');
            }
        }

        $this->content['customer_list'] = $this->users->getCustomer();


        $this->content['jsArray'] = array('custom.js');
        $this->load->view('common/head', $this->content);
        $this->load->view('dash', $this->content);
        $this->load->view('common/footer', $this->content);
    }

    public function edit()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('customer_id_name', 'Customer ID Name', 'required');
            $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
                redirect(site_url('dashboard'));
            }
            else
            {
                $array = array('CustIDName' => $this->input->post('customer_id_name'), 'CustName' => $this->input->post('customer_name'));
                $result = $this->users->updateCustomer($this->input->post('cid'), $array);
                if ($result)
                {
                    setAlert('success', 'Bingo! Customer updated successfully.');
                    redirect(site_url('dashboard'));
                }
                else
                {
                    setAlert('error', 'Ooops! No changes made.');
                    redirect(site_url('dashboard'));
                }
            }
        }
        else
            redirect(site_url('dashboard'));
    }

    public function delete()
    {
        if ($this->input->post('delete'))
        {
            $result = $this->users->deleteCustomer($this->input->post('cid'));
            if ($result)
            {
                setAlert('success', 'Bingo! Customer removed successfully.');
                redirect(site_url('dashboard'));
            }
            else
            {
                setAlert('error', 'Ooops! Unknown error. Please contact site administrator.');
                redirect(site_url('dashboard'));
            }
        }
        else
            redirect(site_url('dashboard'));
    }

    public function assets()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('asset_name', 'Assets Name', 'required');
            $this->form_validation->set_rules('asset_url', 'Assets URL', 'required|valid_url');
            $this->form_validation->set_rules('asset_user_name', 'Assets User Name', 'required');
            $this->form_validation->set_rules('asset_password', 'Assets Password', 'required');
            $this->form_validation->set_rules('asset_start_date', 'Assets Start Date', 'required');
            $this->form_validation->set_rules('asset_expiry_date', 'Assets Expiry Date', 'required');
            $this->form_validation->set_rules('asset_amount', 'Assets Amount', 'required|numeric');
            $this->form_validation->set_rules('asset_renewal_amount', 'Assets Renewal Amount', 'required|numeric');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
                redirect(site_url('dashboard'));
            }
            else
            {
                $array = array('CustID' => $this->input->post('cid'),
                    'AssetName' => $this->input->post('asset_name'),
                    'AssetURL' => $this->input->post('asset_url'),
                    'AssetUsername' => $this->input->post('asset_user_name'),
                    'AssetPassword' => $this->input->post('asset_password'),
                    'AssetStartDate' => $this->input->post('asset_start_date'),
                    'AssetExpiryDate' => $this->input->post('asset_expiry_date'),
                    'AssetAmount' => $this->input->post('asset_amount'),
                    'AssetRenewalAmount' => $this->input->post('asset_renewal_amount'),
                    'Notes' => $this->input->post('notes'),
                    'IsActive' => 1);
                $result = $this->users->add('asset_details', $array);
                if ($result)
                {
                    setAlert('success', 'Bingo! Assets added successfully.');
                    redirect(site_url('dashboard'));
                }
                else
                {
                    setAlert('error', 'Ooops! Unknown error. Please contact site administrator.');
                    redirect(site_url('dashboard'));
                }
            }
        }
    }

    public function editAssets()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('asset_name', 'Assets Name', 'required');
            $this->form_validation->set_rules('asset_url', 'Assets URL', 'required|valid_url');
            $this->form_validation->set_rules('asset_user_name', 'Assets User Name', 'required');
            $this->form_validation->set_rules('asset_password', 'Assets Password', 'required');
            $this->form_validation->set_rules('asset_start_date', 'Assets Start Date', 'required');
            $this->form_validation->set_rules('asset_expiry_date', 'Assets Expiry Date', 'required');
            $this->form_validation->set_rules('asset_amount', 'Assets Amount', 'required|numeric');
            $this->form_validation->set_rules('asset_renewal_amount', 'Assets Renewal Amount', 'required|numeric');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
                redirect(site_url('dashboard'));
            }
            else
            {
                $array = array('AssetName' => $this->input->post('asset_name'),
                    'AssetURL' => $this->input->post('asset_url'),
                    'AssetUsername' => $this->input->post('asset_user_name'),
                    'AssetPassword' => $this->input->post('asset_password'),
                    'AssetStartDate' => $this->input->post('asset_start_date'),
                    'AssetExpiryDate' => $this->input->post('asset_expiry_date'),
                    'AssetAmount' => $this->input->post('asset_amount'),
                    'AssetRenewalAmount' => $this->input->post('asset_renewal_amount'),
                    'Notes' => $this->input->post('notes')
                );
                $result = $this->users->updateAssets($this->input->post('aid'), $array);
                if ($result)
                {
                    setAlert('success', 'Bingo! Assets updated successfully.');
                    redirect(site_url('dashboard'));
                }
                else
                {
                    setAlert('warning', 'Ooops! No changes made.');
                    redirect(site_url('dashboard'));
                }
            }
        }
        else
            redirect(site_url('dashboard'));
    }

    public function contact()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('customer_contact_name', 'Contact Name', 'required');
            $this->form_validation->set_rules('customer_contact_email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('address1', 'Address 1', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('mobile1', 'Mobile 1', 'required|numeric');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
                redirect(site_url('dashboard'));
            }
            else
            {
                $array = array('CustID' => $this->input->post('customer_id'),
                    'ContactName' => $this->input->post('customer_contact_name'),
                    'ContactEmail' => $this->input->post('customer_contact_email'),
                    'ContactAddress1' => $this->input->post('address1'),
                    'ContactAddress2' => $this->input->post('address2'),
                    'ContactCity' => $this->input->post('city'),
                    'ContactCountry' => $this->input->post('country'),
                    'ContactPhone' => $this->input->post('phone'),
                    'ContactFax' => $this->input->post('fax'),
                    'ContactMobile1' => $this->input->post('mobile1'),
                    'ContactMobile2' => $this->input->post('mobile2')
                );
                $result = $this->users->add('customer_contacts', $array);
                if ($result)
                {
                    setAlert('success', 'Bingo! Contact added successfully.');
                    redirect(site_url('dashboard'));
                }
                else
                {
                    setAlert('error', 'Ooops! Unknown error. Please contact site administrator.');
                    redirect(site_url('dashboard'));
                }
            }
        }
    }

    public function editContact()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('customer_contact_name', 'Contact Name', 'required');
            $this->form_validation->set_rules('customer_contact_email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('address1', 'Address 1', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('mobile1', 'Mobile 1', 'required|numeric');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
                redirect(site_url('dashboard'));
            }
            else
            {
                $array = array('ContactName' => $this->input->post('customer_contact_name'),
                    'ContactEmail' => $this->input->post('customer_contact_email'),
                    'ContactAddress1' => $this->input->post('address1'),
                    'ContactAddress2' => $this->input->post('address2'),
                    'ContactCity' => $this->input->post('city'),
                    'ContactCountry' => $this->input->post('country'),
                    'ContactPhone' => $this->input->post('phone'),
                    'ContactFax' => $this->input->post('fax'),
                    'ContactMobile1' => $this->input->post('mobile1'),
                    'ContactMobile2' => $this->input->post('mobile2')
                );
                $result = $this->users->updateContact($this->input->post('ccid'), $array);
                if ($result)
                {
                    setAlert('success', 'Bingo! Contact Updated successfully.');
                    redirect(site_url('dashboard'));
                }
                else
                {
                    setAlert('warning', 'Ooops! No changes made.');
                    redirect(site_url('dashboard'));
                }
            }
        }
    }

    public function deleteAssets()
    {
        if ($this->input->post('delete'))
        {
            if ($this->input->post('assets_id') != "")
            {
                $result = $this->users->deleteAssets($this->input->post('assets_id'));
                if ($result)
                {
                    setAlert('success', 'Bingo! Assets removed successfully.');
                    redirect(site_url('dashboard'));
                }
                else
                {
                    setAlert('error', 'Ooops! Unknown error. Please contact site administrator.');
                    redirect(site_url('dashboard'));
                }
            }
            else
                redirect(site_url('dashboard'));
        }
        else
            redirect(site_url('dashboard'));
    }

    public function deleteContact()
    {
        if ($this->input->post('delete'))
        {
            if ($this->input->post('contactID') != "")
            {
                $result = $this->users->deleteContact($this->input->post('contactID'));
                if ($result)
                {
                    setAlert('success', 'Bingo! Contact removed successfully.');
                    redirect(site_url('dashboard'));
                }
                else
                {
                    setAlert('error', 'Ooops! Unknown error. Please contact site administrator.');
                    redirect(site_url('dashboard'));
                }
            }
            else
                redirect(site_url('dashboard'));
        }
        else
            redirect(site_url('dashboard'));
    }

}
