<?php

use PSpell\Config;

defined('BASEPATH') or exit('No direct script access allowed');
class Article extends CI_Controller
{
    public function index($page=1)
    { 
        $this->load->model('Article_model');
        $this->load->library('pagination');
        $config['base_url']=base_url('admin/article/index');
        $config['total_rows']=$this->Article_model->getArticlesCount($param);
        $config['per_page']=1;
        $config['use_page_number']=true;


        $config["full_tag_open"]   = '<ul class="pagination">';
        $config["full_tag_close"]  = '</ul>';
        $config["first_tag_open"]  = '<li class="page-item page-link">';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"]   = '<li class="page-item page-link">';
        $config["last_tag_close"]  = '</li>';
        $config["next_tag_open"]   = '<li class="page-item"><span aria-hidden="true">';
        $config["next_tag_close"]  = '</span></li>';
        $config["prev_tag_open"]   = '<li class="page-item"> <span aria-hidden="true">';
        $config["prev_tag_close"]  = '</span></li>';
        $config["num_tag_open"]    = '<li class="page-item ">';
        $config["num_tag_close"]   = '</li>';
        $config["cur_tag_open"]    = '<li class="page-item active"> <a>';
        $config["cur_tag_close"]   = '</a></li>';

        $config['first_link']      = "First";
        $config['last_link']       = "Last";
        $config['next_link']      = "Next";
        $config['prev_link']       = "Prev";
        $config['attributes']       = array('class'=>'page-link');








        $this->pagination->initialize($config);
        $pagination=$this->pagination->create_links();
        $param['offset']= $config['per_page'];
        $param['q']= $this->input->get('q');
        $param['limit']= ($page*$config['per_page'])-$config['per_page'];
       $articles= $this->Article_model->getArticles($param);
       $data['articles']=$articles;
       $data['pagination']=$pagination;
        $this->load->view('admin/article/list',$data);
    }
    public function create()
    {
        $this->load->model('Category_model');
        $this->load->helper('common_helper');
       
       
       
       $categories=$this->Category_model->getCategories();
       $data['categories']=$categories;
       $this->load->model('Article_model');
       $config['upload_path']          = './public/uploads/article/';
       $config['allowed_types']        = 'gif|jpg|png|jpeg|txt|mp3|xls|docs|mp4|';
    //    $config['max_size']             = 100;
    //    $config['max_width']            = 1024;
    //    $config['max_height']           = 768;
       $config['encrypt_name']         =true;
       
       $this->load->library('upload', $config);

       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
       $this->form_validation->set_rules('category_id','category','trim|required');
       $this->form_validation->set_rules('title','title','trim|required');
       $this->form_validation->set_rules('description','description','trim|required|min_length[20]');
       $this->form_validation->set_rules('author','author','trim|required');
        if($this->form_validation->run()==true){
            if(!empty($_FILES['image']['name'])){
                if($this->upload->do_upload('image'))
                {
                    $data=$this->upload->data();
                    // print_r($data['file_name']);
                    // exit;
                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb-admin/' . $data['file_name'], 1120, 800);
                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb-front/' . $data['file_name'], 300, 250);
//                     var_dump($config['upload_path'] .'thumb-admin/'. $data['file_name']);
//                     var_dump($config['upload_path'] .'thumb-front/'. $data['file_name']);
// exit;
                    $formArray['image']=$data['file_name'];
                    $formArray['category']=$this->input->post('category_id');
                    $formArray['title']=$this->input->post('title');
    
                    $formArray['description']=$this->input->post('description');
    
                    $formArray['author']=$this->input->post('author');
    
                    $formArray['status']=$this->input->post('status');
                    $formArray['created_at']=date('Y-m-d H:i:s');
                    $this->Article_model->addArticles($formArray);
                    $this->session->set_flashdata('success','An Article added successfully!');
                    redirect(base_url().'admin/article/index');
                }else{
                    $errors=$this->upload->display_errors('<p class="invalid-feedback">','</p>');
                    $data['imageError']=$errors;
                    $this->load->view('admin/article/create',$data);
                }

            }else{
                $formArray['category']=$this->input->post('category_id');
                $formArray['title']=$this->input->post('title');

                $formArray['description']=$this->input->post('description');

                $formArray['author']=$this->input->post('author');

                $formArray['status']=$this->input->post('status');
                $formArray['created_at']=date('Y-m-d H:i:s');
                $this->Article_model->addArticles($formArray);
                redirect(base_url().'admin/article/index');
            }

        }else{
            $this->load->view('admin/article/create',$data);
        }

        
    }

    public function edit()
    {

    }

    public function delete()
    {

    }



}