<?php

$this->load->view($this->config->item('auth_views_root') . 'common/header');

if(isset($data))
{
	$this->load->view($this->config->item('auth_views_root') . 'auth/'.$page, $data);
}
else
{
	$this->load->view($this->config->item('auth_views_root') . 'auth/'.$page);
}

$this->load->view($this->config->item('auth_views_root') . 'common/footer');

?>