<?php
/**
 * Author: Priya V
 * Date:12/06/2021
 */
function setFlashData($class,$message,$url)
{
    $ci = get_instance();
    $ci->load->library('session');
    $ci->session->set_flashdata('class',$class);
    $ci->session->set_flashdata('message',$message);
    redirect($url);
    //echo 'working';
}

function adminLoggedIn(){
    $ci = get_instance();
    $ci->load->library('session');
        if($ci->session->userdata('aId')){
            return TRUE;
        }else{
            FALSE;
        }

}

    function getAdminId(){
    $ci = get_instance();
    $ci->load->library('session');
        if($ci->session->userdata('aId')){
            return $ci->session->userdata('aId');
        }else{
            FALSE;
        }

}

function userLoggedIn(){
    $ci = get_instance();
    $ci->load->library('session');
        if($ci->session->userdata('uId')){
            return TRUE;
        }else{
            FALSE;
        }

}
 function checkFlash() {
    $ci = get_instance();
    $ci->load->library('session');
        if($ci->session->flashdata('class')){
            $data['class'] = $ci->session->flashdata('class');
            $data['message'] = $ci->session->flashdata('message');
            $ci->load->view('flashdata',$data);//create view named as 'flashdata'
        }

 }

 function getSpecs($modelId) {
    $ci = get_instance();
    //$ci->load->library('database');
    return $ci->db->get_where('specs', array('modelId'=>$modelId,'spStatus'=>1));  

 }

 function getSpecValue($specId) {
    $ci = get_instance();
    //$ci->load->library('database');
    return $ci->db->get_where('spec_values', array('specId'=>$specId,'spvStatus'=>1));  

 }



 ?>