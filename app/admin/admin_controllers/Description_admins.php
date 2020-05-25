<?php
class Description_admins extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect_admin('admins');
        }
        
        $this->descriptionAdminModel = $this->model('Description_admin');
    }

    public function addDescription(){
        
    }
    
}
