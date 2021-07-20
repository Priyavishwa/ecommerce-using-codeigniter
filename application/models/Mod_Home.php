<?php

class Mod_Home extends CI_Model
{
    public function getAllCategories()
    {
        return $this->db->get_where('categories',array('cStatus'=>1));
    }

    public function getAllProducts($limit)
    {
        $this->db->limit($limit);
        return $this->db->get_where('models',array('mStatus'=>1));
    }

    /** Models code start from here */
    public function checkModel($id)
    {
        return $this->db->select('models.*,products.*')
        ->from('models')
        ->where(array('mId'=>$id,'mStatus'=>1))
        ->join('products','products.pId =models.productId')
        ->get()
        ->result_array();
        //return $this->db->get_where('models',array('mId'=>$id,'mStatus'=>1))->result_array();

    }
    /** Models code end here */
    
}// class ends here

?>