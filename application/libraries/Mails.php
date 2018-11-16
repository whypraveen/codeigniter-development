<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* Company    : Young Innovators Online Solutions Pvt Ltd
 * Developer  : Vikram Dhangar
 * Date       : 3 Oct, 2015
 * Usage      : {FILE USAGE GOES HERE}
 */
class Mails
{
    public function __construct()
    {
	   $this->ci	=&  get_instance();
	   
	   $this->ci->load->library('email');
	   $this->ci->load->model("Users_model", 'emails');
	   
	   $this->to		   =   "";
	   $this->cc		   =	  "";
	   $this->subject	   =	  "";
	   $this->body		   =	  "";
	   $this->from_email   =	  "";
	   $this->from_name	   =	  "";
	   $this->attachment   =	  "";
    }
    
    public function send($templateId, $to, $params, $attachment="")
    {
	   if($to != "" && $templateId != "")
	   {
		  if($this->set_template($templateId))
		  {
			 $this->ci->load->library('parser');
			 
			 $this->to   =	  $to;
			 $this->body =	  $this->ci->parser->parse_string($this->body, $params, TRUE);
			 
			 $this->_request($attachment);
		  }
	   }
	   else
		  return FALSE;
    }
    
    public function set_template($id)
    {
	   if($id != "")
	   {
		  $email	=   $this->ci->emails->get_emailtemplate($id);
		  if($email)
		  {
			 $this->subject	 =	$email->subject;
			 $this->body		 =	$email->body;
			 $this->from_email	 =	($email->from_email)?($email->from_email):($this->ci->config->item('site_email'));
			 $this->from_name	 =	($email->from_name)?($email->from_name):($this->ci->config->item('site_name'));
			 $this->cc		 =	$email->cc;
			 
			 return TRUE;
		  }
		  else
			 return FALSE;
	   }
	   else
		  return FALSE;
    }
    
    public function feed_data($params)
    {
	   if(!empty($params))
	   {
		  
	   }
	   else
		  return FALSE;
    }
    
    function _request($attachment="")
    {
	   $config['protocol']	  =	 'sendmail';	  //sendmail, smtp, mail
	   $config['charset']	  =	 'utf-8';
	   $config['wordwrap']	  =	 TRUE;
	   $config['mailtype']	  =	 'html';
	   
	   $config['smtp_host']	  =	 'mail.yinnovators.net';
	   $config['smtp_user']	  =	 'no-reply@yinnovators.net';
	   $config['smtp_pass']	  =	 'Y0ungN0Reply426';
	   $config['smtp_port']	  =	 25;
	   $config['smtp_crypto']  =	'ssl';
	   $config['smtp_timeout'] =	300;
	   $config['validate']	  =	 TRUE;
	   
	   $this->ci->email->initialize($config);

	   $this->ci->email->from($this->from_email, $this->from_name);
	   $this->ci->email->to($this->to);
	   $this->ci->email->subject($this->subject);
	   $this->ci->email->message($this->body);
        if(is_array($attachment))
        {
             $this->ci->email->attach($attachment[0]);
             $this->ci->email->attach($attachment[1]);
        }
        elseif($attachment != "")
             $this->ci->email->attach($attachment);
        
        
	   if($this->ci->email->send(TRUE))
		  return TRUE;
	   else
		  return FALSE;
    }
}