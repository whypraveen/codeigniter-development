<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        if ($this->session->userdata('LOGIN'))
        {
            $user = $this->session->userdata('LOGIN');

            if (!empty($user))
            {
                redirect(site_url('dashboard'));
            }
        }
        $this->load->view('login');
    }

    public function login()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('pass', 'Password', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
                redirect(site_url());
            }
            else
            {
                $this->load->library('ylogin');
                $isLoggedIn = $this->ylogin->login($this->input->post('email'), $this->input->post('pass'));
                if ($isLoggedIn)
                    redirect(site_url('dashboard'));
                else
                    redirect(site_url());
            }
        }
    }

    public function register()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('pass', 'Password', 'required');
            $this->form_validation->set_rules('cpassword', 'Confirrm Password', 'required|matches[pass]');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
            }
            else
            {
                $this->load->model("Users_model", "users");
                $array = array('user_access_id' => 3, 'email' => $this->input->post('email'), 'password' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT), 'status' => 1);
                $result = $this->users->register_user($array);
                if ($result)
                {
                    setAlert('success', 'Registered Successfully.');
                }
                else
                {
                    setAlert('error', 'Please contact administration!!');
                }
            }
        }
        $this->load->view('signup');
    }

    public function logout()
    {
        $user = is_valid();
        /* if ($user) {
          $this->load->library('ylogin');
          $this->acl->logout($user->id);
          } */

        if ($this->session->has_userdata("LOGIN"))
            $this->session->unset_userdata("LOGIN");

        $this->session->sess_destroy();

        setAlert('success', 'You have logged out successfully!');
        redirect(site_url());
    }

    public function forgot()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('warning', validation_errors());
            }
            else
            {

                $this->load->model("Users_model", "users");

                $user = $this->users->verifyEmail($this->input->post('email'));
                if ($user)
                {
                    $this->users->updateMaster($user->id, array("status" => '0'));

                    $enc = create_verification_string('uid=' . $user->id, 'reset');
                    $link = '<a href="' . site_url('verify', 'ttl=' . $enc) . '" title="Click Here">Click Here</a>';
                    $to = $this->input->post('email');
                    $paramas = array('user' => $this->input->post('email'), 'link' => $link, 'time' => 30 . " minutes");
                    email(2, $to, $paramas);

                    //set_alert('success', $this->lang->line('FORGET_PASSWORD'));
                    setAlert('success', 'Password reset link has been send. Please Check Your Email.');
                    redirect(site_url());
                }
                else
                {
                    //echo '<div class="alert alert-danger text-center"><button data-dismiss="alert" class="close" type="button">×</button>Ooops! this email address is not associated with any account.</div>';
                    setAlert('error', 'Ooops! this email address is not associated with any account.');
                    redirect(site_url('forgot'));
                }
            }
            ///redirect(site_url('login'));
        }
        else
        {
            //set_alert('warning', 'Ooops! Link has been expired');
            //redirect(site_url());
            $this->load->view('forgot');
        }
    }

    public function verify()
    {
        if ($this->input->get('ttl') != "")
        {
            $result = verify_string($this->input->get('ttl'));
            if (is_array($result))
            {
                redirect(site_url($result['type'], $result['string']));
            }
            else
            {
                setAlert('warning', 'Ooops! Link has been expired');
                redirect(site_url());
            }
        }
        else
        {
            setAlert('warning', 'Ooops! Link has been expired');
            redirect(site_url());
        }
        //$this->load->view('verify');
    }

    public function reset()
    {
        $this->load->model("Users_model", "users");

        if ($this->input->post())
        {
            $this->form_validation->set_rules('nPass', 'New Password', 'trim|required');
            $this->form_validation->set_rules('cnPass', 'Confirm New Password', 'trim|required|matches[nPass]');

            if ($this->form_validation->run() == FALSE)
            {
                setAlert('error', validation_errors());
                redirect(site_url('reset'));
            }
            else
            {
                $updateArray = array();

                $this->load->model("Users_model", "users");

                $updateArray['password'] = password_hash($this->input->post('nPass'), PASSWORD_DEFAULT);
                $updateArray['status'] = '1';

                $result = $this->users->updateMaster($this->input->get("id"), $updateArray);
                if ($result)
                {
                    setAlert('success', 'Bingo! Your password has been changed successfully.');
                }

                redirect(site_url());
            }
        }

        $this->load->view("reset");
    }

}
