<?php

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/login');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function checkUser()
    {
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() == false) {
            $this->index();
            //echo "error";

        }else{
            $data['uEmail'] = $this->input->post('email',true);
            $data['uPassword'] = $this->input->post('password',true);
            $data['uPassword'] = hash('md5',$data['uPassword']);
            //var_dump($data);
            $user = $this->modUser->checkUser($data);
            if(count($user) == 1) {
                switch($user[0]['uStatus']) {
                    case 0:
                        setFlashData('alert-danger','Please activate your account before login.','login');
                        //echo 'Please activate your account before login';
                        break;
                    case 1:
                        //echo 'created session';
                        if($user[0]['uPassword'] == $data['uPassword']) {
                            //session here
                            $myActualUser = array(
                                'uId'=>$user[0]['uId'],
                                'uFirstName'=>$user[0]['uFirstName'],
                                'uFirstLast'=>$user[0]['uFirstLast'],
                                'uEmail'=>$user[0]['uEmail'],
                                'uDate'=>$user[0]['uDate']
                            );
                            $this->session->set_userdata($myActualUser);
                            //check whether session is available or not
                            if($this->session->userdata('uId')) {
                                redirect('user');
                                //echo 'Session is created';

                            }else{
                                setFlashData('alert-danger','Session is not created.','login');
                                //echo 'Session is not created.';

                            }
                            //echo 'create the session here';

                        }else{
                            setFlashData('alert-danger','Your password is invalid.','login');
                            //echo "Your password is invalid";

                        }

                        break;
                    case 2:
                        setFlashData('alert-danger','admin blocked you.','login');
                        //echo 'admin blocked you';
                        break;
                }
            }else{
                setFlashData('alert-danger','check your email address and password.','login');
                //echo 'check your email address and password';
            }
        }
    }




}

?>