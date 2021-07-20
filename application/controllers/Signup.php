<?php

 class Signup extends CI_Controller
{
    public function index()
    {
        if(userLoggedIn()) {
            redirect('user');

        }else{
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/signup');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');

        }
        
    }

    public function newUser()
    {
        $this->form_validation->set_rules('firstName','First Name','required');
        $this->form_validation->set_rules('lastName','Last Name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() == false) {
            $this->index();
            //echo "missing something";
        }else{
            $data['uFirstName'] = $this->input->post('firstName',true);
            $data['uLastName'] = $this->input->post('lastName',true);
            $data['uEmail'] = $this->input->post('email',true);
            $data['uPassword'] = $this->input->post('password',true);
            $data['uDate'] = date('y-m-d h:i:sa');
            $data['uLink'] = random_string('alnum',20);
            $data['uPassword'] = hash('md5',$data['uPassword']);

            $myUser = $this->modUser->checkUser($data);
            if(count($myUser) == 1) {
                setFlashData('alert-danger','user already exist.','signup');
                //echo "user already exist.";
            }else{
                $userAdd = $this->modUser->addUser($data);
                if($userAdd){
                    return $this->sendEmailUser($data);
                    //echo "added";

                }else{
                    setFlashData('alert-danger','We can not add the user right now. Please try again later','signup');
                    //echo "can't add now";

                }
            }
            //var_dump($myUser);
            //echo "fine";
        }
        
        
        
    }

    public function activateAccount()
    {
        if(!empty($link) && isset($link)) {
            $user = $this->modUser->checkLink($link);
            if(count($user) == 1) {
                $userData['uLink'] = $user[0]['uLink'].'ok';
                $userData['uStatus'] = 1;
                $updateUser = $this->modUser->activateUser($user[0]['uId'],$userData);
                if($updateUser) {
                    echo "We have successfully activated your account";

                }else{
                    echo "We can not activate your account, please try again";

                }

            }else{
                echo "not available the link or expired";

            }

        }else{
            echo "check your email address and try again";

        }

    }

    private function sendEmailUser($data)
    {
        $userLink = site_url('signup/activateAccount'.$data['uLink']);
        $myData = '<p>'.$data['uFirstName'].', please click on the link to activate your 
        <a href="'.$userLink.'">account</a>.</p>';

        $config = array(
            'useragent'=>'CodeIgniter',
            'protocol'=>'mail',
            'mailpath'=>'/usr/sbin/sendmail',
            'smtp_host'=>'localhost',
            'smtp_user'=>'kumpriya1010@gmail.com',
            'smtp_pass'=>'9930805719',
            'smtp_port'=>25,
            'smtp_timeout'=>55,
            'wordwrap'=>TRUE,
            'wrapchars'=>76,
            'mailtype'=>'html',
            'charset'=>'utf-8',
            'validate'=>FALSE,
            'priority'=>3,
            'crlf'=>"\r\n",
            'newline'=>"\r\n",
            'bcc_batch_mode'=>FALSE,
            'bcc_batch_size'=>200,
 
         );
         $this->email->from('kumpriya1010@gmail.com','Priya');
         $this->email->to($data['uEmail']);
         $this->email->subject('Account activation');
         $this->email->message('message');
         $this->email->set_mailtype('html');

         if($this->email->send())
         {
           return true;

         }
         else{
           return false;

         }

    }

} // class ends here. 

?>