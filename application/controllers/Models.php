<?php

class Models extends CI_Controller
{
    public function index()
    {
        $data['allCategories'] = $this->mod_Home->getAllCategories();
        $data['allModels'] = $this->mod_Home->getAllProducts(8);
        //var_dump($data['allProducts']->num_rows());
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/mainHome',$data);    
        $this->load->view('header/footer');     
        $this->load->view('header/htmlclose');
    }

    public function myModel($id)
    {
        if(!empty($id)){
            //check the id in the database
            $data['speItem'] =$this->mod_Home->checkModel($id);
            //var_dump($data['speItem']->num_rows());

            //die();
            if(count($data['speItem']) == 1) {
                $data['allCategories'] = $this->mod_Home->getAllCategories();
                $data['allModels'] = $this->mod_Home->getAllProducts(8);
                $this->load->view('header/header');
                $this->load->view('header/css');
                $this->load->view('header/navbar');
                $this->load->view('model/mainHome',$data);    
                $this->load->view('header/footer');     
                $this->load->view('header/htmlclose');

            }else{
                echo 'data is not matched from the database';

            }
            

        }else{
            echo 'error';

        }
        
        
    }
}

?>