<?php

class Article_model extends CI_Model {




    public function getarticle()
    {
    }
    public function getArticlesCount()
    {
    $query=$this->db->count_all_results('articles');
    // $artcles=$quesry->result_array();
    return $query;
    

    }
    public function getarticles($param=array())
    {
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'],$param['limit']);
        }
        if(isset($param['q'])){
            $this->db->or_like('title',trim($param['q']));
            $this->db->or_like('author',trim($param['q']));
            $this->db->or_like('created_at',trim($param['q']));
        }
    $query=$this->db->get('articles');
    echo $this->db->last_query();
    $artcles=$query->result_array();
    return $artcles;


    }
    public function addArticles($formArray)
    {
        $this->db->insert('articles',$formArray);
        return $this->db->insert_id();

    }
    public function updatearticles()
    {

    }
    public function deletetarticles()
    {

    }
    
    
        

   
}
?>