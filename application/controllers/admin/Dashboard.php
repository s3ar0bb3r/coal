<?php
class Dashboard extends AdminBaseController {
    public function __construct()
    {
        parent::__construct();
        $this->ag_auth->restrict('admin'); // restrict this controller to admins only
    }
}