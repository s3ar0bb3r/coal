<?php
/**
* Authentication Library
*
* @package Authentication
* @category Libraries
* @author Adam Griffiths
* @link http://adamgriffiths.co.uk
* @version 2.0.3
* @copyright Adam Griffiths 2011
*
* Auth provides a powerful, lightweight and simple interface for user authentication .
*/

class AdminBaseController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		log_message('debug', 'Application Loaded');

		$this->load->library(array('form_validation', 'ag_auth'));
		$this->load->helper(array('url', 'email', 'ag_auth'));
		
		$this->config->load('ag_auth');
	}
	
	public function field_exists($value)
	{
		$field_name  = (valid_email($value)  ? 'email' : 'username');
		
		$user = $this->ag_auth->get_user($value, $field_name);
		
		if(array_key_exists('id', $user))
		{
			$this->form_validation->set_message('field_exists', 'The ' . $field_name . ' provided already exists, please use another.');
			
			return FALSE;
		}
		else
		{			
			return TRUE;
			
		} // if($this->field_exists($value) === TRUE)
		
	} // public function field_exists($value)
}

class UserBaseController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        log_message('debug', 'Application Loaded');

        $this->load->library(array('form_validation', 'user_auth'));
        $this->load->helper(array('url', 'email', 'user_auth'));

        $this->config->load('user_auth');
    }

    public function field_exists($value)
    {
        $field_name  = (valid_email($value)  ? 'email' : 'username');

        $user = $this->user_auth->get_user($value, $field_name);

        if(array_key_exists('id', $user))
        {
            $this->form_validation->set_message('field_exists', 'The ' . $field_name . ' provided already exists, please use another.');

            return FALSE;
        }
        else
        {
            return TRUE;

        } // if($this->field_exists($value) === TRUE)

    } // public function field_exists($value)
}