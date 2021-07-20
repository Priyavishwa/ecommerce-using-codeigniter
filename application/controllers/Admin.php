<?php
/**
 * Author: Priya V
 * Date:09/06/2021
 */

 class Admin extends CI_Controller
 {
     public function index()
     {
          
        if($this->session->userdata('aId')){
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/index');
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');

        }else{
            setFlashData('alert-danger','Please login first to access your admin panel.','admin/login');
            /*$this->session->set_flashdata('error','Please login first to access your admin panel.');
            redirect('admin/login');*/
        }
        

     }

     public function login()
     {
        $this->load->view('admin/login');
     }

     public function checkAdmin()
     {
        $data['aEmail'] = $this->input->post('email',true);
        $data['aPassword'] = $this->input->post('password',true);
        
        // Checking the credential from database for admin
        if(!empty($data['aEmail']) && !empty($data['aPassword'])){
            $admindata = $this->modAdmin->checkAdmin($data);
            if(count($admindata) == 1){
                $forSession = array(
                    'aId'=>$admindata[0]['aId'],
                    'aName'=>$admindata[0]['aName'],
                    'aEmail'=>$admindata[0]['aEmail'],

                );
                $this->session->set_userdata($forSession);
                if($this->session->userdata('aId')){
                    redirect('admin');
                    
                }
                else{
                    echo 'session not created';
                }


            }else{
                setFlashData('alert-warning','Email or Password is not matched. Please check your Email and Password.','admin/login');
                /*$this->session->set_flashdata('error','Email or Password is not matched. Please check your Email and Password.');
                redirect('admin/login');*/
                
            }
            
        }
        else{
            setFlashData('alert-warning','Please check the required field.','admin/login');
            /*$this->session->set_flashdata('error','Please check the required field.');
            redirect('admin/login');*/
            
        }
     }

     public function logOut()
     {
        if($this->session->userdata('aId')){
            $this->session->set_userdata('aId','');
            $this->session->set_flashdata('error','You have successfully logged out.');
            redirect('admin/login');
        }
        else{
            $this->session->set_flashdata('error','Please login now.');
            redirect('admin/login');

        }

     }

     public function newCategory()
     {
        /* echo phpinfo();
         die(); */
         if(adminLoggedIn()){
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newCategory');
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');
        }else{
            setFlashData('alert-danger','Please login first to add your category.','admin/login');
        }
     }

     public function addCategory()
     {
         if(adminLoggedIn()){
             $data['cName'] = $this->input->post('categoryName',true);
             if(!empty($data['cName'])) {
                 $path = realpath(APPPATH.'../assets/images/categories/');
                 $config['upload_path'] = $path;
                 $config['max_size'] = 100;
                 $config['allowed_types'] = 'jpeg|gif|jpg|png';
                 $this->load->library('upload',$config);
                 if(!$this->upload->do_upload('catDp')){
                    $error = $this->upload->display_errors();
                    setFlashData('alert-danger',$error,'admin/newCategory');
                }else{
                    $fileName = $this->upload->data();
                    $data['cDp'] = $fileName['file_name'];
                    $data['cDate'] = date('y-m-d h:i:sa');
                    $data['adminId'] = getAdminId();
                }
                $addData = $this->modAdmin->checkCategory($data);
                
                // if record is already exist
                if($addData->num_rows() > 0){
                    setFlashData('alert-danger','The category already exist.','admin/newCategory');
                }
                else{
                    $addData = $this->modAdmin->addCategory($data);
                    if($addData){
                        setFlashData('alert-success','You have successfully added your category.','admin/newCategory');
                    }else{
                        setFlashData('alert-danger','You can not add your category right now.','admin/newCategory');
                    }
                }

             }else{
                 setFlashData('alert-danger','Category name is required.','admin/newCategory');
                 
             }
             
         }else{
             setFlashData('alert-danger','Please login first to add your category.','admin/login');
         }
     }

     public function allCategories()
     {
         if(adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allCategories');
            $config['total_rows'] = '';
            $totalRows = $this->modAdmin->getAllCategories();

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            //fetch the 3rd segment
            $page = ($this->uri->segment(3))? $this->uri->segment(3):0;
            $data['allCategories'] = $this->modAdmin->fetchAllCategories($config['per_page'],$page);
            $data['link'] = $this->pagination->create_links();
            
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allCategories',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');

         }else {
            setFlashData('alert-danger','Please login first to add your category.','admin/login');

         }
     }

     public function editCategory($cId)
     {
         if(adminLoggedIn()) {
            if(!empty($cId) && isset($cId)) {
                $data['category'] = $this->modAdmin->checkCategoryById($cId);
                if(count($data['category']) == 1){
                    $this->load->view('admin/header/header');
                    $this->load->view('admin/header/css');
                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editCategory',$data);
                    $this->load->view('admin/header/footer');
                    $this->load->view('admin/header/htmlclose');
                    //echo 'found';

                }else{
                    setFlashData('alert-danger','Category not found.','admin/allCategories');
                }

            }else{
                //when user don't provide id 
                setFlashData('alert-danger','Something went wrong.','admin/allCategories');

            }

         }else{
            setFlashData('alert-danger','Please login first to edit your category.','admin/login');


         }

     }

     public function updateCategory()
     {
        if(adminLoggedIn()) {
            $data['cName'] = $this->input->post('categoryName',true);
            $cId = $this->input->post('xid',true);
            $oldImg = $this->input->post('oldImg',true);
            if(!empty($data['cName']) && isset($data['cName'])) {
                    if(isset($_FILES['catDp']) && is_uploaded_file($_FILES['catDp']['tmp_name'])) {
                        $path = realpath(APPPATH.'../assets/images/categories/');
                        $config['upload_path'] = $path;
                        $config['max_size'] = 100;
                        $config['allowed_types'] = 'jpeg|gif|jpg|png';
                        $this->load->library('upload',$config);
                        if(!$this->upload->do_upload('catDp')){
                            $error = $this->upload->display_errors();
                            setFlashData('alert-danger',$error,'admin/allCategories');
                        }else{
                            $fileName = $this->upload->data();
                            $data['cDp'] = $fileName['file_name'];
                            
                        }

                    }//image checking here

                //sending aassociative array $data to model
                $reply = $this->modAdmin->updateCategory($data,$cId);
                if($reply) {
                    if(!empty($data['cDp']) && isset($data['cDp'])) {
                        if(file_exists($path.'/'.$oldImg)) {

                            //to delete old image 
                            unlink($path.'/'.$oldImg);
                        }

                    }
                    setFlashData('alert-success','Successfully updated the category.','admin/allCategories');
                }else{
                    setFlashData('alert-danger','You can not update your category right now.','admin/allCategories');
                }

            }
            else{
                setFlashData('alert-danger','Category name is required.','admin/allCategories');
            }

        }else{
            setFlashData('alert-danger','Please login first to edit your category.','admin/login');
        }

     }

     public function deleteCategory()
     {
        if(adminLoggedIn()) {
            if($this->input->is_ajax_request()) {
                $this->input->post('id',true);
                $cId = $this->input->post('text',true);
                if(!empty($cId) && isset($cId)) {
                    $cId = $this->encryption->decrypt($cId);
                    $oldImg = $this->modAdmin->getCategoryImage($cId);
                        if(!empty($oldImg) && count($oldImg) == 1) {
                            $realImg = $oldImg[0]['cDp'];        
                        }
                    //var_dump($oldImg);
                    //die();
                    $checkMd = $this->modAdmin->deleteCategory($cId);
                    if($checkMd) {
                        if(!empty($realImg) && isset($realImg)) {
                            $path = realpath(APPPATH.'../assets/images/categories/');
                            if(file_exists($path.'/'.$realImg)) {
    
                                //to delete old image 
                                unlink($path.'/'.$realImg);
                            }
    
                        }
                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                        //echo 'successfully deleted';
                    }else{
                        $data['return'] = false;
                        $data['message'] = 'You can not delete your category right now.';
                        echo json_encode($data);
                        //echo 'You can not delete your category right now.';
                    }
                    //echo 'value exist';
                }else{
                    $data['return'] = false;
                    $data['message'] = 'value not exist.';
                    echo json_encode($data);
                    //echo 'value not exist.';
                }
            }
            else{
                setFlashData('alert-danger','Something went wrong.','admin');
            }

        }else{
            setFlashData('alert-danger','Please login first.','admin/login');
        }

     }

     public function newProduct()
     {
        /* echo phpinfo();
         die(); */
         if(adminLoggedIn()){
            $data['categories'] = $this->modAdmin->getCategories();
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newProduct',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');
        }else{
            setFlashData('alert-danger','Please login first to add your category.','admin/login');
        }
     }

     public function addProduct()
     {
         if(adminLoggedIn()){
             $data['pName'] = $this->input->post('productName',true);
             $data['pCompany'] = $this->input->post('company',true);
             $data['categoryId'] = $this->input->post('categoryId',true);

             if(
                 !empty($data['pName']) && !empty($data['pCompany']) && !empty($data['categoryId'])
                 ) 
                 {
                 $path = realpath(APPPATH.'../assets/images/products/');
                 $config['upload_path'] = $path;
                 $config['max_size'] = 100;
                 $config['allowed_types'] = 'jpeg|gif|jpg|png';
                 $this->load->library('upload',$config);
                 if(!$this->upload->do_upload('prodDp')){
                    $error = $this->upload->display_errors();
                    setFlashData('alert-danger',$error,'admin/newProduct');
                }else{
                    $fileName = $this->upload->data();
                    $data['pDp'] = $fileName['file_name'];
                    $data['pDate'] = date('Y-m-d H:i:sa');
                    $data['adminId'] = getAdminId();
                }
                $addData = $this->modAdmin->checkProduct($data);
                
                // if record is already exist
                if($addData->num_rows() > 0){
                    setFlashData('alert-danger','The product already exist.','admin/newProduct');
                }
                else{
                    $addData = $this->modAdmin->addProduct($data);
                    if($addData){
                        setFlashData('alert-success','You have successfully added your product.','admin/newProduct');
                    }else{
                        setFlashData('alert-danger','You can not add your product right now.','admin/newProduct');
                    }
                }

             }else{
                 setFlashData('alert-danger','Please check the required fields and try again.','admin/newProduct');
                 
             }
             
         }else{
             setFlashData('alert-danger','Please login first to add your product.','admin/login');
         }
     }

     public function allProducts()
     {
         if(adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allProducts');
            $config['total_rows'] = '';
            $totalRows = $this->modAdmin->getAllProducts();

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            //fetch the 3rd segment
            $page = ($this->uri->segment(3))? $this->uri->segment(3):0;
            $data['allProducts'] = $this->modAdmin->fetchAllProducts($config['per_page'],$page);
            $data['link'] = $this->pagination->create_links();
            
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allProducts',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');

         }else {
            setFlashData('alert-danger','Please login first to add your category.','admin/login');

         }
     }

     public function editProduct($pId)
     {
         if(adminLoggedIn()) {
            if(!empty($pId) && isset($pId)) {
                $data['products'] = $this->modAdmin->checkProductById($pId);
                if(count($data['products']) == 1){
                    $data['categories'] = $this->modAdmin->getCategories();
                    $this->load->view('admin/header/header');
                    $this->load->view('admin/header/css');
                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editProduct',$data);
                    $this->load->view('admin/header/footer');
                    $this->load->view('admin/header/htmlclose');
                    //echo 'found';

                }else{
                    setFlashData('alert-danger','Product not found.','admin/allProducts');
                }

            }else{
                //when user don't provide id 
                setFlashData('alert-danger','Something went wrong.','admin/allProducts');

            }

         }else{
            setFlashData('alert-danger','Please login first to edit your product.','admin/login');


         }

     }

     public function updateProduct()
     {
        if(adminLoggedIn()) {
            $data['pName'] = $this->input->post('productName',true);
            $pId = $this->input->post('xid',true);
            $oldImg = $this->input->post('oldImg',true);
            if(!empty($data['pName']) && isset($data['pName'])) {
                    if(isset($_FILES['prodDp']) && is_uploaded_file($_FILES['prodDp']['tmp_name'])) {
                        $path = realpath(APPPATH.'../assets/images/products/');
                        $config['upload_path'] = $path;
                        $config['max_size'] = 100;
                        $config['allowed_types'] = 'jpeg|gif|jpg|png';
                        $this->load->library('upload',$config);
                        if(!$this->upload->do_upload('prodDp')){
                            $error = $this->upload->display_errors();
                            setFlashData('alert-danger',$error,'admin/allProducts');
                        }else{
                            $fileName = $this->upload->data();
                            $data['pDp'] = $fileName['file_name'];
                            
                        }

                    }//image checking here

                //sending aassociative array $data to model
                $reply = $this->modAdmin->updateProduct($data,$pId);
                if($reply) {
                    if(!empty($data['pDp']) && isset($data['pDp'])) {
                        if(file_exists($path.'/'.$oldImg)) {

                            //to delete old image 
                            unlink($path.'/'.$oldImg);
                        }

                    }
                    setFlashData('alert-success','Successfully updated the product.','admin/allProducts');
                }else{
                    setFlashData('alert-danger','You can not update your product right now.','admin/allProducts');
                }

            }
            else{
                setFlashData('alert-danger','Product name is required.','admin/allProducts');
            }

        }else{
            setFlashData('alert-danger','Please login first to edit your product.','admin/login');
        }

     }

     public function deleteProduct()
     {
        if(adminLoggedIn()) {
            if($this->input->is_ajax_request()) {
                $this->input->post('id',true);
                $pId = $this->input->post('text',true);
                if(!empty($pId) && isset($pId)) {
                    $pId = $this->encryption->decrypt($pId);
                    $oldImg = $this->modAdmin->getProductImage($pId);
                        if(!empty($oldImg) && count($oldImg) == 1) {
                            $realImg = $oldImg[0]['pDp'];        
                        }
                    //var_dump($oldImg);
                    //die();
                    $checkMd = $this->modAdmin->deleteProduct($pId);
                    if($checkMd) {
                        if(!empty($realImg) && isset($realImg)) {
                            $path = realpath(APPPATH.'../assets/images/products/');
                            if(file_exists($path.'/'.$realImg)) {
    
                                //to delete old image 
                                unlink($path.'/'.$realImg);
                            }
    
                        }
                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                        //echo 'successfully deleted';
                    }else{
                        $data['return'] = false;
                        $data['message'] = 'You can not delete your product right now.';
                        echo json_encode($data);
                        //echo 'You can not delete your product right now.';
                    }
                    //echo 'value exist';
                }else{
                    $data['return'] = false;
                    $data['message'] = 'value not exist.';
                    echo json_encode($data);
                    //echo 'value not exist.';
                }
            }
            else{
                setFlashData('alert-danger','Something went wrong.','admin');
            }

        }else{
            setFlashData('alert-danger','Please login first.','admin/login');
        }

     }

     public function newModel()
     {
        /* echo phpinfo();
         die(); */
         if(adminLoggedIn()){
            $data['products'] = $this->modAdmin->getProducts();
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newModel',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');
        }else{
            setFlashData('alert-danger','Please login first to add your model.','admin/login');
        }
     }

     public function addModel()
     {
         if(adminLoggedIn()){
             $data['mName'] = $this->input->post('modelName',true);
             $data['mDescription'] = $this->input->post('mDes',true);
             $data['productId'] = $this->input->post('productId',true);
             $data['mPrice'] = $this->input->post('modelPrice',true);


             if(
                 !empty($data['mName']) && !empty($data['mDescription']) 
                 && !empty($data['productId']) && !empty($data['mPrice'])
                 ) 
                 {
                 $path = realpath(APPPATH.'../assets/images/models/');
                 $config['upload_path'] = $path;
                 $config['max_size'] = 100;
                 $config['allowed_types'] = 'jpeg|gif|jpg|png';
                 $this->load->library('upload',$config);
                 if(!$this->upload->do_upload('modelDp')){
                    $error = $this->upload->display_errors();
                    setFlashData('alert-danger',$error,'admin/newModel');
                }else{
                    $fileName = $this->upload->data();
                    $data['mDp'] = $fileName['file_name'];
                    $data['mDate'] = date('Y-m-d H:i:sa');
                    $data['adminId'] = getAdminId();
                }
                $addData = $this->modAdmin->checkModel($data);
                
                // if record is already exist
                if($addData->num_rows() > 0){
                    setFlashData('alert-danger','The model already exist.','admin/allModels');
                }
                else{
                    $addData = $this->modAdmin->addModel($data);
                    if($addData){
                        setFlashData('alert-success','You have successfully added your model.','admin/newModel');
                    }else{
                        setFlashData('alert-danger','You can not add your model right now.','admin/newModel');
                    }
                }

             }else{
                 setFlashData('alert-danger','Please check the required fields and try again.','admin/newModel');
                 
             }
             
         }else{
             setFlashData('alert-danger','Please login first to add your model.','admin/login');
         }
     }

     public function allModels()
     {
         if(adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allModels');
            $config['total_rows'] = '';
            $totalRows = $this->modAdmin->getAllModels();

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            //fetch the 3rd segment
            $page = ($this->uri->segment(3))? $this->uri->segment(3):0;
            $data['allModels'] = $this->modAdmin->fetchAllModels($config['per_page'],$page);
            $data['link'] = $this->pagination->create_links();
            
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allModels',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');

         }else {
            setFlashData('alert-danger','Please login first to add your category.','admin/login');

         }
     }

     public function deleteModel()
     {
        if(adminLoggedIn()) {
            if($this->input->is_ajax_request()) {
                $this->input->post('id',true);
                $mId = $this->input->post('text',true);
                if(!empty($mId) && isset($mId)) {
                    $mId = $this->encryption->decrypt($mId);
                    $oldImg = $this->modAdmin->getModelImage($mId);
                        if(!empty($oldImg) && count($oldImg) == 1) {
                            $realImg = $oldImg[0]['mDp'];        
                        }
                    //var_dump($oldImg);
                    //die();
                    $checkMd = $this->modAdmin->deleteModel($mId);
                    if($checkMd) {
                        if(!empty($realImg) && isset($realImg)) {
                            $path = realpath(APPPATH.'../assets/images/models/');
                            if(file_exists($path.'/'.$realImg)) {
    
                                //to delete old image 
                                unlink($path.'/'.$realImg);
                            }
    
                        }
                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                        //echo 'successfully deleted';
                    }else{
                        $data['return'] = false;
                        $data['message'] = 'You can not delete your model right now.';
                        echo json_encode($data);
                        //echo 'You can not delete your product right now.';
                    }
                    //echo 'value exist';
                }else{
                    $data['return'] = false;
                    $data['message'] = 'value not exist.';
                    echo json_encode($data);
                    //echo 'value not exist.';
                }
            }
            else{
                setFlashData('alert-danger','Something went wrong.','admin');
            }

        }else{
            setFlashData('alert-danger','Please login first.','admin/login');
        }

     }

     public function editModel($mId)
     {
         if(adminLoggedIn()) {
            if(!empty($mId) && isset($mId)) {
                $data['models'] = $this->modAdmin->checkModelById($mId);
                if(count($data['models']) == 1){
                    $data['products'] = $this->modAdmin->getProducts();
                    $this->load->view('admin/header/header');
                    $this->load->view('admin/header/css');
                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editModel',$data);
                    $this->load->view('admin/header/footer');
                    $this->load->view('admin/header/htmlclose');
                    //echo 'found';

                }else{
                    setFlashData('alert-danger','Model not found.','admin/allModels');
                }

            }else{
                //when user don't provide id 
                setFlashData('alert-danger','Something went wrong.','admin/allModels');

            }

         }else{
            setFlashData('alert-danger','Please login first to edit your model.','admin/login');


         }

     }

     public function updateModel()
     {
        if(adminLoggedIn()) {
            $data['mName'] = $this->input->post('modelName',true);
            //$data['mDescription'] = $this->input->post('m',true);
            //$data['productId'] = $this->input->post('modelName',true);
            //$data['mPrice'] = $this->input->post('modelName',true);
            $mId = $this->input->post('xid',true);
            $oldImg = $this->input->post('oldImg',true);
            if(!empty($data['mName']) && isset($data['mName'])) {
                    if(isset($_FILES['modDp']) && is_uploaded_file($_FILES['modDp']['tmp_name'])) {
                        $path = realpath(APPPATH.'../assets/images/models/');
                        $config['upload_path'] = $path;
                        $config['max_size'] = 100;
                        $config['allowed_types'] = 'jpeg|gif|jpg|png';
                        $this->load->library('upload',$config);
                        if(!$this->upload->do_upload('modDp')){
                            $error = $this->upload->display_errors();
                            setFlashData('alert-danger',$error,'admin/allModels');
                        }else{
                            $fileName = $this->upload->data();
                            $data['mDp'] = $fileName['file_name'];
                            
                        }

                    }//image checking here

                //sending aassociative array $data to model
                $reply = $this->modAdmin->updateModel($data,$mId);
                if($reply) {
                    if(!empty($data['mDp']) && isset($data['mDp'])) {
                        if(file_exists($path.'/'.$oldImg)) {

                            //to delete old image 
                            unlink($path.'/'.$oldImg);
                        }

                    }
                    setFlashData('alert-success','Successfully updated the model.','admin/allModels');
                }else{
                    setFlashData('alert-danger','You can not update your model right now.','admin/allModels');
                }

            }
            else{
                setFlashData('alert-danger','Model name is required.','admin/allModels');
            }

        }else{
            setFlashData('alert-danger','Please login first to edit your model.','admin/login');
        }

     }

     public function newSpec()
     {
        /* echo phpinfo();
         die(); */
         if(adminLoggedIn()){
            $data['models'] = $this->modAdmin->getModel();
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/newSpec',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');
        }else{
            setFlashData('alert-danger','Please login first to add your specs.','admin/login');
        }
     }

     public function addSpec()
     {
         if(adminLoggedIn()){
             $data['spName'] = $this->input->post('sp_name',true);
             $specValue = $this->input->post('sp_value',true);//array
             $specValue = array_filter($specValue);
             $data['modelId'] = $this->input->post('modelId',true);

             if(
                 !empty($data['spName']) && !empty($specValue) && !empty($data['modelId'])
                 ) 
                 {
                
                    $data['spDate'] = date('Y-m-d H:i:sa');
                    $data['adminId'] = getAdminId();
                
                    $addData = $this->modAdmin->checkSpecs($data);
                    
                    // if record is already exist
                    if($addData->num_rows() > 0){
                        setFlashData('alert-danger','The product already exist.','admin/newSpec');
                    }
                    else{
                        $specId = $this->modAdmin->checkSpecName($data);
                        if(is_numeric($specId)){
                            $spec_values = array();
                            foreach($specValue as $specVal) {
                                $spec_values[] = array(
                                'specId'=>$specId,
                                'adminId'=>$data['adminId'],
                                'spvDate'=>date('Y-m-d H:i:sa'),
                                'spvName'=>$specVal
                                );

                            }//foreach loop here
                            $specValStatus = $this->modAdmin->checkSpecValues($spec_values);
                            if($specValStatus){
                                setFlashData('alert-success','You have successfully added your spec.','admin/newSpec');

                            }else{
                                setFlashData('alert-danger','You can not add your spec values right now.','admin/newSpec');

                            }

                        }else{
                            setFlashData('alert-danger','You can not add your spec name right now. Please try again.','admin/newSpec');

                        }
 
                    }

                }else{
                    setFlashData('alert-danger','Please check the required fields and try again.','admin/newSpec');
                    
                }
                
            }else{
                setFlashData('alert-danger','Please login first to add your product.','admin/login');
            }
     }

     public function allSpecs()
     {
         if(adminLoggedIn()) {
            $config['base_url'] = site_url('admin/allSpecs');
            $config['total_rows'] = '';
            $totalRows = $this->modAdmin->getAllSpecs();

            $config['total_rows'] = $totalRows;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            //fetch the 3rd segment
            $page = ($this->uri->segment(3))? $this->uri->segment(3):0;
            $data['allSpecs'] = $this->modAdmin->fetchAllSpecs($config['per_page'],$page);
            $data['link'] = $this->pagination->create_links();
            
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navleft');
            $this->load->view('admin/home/allSpecs',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/htmlclose');

         }else {
            setFlashData('alert-danger','Please login first to add your category.','admin/login');

         }
     }

     public function deleteSpec()
     {
        if(adminLoggedIn()) {
            if($this->input->is_ajax_request()) {
                $this->input->post('id',true);
                $mId = $this->input->post('text',true);
                if(!empty($mId) && isset($mId)) {
                    $mId = $this->encryption->decrypt($mId);
                    
                    $checkMd = $this->modAdmin->deleteSpec($mId);
                    if($checkMd) {
                        
                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                        //echo 'successfully deleted';
                    }else{
                        $data['return'] = false;
                        $data['message'] = 'You can not delete your spec right now.';
                        echo json_encode($data);
                        //echo 'You can not delete your spec right now.';
                    }
                    //echo 'value exist';
                }else{
                    $data['return'] = false;
                    $data['message'] = 'value not exist.';
                    echo json_encode($data);
                    //echo 'value not exist.';
                }
            }
            else{
                setFlashData('alert-danger','Something went wrong.','admin');
            }

        }else{
            setFlashData('alert-danger','Please login first.','admin/login');
        }

     }


     public function editSpec($pId)
     {
         if(adminLoggedIn()) {
            if(!empty($pId) && isset($pId)) {
                $data['specs'] = $this->modAdmin->checkSpecById($pId);
                if(count($data['specs']) == 1){
                    $data['models'] = $this->modAdmin->getModel();
                    $this->load->view('admin/header/header');
                    $this->load->view('admin/header/css');
                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navleft');
                    $this->load->view('admin/home/editSpec',$data);
                    $this->load->view('admin/header/footer');
                    $this->load->view('admin/header/htmlclose');
                    //echo 'found';

                }else{
                    setFlashData('alert-danger','Spec not found.','admin/allSpecs');
                }

            }else{
                //when user don't provide id 
                setFlashData('alert-danger','Something went wrong.','admin/allSpecs');

            }

         }else{
            setFlashData('alert-danger','Please login first to edit your product.','admin/login');


         }

     }

     public function updateSpec()
     {
         if(adminLoggedIn()){
             $data['spName'] = $this->input->post('sp_name',true);
             $data['modelId'] = $this->input->post('modelId',true);
             $SpecId = $this->input->post('specId',true);

             if(
                 !empty($data['spName']) && !empty($SpecId) && !empty($data['modelId'])
                 ) 
                 {
                
                    //$data['spDate'] = date('Y-m-d H:i:sa');
                    //$data['adminId'] = getAdminId();
                
                    $addData = $this->modAdmin->checkSpecs($data);
                    
                    // if record is already exist
                    if($addData->num_rows() > 0){
                        setFlashData('alert-danger','The specs already exist.','admin/newSpec');
                    }
                    else{
                        
                        $updateSpecVal = $this->modAdmin->updateSpec($data,$SpecId);
                            if($updateSpecVal){
                                setFlashData('alert-success','You have successfully updated your spec.','admin/allSpecs');

                            }else{
                                setFlashData('alert-danger','You can not update your spec right now.','admin/allSpecs');

                            }
 
                    }

                }else{
                    setFlashData('alert-danger','Please check the required fields and try again.','admin/newSpecs');
                    
                }
                
            }else{
                setFlashData('alert-danger','Please login first to add your product.','admin/login');
            }
     }
 

     

 }//class ends here