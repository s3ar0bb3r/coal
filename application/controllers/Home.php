<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

//    public  function  test($var1, $var2) {
//        $this->load->view('welcome_message');
//
//    }
//
//    public function _remap($method, $params= array())
//    {
//        return call_user_func_array(array($this, $method), $params);
//    }
//
//    public function _output($output) {
//        echo "output";
//    }
}
