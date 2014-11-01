<?php

class User extends UserBaseController{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in())
        {
            $this->user_auth->view('dashboard');
        }
        else
        {
            $this->login();
        }
    }


    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|callback_field_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_conf]');
        $this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('email', 'Email Address', 'required|min_length[6]|valid_email|callback_field_exists');

        if($this->form_validation->run() == FALSE)
        {
            $this->user_auth->view('register');
        }
        else
        {
            $username = set_value('username');
            $password = $this->user_auth->salt(set_value('password'));
            $email = set_value('email');

            if($this->user_auth->register($username, $password, $email) === TRUE)
            {
                $data['message'] = "The user account has now been created.";
                $this->user_auth->view('message', $data);

            } // if($this->user_auth->register($username, $password, $email) === TRUE)
            else
            {
                $data['message'] = "The user account has not been created.";
                $this->user_auth->view('message', $data);
            }

        } // if($this->form_validation->run() == FALSE)

    } // public function register()


    public function login($redirect = NULL) {

        if($redirect === NULL)
        {
            $redirect = $this->user_auth->config['auth_login'];
        }

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if($this->form_validation->run() == FALSE)
        {
            $this->user_auth->view('login');
        }
        else
        {
            $username = set_value('username');
            $password = $this->user_auth->salt(set_value('password'));
            $field_type  = (valid_email($username)  ? 'email' : 'username');

            $user_data = $this->user_auth->get_user($username, $field_type);


            if(array_key_exists('password', $user_data) AND $user_data['password'] === $password)
            {

                unset($user_data['password']);
                unset($user_data['id']);

                $this->user_auth->login_user($user_data);

                redirect($redirect);


            } // if($user_data['password'] === $password)
            else
            {
                $data['message'] = "The username and password did not match.";
                $this->user_auth->view('message', $data);
            }
        } // if($this->form_validation->run() == FALSE)

    } // login()

    public function logout() {
        $this->user_auth->logout();
    }

}

?>