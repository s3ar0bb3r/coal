<?php

function logged_in()
{
	$CI =& get_instance();
	if($CI->user_auth->logged_in() == TRUE)
	{
		return TRUE;
	}
	
	return FALSE;
}

function username()
{
	$CI =& get_instance();
	return $CI->session->userdata('username');
}

function user_group($group)
{
	$CI =& get_instance();
	
	$system_group = $CI->user_auth->config['auth_groups'][$group];
	
	if($system_group === $CI->session->userdata('group_id'))
	{
		return TRUE;
	}
}

function user_table()
{
	$CI =& get_instance();
	
	return $CI->user_auth->user_table;
}


?>