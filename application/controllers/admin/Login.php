<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        // print_r('test');
        // exit;
        // $this->load->library('form_validation');
        // echo password_hash('admin',PASSWORD_DEFAULT);
        $this->load->library('form_validation');
        $this->load->view('admin/login');
    }
    public function authenticate(){
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->form_validation->set_rules('username','username','trim|required');
        $this->form_validation->set_rules('password','password','trim|required');


        if($this->form_validation->run()==true){
            $username=$this->input->post('username');
            $admin=$this->Admin_model->getbyiusername($username);
            if(!empty($admin)){
                $password=$this->input->post('password');

                if(password_verify($password,$admin['password'])==true){
                    $adminArray['admin_id']=$admin['id'];
                    $adminArray['username']=$admin['username'];
                $this->session->set_userdata('admin',$adminArray);
                redirect(base_url().'admin/home/index');
                }else{
                    $this->session->set_flashdata('msg','Email and Username is DoesNot Exist!!');
                redirect(base_url().'admin/login');
                }
            }else{
                $this->session->set_flashdata('msg','Email and Username is DoesNot Exist!!');
                redirect(base_url().'admin/login');
            }
        }else{
            $this->load->view('admin/login');
        }
    }
    public function logouit(){
        $this->session->unset_userdata('admin');
        redirect(base_url().'admin/login/index');
    }
}

