<?php

class ModUser extends CI_Model
{

    public function checkUser($data)
    {
        //It takes two parameter table name and associative array
        return $this->db->get_where('users',array('uEmail'=>$data['uEmail']))->result_array();
        //select * from users where uEmail="abc"
    }

    public function addUser($data)
    {
        return $this->db->insert('users',$data);
    }

    public function checkLink($link)
    {
        return $this->db->get_where('users',array('link'=>$link))->result_array();
    }

    public function activateUser($uId,$data)
    {
        $this->db->where('uId',$uId);
        return $this->db->update('users',$data);
        //array('uStatus'=>1,'uLink'=>$link.'ok'));
    }

}

?>