<?php

class User extends CI_Controller
{
    public function index()
    {
        if(userLoggedIn()) {
            $data['allCategories'] = $this->mod_Home->getAllCategories();
            $data['allModels'] = $this->mod_Home->getAllProducts(8);
            //var_dump($data['allProducts']->num_rows());
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('user/mainHome',$data);    
            $this->load->view('header/footer');     
            $this->load->view('header/htmlclose');
            //echo 'Welcome' .$this->session->userdata('uFirstName');

        }else{
            setFlashData('alert-danger','please login now','signup');
            //echo 'please login now';

        }
        
    }

    public function logOut()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    
}

?>