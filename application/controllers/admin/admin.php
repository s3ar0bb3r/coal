<?php

class Admin extends AdminBaseController
{
	public function __construct() {
		parent::__construct();
	}


    public function manage() {
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

    public function delete($id) {
        $this->db->where('id', $id)->delete($this->ag_auth->config['auth_user_table']);
        $this->ag_auth->view('users/delete_success');
    }

    public function login($redirect = NULL) {

        if($redirect === NULL) {
            $redirect = $this->ag_auth->config['auth_login'];
        }

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if($this->form_validation->run() == FALSE) {
            $this->ag_auth->view('login');
        } else {
            $username = set_value('username');
            $password = $this->ag_auth->salt(set_value('password'));
            $field_type  = (valid_email($username)  ? 'email' : 'username');

            $user_data = $this->ag_auth->get_user($username, $field_type);


            if(array_key_exists('password', $user_data) AND $user_data['password'] === $password) {

                unset($user_data['password']);
                unset($user_data['id']);

                $this->ag_auth->login_user($user_data);

                redirect($redirect);


            } else {
                $data['message'] = "The username and password did not match.";
                $this->ag_auth->view('message', $data);
            }
        } // if($this->form_validation->run() == FALSE)

    } // login()

    public function logout() {
        $this->ag_auth->logout();
    }

}

/* End of file: dashboard.php */
/* Location: application/controllers/admin/dashboard.php */