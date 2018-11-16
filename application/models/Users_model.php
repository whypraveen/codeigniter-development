<?php

/* Company    : Young Innovators Online Solutions Pvt Ltd
 * Developer  : Vikram Dhangar
 * Date       : 04 Dec, 2017
 * Usage      : {FILE USAGE GOES HERE}
 */

class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        $this->users = "users";
        $this->roles = "user_access";
        $this->emails = "emails_template";
        $this->customer = "customer";
        $this->assets = "asset_details";
        $this->contact = "customer_contacts";
    }

    public function login($email, $password)
    {
        if ($email != "" && $password != "")
        {
            $this->db->select($this->roles . '.title as role');
            $this->db->select($this->users . '.*, ' . $this->users . '.id as user_id');

            $this->db->from($this->users);

            $this->db->join($this->roles, $this->roles . '.id = ' . $this->users . '.user_access_id', 'left');

            $this->db->where_in($this->users . '.user_access_id', array('3'));
            $this->db->where($this->users . '.email', $email);
            //$this->db->where($this->users . ".pass = MD5(CONCAT('" . $password . "'," . $this->users . ".key))", NULL, FALSE);
            $this->db->where($this->roles . '.status', '1');

            $user = $this->db->get();
            //echo $this->db->last_query(); die;
            $result = $user->result();
            if ($result)
            {
                if (password_verify($password, $result[0]->password))
                {
                    return $result[0];
                }
                else
                {
                    return FALSE;
                }
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function register_user($user)
    {
        if (!empty($user))
        {
            $this->db->insert($this->users, $user);
            $id = $this->db->insert_id();
            if ($id)
                return $id;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function verifyEmail($email)
    {
        if ($email != "")
        {
            $this->db->select($this->roles . '.title as role');
            $this->db->select($this->users . '.*, ' . $this->users . '.id as user_id');

            $this->db->from($this->users);

            $this->db->join($this->roles, $this->roles . '.id = ' . $this->users . '.user_access_id', 'left');

            $this->db->where($this->users . '.email', $email);

            $query = $this->db->get();
            //echo $this->db->last_query(); die;
            $result = $query->result();
            if ($result)
                return $result[0];
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function updateMaster($usersId, $profile)
    {
        if (!empty($profile) && $usersId != "")
        {
            $this->db->update($this->users, $profile, $this->users . ".id = $usersId");
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function get_emailtemplate($id)
    {
        if ($id != "")
        {
            $query = $this->db->get_where($this->emails, array($this->emails . '.id' => $id, $this->emails . '.status' => '1'));
            $result = $query->result();
            if ($result)
                return $result[0];
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function getUser($id = "", $roleId = "")
    {
        $this->db->select($this->users . '.*, CONCAT(' . $this->users . '.first_name , " " , ' . $this->users . '.last_name) AS fullname');
        $this->db->select($this->roles . '.title as role');
        $this->db->from($this->users);
        $this->db->join($this->roles, $this->users . '.roles_id = ' . $this->roles . '.id', 'left');
        if ($id != "")
            $this->db->where($this->users . '.id', $id);
        if ($roleId != "")
            $this->db->where($this->users . '.roles_id', $roleId);
        $query = $this->db->get();
        $return = $query->result();
        if ($return)
            return $return;
        else
            return FALSE;
    }

    public function add($table, $array)
    {
        if (!empty($array) && $table != "")
        {
            $this->db->insert($table, $array);
            $id = $this->db->insert_id();
            if ($id)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function getCustomer($id = "")
    {
        $this->db->select($this->customer . '.*');
        $this->db->from($this->customer);
        if ($id != "")
            $this->db->where($this->customer . '.CustID', $id);
        $query = $this->db->get();
        $result = $query->result();
        if ($result)
            return $result;
        else
            return FALSE;
    }

    public function updateCustomer($cID, $array)
    {
        if (!empty($array) && $cID != "")
        {
            $this->db->update($this->customer, $array, $this->customer . ".CustID = $cID");
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function deleteCustomer($id)
    {
        if ($id)
        {
            $this->db->delete($this->customer, array('CustID' => $id));
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function getAssets($cid)
    {
        if ($cid != "")
        {
            $this->db->select($this->assets . '.*');
            $this->db->from($this->assets);
            $this->db->where($this->assets . '.CustID', $cid);
            $query = $this->db->get();
            $result = $query->result();
            if ($result)
                return $result;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function getContact($cid)
    {
        if ($cid != "")
        {
            $this->db->select($this->contact . '.*');
            $this->db->from($this->contact);
            $this->db->where($this->contact . '.CustID', $cid);
            $query = $this->db->get();
            $result = $query->result();
            if ($result)
                return $result;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function getAssetsByID($id)
    {
        if ($id != "")
        {
            $this->db->select($this->assets . '.*');
            $this->db->from($this->assets);
            $this->db->where($this->assets . '.AssetID', $id);
            $query = $this->db->get();
            $result = $query->result();
            if ($result)
                return $result;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function getContactByID($id)
    {
        if ($id != "")
        {
            $this->db->select($this->contact . '.*');
            $this->db->from($this->contact);
            $this->db->where($this->contact . '.ContactID', $id);
            $query = $this->db->get();
            $result = $query->result();
            if ($result)
                return $result;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function updateAssets($aID, $array)
    {
        if (!empty($array) && $aID != "")
        {
            $this->db->update($this->assets, $array, $this->assets . ".AssetID = $aID");
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function updateContact($aID, $array)
    {
        if (!empty($array) && $aID != "")
        {
            $this->db->update($this->contact, $array, $this->contact . ".ContactID = $aID");
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function deleteAssets($id)
    {
        if ($id)
        {
            $this->db->delete($this->assets, array('AssetID' => $id));
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    public function deleteContact($id)
    {
        if ($id)
        {
            $this->db->delete($this->contact, array('ContactID' => $id));
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

}
