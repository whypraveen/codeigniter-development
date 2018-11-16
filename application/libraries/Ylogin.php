<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Company    : Young Innovators Online Solutions Pvt Ltd
 * Developer  : Vikram Dhangar
 * Date       : 04 Dec, 2017
 * Usage      : {FILE USAGE GOES HERE}
 */

class Ylogin {

    public $ci;

    function __construct() {
        $this->ci = & get_instance();

        $this->ci->load->model("Users_model", "users");
        //$this->ci->load->model("roles/Roles_model", "roles");
    }

    public function login($email, $password) {
        if ($email != "" && $password != "") {
            $user = $this->ci->users->login($email, $password);
            
            if ($user) {
                if ($user->status) {
                    if ($this->ci->session->has_userdata("LOGIN"))
                        $this->ci->session->unset_userdata("LOGIN");

                    $session = new stdClass();
                    $session->id = $user->user_id;
                    $session->role = $user->role;
                    $session->user_access_id = $user->user_access_id;
                    $session->email = $user->email;

                    if (in_array($user->user_access_id, array('3'))) {
                        $this->ci->session->set_userdata("LOGIN", $session);
                        setAlert('success', 'You have been logged in successfully!');
                        return $user->user_id;
                    } else {
                        setAlert('warning', 'Ooops! you are not authorized to access this panel.');
                        return FALSE;
                    }
                } else {
                    setAlert('warning', 'Ooops! Your account has been blocked.');
                    return FALSE;
                }
            } else {
                setAlert('warning', 'Ooops! Invalid Email or Password.');
                return FALSE;
            }
        } else {
            setAlert('warning', 'Ooops! Please enter Email and Password.');
            return FALSE;
        }
    }

    public function activate($userId) {
        if ($userId != "") {
            $this->ci->users->updateMaster($userId, array("status" => '1'));
            return TRUE;
        } else
            return FALSE;
    }

    public function reset($userId) {
        if ($userId != "") {
            $this->ci->load->model("users/users_model", "users");
            $user = $this->ci->users->get($userId);
            if ($user) {
                if ($this->ci->session->has_userdata("LOGIN"))
                    $this->ci->session->unset_userdata("LOGIN");

                if ($user->reset_date <= strtotime('now')) {
                    set_alert('warning', 'You have been requested to change your password now.');
                    $uriParams = create_verification_string("uid=" . $user->users_id, 'reset');
                    redirect(site_url("verify", "ttl=" . $uriParams));
                }

                $session = new stdClass();
                $session->id = $user->user_id;
                $session->role = $user->role;
                $session->roles_id = $user->roles_id;
                $session->role_parent = $user->parent;
                $session->email = $user->email;
                $session->phone = $user->phone;
                $session->first_name = $user->first_name;
                $session->last_name = $user->last_name;
                $session->gender = $user->gender;
                $session->login = '1';
                $session->login_date = $user->login_date;

                $this->ci->session->set_userdata("LOGIN", $session);
                return TRUE;
            } else {
                set_alert('danger', 'Ooops! Something went wrong.');
                return FALSE;
            }
        } else
            return FALSE;
    }

    public function permission($module, $controller, $action) {
        if ($this->ci->session->has_userdata("LOGIN")) {
            $user = $this->ci->session->userdata("LOGIN");
            $permissions = $this->ci->roles->getPermission($user->role_id, $module);
            if ($permissions) {
                foreach ($permissions as $each) {
                    if (strtolower($each->module) == $module && strtolower($each->controller) == $controller && strtolower($each->action) == $action) {
                        if ($each->access)
                            return TRUE;
                        else
                            return FALSE;
                    }
                }
            } else
                return FALSE;
        } else
            return FALSE;
    }

    public function logout($uid) {
        if ($uid != "") {
            $this->ci->users->updateMaster($uid, array("login" => '0'));
        } else
            return false;
    }

}
