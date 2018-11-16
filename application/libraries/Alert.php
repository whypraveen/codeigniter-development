<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alert
{
	public function __construct()
	{
		$this->CI	=&	get_instance();
		
		$this->error	=	"NOTIFICATION_ERROR";
		$this->success	=	"NOTIFICATION_SUCCESS";
		$this->notice	=	"NOTIFICATION_NOTICE";
		$this->warning	=	"NOTIFICATION_WARNING";
		
		$this->CI->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->CI->output->set_header('Pragma: no-cache');
		$this->CI->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	}
	
	public function error($message="")
	{
		if($message != "")
		{
			if($this->CI->session->userdata($this->error))
				$this->CI->session->unset_userdata($this->error);
			
			$this->CI->session->set_userdata($this->error,$message);
			return true;
		}
		else
		{
			if($this->CI->session->userdata($this->error))
			{
				$msg	=	$this->CI->session->userdata($this->error);
				$this->CI->session->unset_userdata($this->error);
				
				return $msg;
			}
		}
	}
	
	public function success($message="")
	{
		if($message != "")
		{
			if($this->CI->session->userdata($this->success))
				$this->CI->session->unset_userdata($this->success);
			
			$this->CI->session->set_userdata($this->success,$message);
			return true;
		}
		else
		{
			if($this->CI->session->userdata($this->success))
			{
				$msg	=	$this->CI->session->userdata($this->success);
				$this->CI->session->unset_userdata($this->success);
				
				return $msg;
			}
		}
	}
	
	public function notice($message="")
	{
		if($message != "")
		{
			if($this->CI->session->userdata($this->notice))
				$this->CI->session->unset_userdata($this->notice);
			
			$this->CI->session->set_userdata($this->notice,$message);
			return true;
		}
		else
		{
			if($this->CI->session->userdata($this->notice))
			{
				$msg	=	$this->CI->session->userdata($this->notice);
				$this->CI->session->unset_userdata($this->notice);
				
				return $msg;
			}
		}
	}
	
	public function warning($message="")
	{
		if($message != "")
		{
			if($this->CI->session->userdata($this->warning))
				$this->CI->session->unset_userdata($this->warning);
			
			$this->CI->session->set_userdata($this->warning,$message);
			return true;
		}
		else
		{
			if($this->CI->session->userdata($this->warning))
			{
				$msg	=	$this->CI->session->userdata($this->warning);
				$this->CI->session->unset_userdata($this->warning);
				
				return $msg;
			}
		}
	}
}