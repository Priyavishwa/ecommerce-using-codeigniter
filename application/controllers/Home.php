<?php
/**
 * Author: Priya V
 * Date:07/06/2021
 */

 class Home extends CI_Controller
{
    public function index()
    {
        $data['allCategories'] = $this->mod_Home->getAllCategories();
        $data['allModels'] = $this->mod_Home->getAllProducts(8);
        //var_dump($data['allProducts']->num_rows());

        //die();
        // Add css file for all pages 
        $this->load->view('header/header');

        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/mainHome',$data);

        // Add js file for all pages
        $this->load->view('header/footer');
        
        $this->load->view('header/htmlclose');
    }

    public function aboutus()
    {
        $this->load->view('header/header');
        $this->load->view('css/extracss');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('about/mainHome');
        $this->load->view('header/footer');
        $this->load->view('js/extrajs');
        $this->load->view('header/htmlclose');
        
    }

    public function login()
    {
        $this->load->view('header/header');
        //$this->load->view('css/extracss');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('login/index');
        $this->load->view('header/footer');
        //$this->load->view('js/extrajs');
        $this->load->view('header/htmlclose');
    }

}

?>