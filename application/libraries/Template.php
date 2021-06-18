<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Template {
    protected $CI;
    public function __construct()
    {	
		$this->CI =& get_instance();
        
    }
    public function admin_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
            $this->template['header']          = $this->CI->load->view('template_admin/header', $data, TRUE);
            $this->template['topbar']     = $this->CI->load->view('template_admin/topbar', $data, TRUE);
            $this->template['sidebar']    = $this->CI->load->view('template_admin/sidebar', $data, TRUE);
            $this->template['content']         = $this->CI->load->view($content, $data, TRUE);
            // $this->template['control_sidebar'] = $this->CI->load->view('template/admin/control_sidebar', $data, TRUE);
            $this->template['footer']          = $this->CI->load->view('template_admin/footer', $data, TRUE);
            return $this->CI->load->view('template_admin/templates', $this->template);
        }
	}

     public function public_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
            $this->CI->load->model('MenuModel');
            $data['menu']=$this->CI->MenuModel->menu();
            $this->template['header']          = $this->CI->load->view('template/public/header', $data, TRUE);

            $this->template['main_header']     = $this->CI->load->view('template/public/main_header', $data, TRUE);
            // $this->template['main_sidebar']    = $this->CI->load->view('admin/_templates/main_sidebar', $data, TRUE);
            $this->template['content']         = $this->CI->load->view($content, $data, TRUE);
            // $this->template['control_sidebar'] = $this->CI->load->view('admin/_templates/control_sidebar', $data, TRUE);
            $this->template['footer']          = $this->CI->load->view('template/public/footer', $data, TRUE);
            return $this->CI->load->view('template/public/templates', $this->template);
        }
    }
    public function auth_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {
            $this->template['header']  = $this->CI->load->view('auth/header', $data, TRUE);
            $this->template['content'] = $this->CI->load->view($content, $data, TRUE);
            $this->template['footer']  = $this->CI->load->view('auth/footer', $data, TRUE);
            return $this->CI->load->view('auth/v_auth', $this->template);
        }
	}
}