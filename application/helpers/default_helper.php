<?php

/*
 * Company    : Young Innovators Online Solutions Pvt Ltd
 * Developer  : Vikram Dhangar
 * Date       : 12 Sep, 2015
 * Usage      : Default helper functions, which will be used through the application.
 */

//** GET CURRENT MODULE **//
function getModule()
{
    $ci = & get_instance();

    $module = $ci->router->fetch_module();
    return $module;
}

//** GET CURRENT CONTROLLER **//
function getController($only = false)
{
    $ci = & get_instance();
    $class = $ci->router->fetch_class();
    //$module = $ci->router->fetch_module();
    if ($only)
        return $class;
    return ($module) ? ($module . "/" . $class) : ($class);
}

//** GET CURRENT METHOD **//
function getAction($only = false)
{
    $ci = & get_instance();
    $module = $ci->router->fetch_module();
    $class = $ci->router->fetch_class();
    $action = $ci->router->fetch_method();

    if ($only)
        return $action;
    return ($module) ? ($module . "/" . $class . "/" . $action) : ($class . "/" . $action);
}

//** GET IMAGES **//
function getImage($image = "")
{
    $baseUrl = (strpos(APPPATH, '../') !== false) ? (str_replace(DOMAIN_EXT, '', base_url())) : (base_url());
    $path = BASE_PATH_IMAGE_FOLDER;

    if ($image != "")
        $imagePath = $baseUrl . $path . $image;
    else
        $imagePath = $path;
    return $imagePath;
}

function getCss($css = "", $custom = false)
{
    $path = BASE_PATH_CSS_FOLDER;

    if (is_array($css))
    {
        if (count($css) > 1)
        {
            $cssHTML = "";
            foreach ($css as $each)
            {
                if (is_array($each))
                {
                    if ($each['custom'])
                        $cssHTML .= link_tag($each['path']) . "\t   ";
                    else
                        $cssHTML .= link_tag($path . $each['path']) . "\t   ";
                }
                else
                {
                    $cssHTML .= link_tag($path . $each) . "\t   ";
                }
            }
        }
        else
        {
            if (@$css[0]['custom'] === TRUE)
                $cssHTML = link_tag($css[0]['path']) . "\t   ";
            else
                $cssHTML = link_tag($path . $css[0]) . "\t   ";
        }
        return $cssHTML;
    }
    else
    {
        if ($css != "" && !$custom)
            $cssPath = link_tag($path . $css) . "\t   ";
        elseif ($custom)
            $cssPath = link_tag($css) . "\t   ";
        else
            $cssPath = $path;

        return $cssPath;
    }
}

function getJs($js = "", $custom = false, $type = "text/javascript")
{
    $baseUrl = (strpos(APPPATH, '../') !== false) ? (str_replace(DOMAIN_EXT, '', base_url())) : (base_url());
    $apppath = (strpos(APPPATH, '../') !== false) ? (str_replace('../application/', '', APPPATH)) : (str_replace('application/', '', APPPATH));

    if ($custom)
        $path = '/';
    else
        $path = BASE_PATH_JS_FOLDER;

    if (is_array($js))
    {
        $jsHTML = "";

        if (count($js) > 1)
        {
            foreach ($js as $each)
            {
                if (is_array($each))
                {
                    if ($each['custom'])
                        $jsHTML .= '<script type="' . $type . '" src="' . $each['path'] . '"></script>' . "\n";
                    else
                        $jsHTML .= '<script type="' . $type . '" src="' . $path . $each['path'] . '"></script>' . "\n";
                }
                else
                {
                    $jsHTML .= '<script type="' . $type . '" src="' . $baseUrl . $path . $each . '"></script>' . "\n";
                }
            }
        }
        else
        {
            if (@$js[0]['custom'] === TRUE)
                $jsHTML = '<script type="' . $type . '" src="' . $baseUrl . $path . $js[0]['path'] . '"></script>' . "\n";
            elseif ($js[0] != "")
                $jsHTML = '<script type="' . $type . '" src="' . $baseUrl . $path . $js[0] . '"></script>' . "\n";
        }
        return $jsHTML;
    }
    else
    {
        if ($js != "")
            $jsHTML = '<script type="' . $type . '" src="' . $baseUrl . $path . $js . '"></script>' . "\n";
        else
            $jsHTML = "";

        return $jsHTML;
    }
}

//** IS USER LOGGED IN OR NOT **//
function is_valid($roleId = "")
{
    $ci = & get_instance();

    if ($ci->session->has_userdata("LOGIN"))
    {
        $user = $ci->session->userdata("LOGIN");
        if ($roleId != "")
        {
            if (is_array($roleId))
            {
                if (in_array($user->user_access_id, $roleId))
                    return $user;
                else
                    redirect(site_url('logout'));
            }
            else
            {
                if ($user->user_access_id == $roleId)
                    return $user;
                else
                    redirect(site_url('logout'));
            }
        }
        else
            return $user;
    }
    else
    {
        return FALSE;
    }
}

//** Update existing session **//
function update_session($key, $value)
{
    if ($key != "" && $value != "")
    {
        $ci = & get_instance();

        if ($ci->session->has_userdata("LOGIN"))
        {
            $user = $ci->session->userdata("LOGIN");
            $user->$key = $value;
            $ci->session->unset_userdata("LOGIN");
            $ci->session->set_userdata("LOGIN", $user);

            return TRUE;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}

//** SET ALERT MESSAGES **//
function setAlert($type, $message)
{
    if ($type != "" && $message != "")
    {
        $ci = & get_instance();
        $ci->load->library('Alert');

        switch ($type)
        {
            case 'error': $ci->alert->error($message);
                break;
            case 'success': $ci->alert->success($message);
                break;
            case 'notice': $ci->alert->notice($message);
                break;
            case 'warning': $ci->alert->warning($message);
                break;
        }
    }
}

function getNotification()
{
    $ci = & get_instance();
    $ci->load->library('Alert');

    $error = $ci->alert->error();
    $success = $ci->alert->success();
    $notice = $ci->alert->notice();
    $warning = $ci->alert->warning();

    $message = array('error' => $error, 'notice' => $notice, 'success' => $success, 'warning' => $warning);

    $theme = $ci->config->item('default_theme');
    $template = $ci->config->item('notification_template');

    if ($message['error'] != "" || $message['notice'] != "" || $message['success'] != "" || $message['warning'] != "")
        $notice = $ci->parser->parse($theme . "/common/notifications", array('function' => 'notification', 'message' => $message), true);
    else
        $notice = FALSE;
    return $notice;
}

//** Create Verification String for URL's **//
function create_verification_string($string, $method = "")
{
    if ($string != "")
    {
        $ci = & get_instance();

        $to = mktime(date('H'), date('i'), date('s'), date('n'), date('j') + 30, date('Y'));
        $encode = encode($string . "#" . $to . "#" . $method);
        return $encode;
    }
    else
        return FALSE;
}

//** ENCODE **//
function encode($string)
{
    if ($string != "")
    {
        $ci = & get_instance();

        $sysString = $ci->config->item('encryption_key');
        $encString = strtr(base64_encode($sysString . "#" . $string), '+/=', '-_,');
        return $encString;
    }
}

//** DECODE **//
function decode($string)
{
    if ($string != "")
    {
        $ci = & get_instance();

        $sysString = $ci->config->item('encryption_key');
        $decString = base64_decode(strtr($string, '-_,', '+/='));
        return str_replace($sysString . '#', '', $decString);
    }
}

//** Send EMail **//
function email($tempId, $to, $params = array(), $bcc = "", $attachment = "")
{
    if ($tempId != "" && $to != "")
    {
        $ci = & get_instance();
        $ci->load->library("Mails");

        return $ci->mails->send($tempId, $to, $params, $bcc, $attachment);
    }
    else
        return FALSE;
}

//** Verify String found on URI **//
function verify_string($string)
{
    if ($string != "")
    {
        $decode = decode($string);

        $detail = explode("#", $decode);
        $now = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'));
        if (@$detail[1])
        {
            $to = $detail[1];

            //echo strtotime("now") ." < ".strtotime(date('Y-m-d H:i:s', $to)); die;
            if (strtotime("now") < strtotime(date('Y-m-d H:i:s', $to)))
                return array('string' => $detail[0], 'type' => $detail[2]);
            else
                return FALSE;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}

function getAssets($id)
{
    if ($id)
    {
        $ci = & get_instance();
        $ci->load->model("Users_model", "users");
        $result = $ci->users->getAssets($id);
        if ($result)
            return $result;
        else
            return FALSE;
    }
    else
        return FALSE;
}

function getContact($id)
{
    if ($id)
    {
        $ci = & get_instance();
        $ci->load->model("Users_model", "users");
        $result = $ci->users->getContact($id);
        if ($result)
            return $result;
        else
            return FALSE;
    }
    else
        return FALSE;
}
