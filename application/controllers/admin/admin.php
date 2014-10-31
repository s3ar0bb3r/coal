<?php

class Admin extends AdminBaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(logged_in())
		{
			$this->ag_auth->view('dashboard');
		}
		else
		{
			$this->login();
		}
	}


    public function manage()
    {
        $this->load->library('table');

        $data = $this->db->get($this->ag_auth->config['auth_user_table']);
        $result = $data->result_array();
        $this->table->set_heading('Username', 'Email', 'Actions'); // Setting headings for the table

        foreach($result as $value => $key)
        {
            $actions = anchor("admin/users/delete/".$key['id']."/", "Delete"); // Build actions links
            $this->table->add_row($key['username'], $key['email'], $actions); // Adding row to table
        }

        $this->ag_auth->view('users/manage'); // Load the view
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->ag_auth->config['auth_user_table']);
        $this->ag_auth->view('users/delete_success');
    }

}

/* End of file: dashboard.php */
/* Location: application/controllers/admin/dashboard.php */