<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supervisor_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
        $this->load->model("cashier_model");
		$this->load->model("liquidation_model");
		$this->load->model("cfscashier_model");
		$this->load->model("treasury_model");
		$this->load->model("supervisor_model");
		$this->load->helper('text');
	}

	public function supervisor_dashboard_ctrl()
	{
		$data['emp_id'] = $this->session->userdata('emp_id');
		$data['username'] = $this->session->userdata('username');

        if(empty($this->session->userdata('emp_id')))
        {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($this->session->userdata('emp_id'));

            $data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
         
            $this->load->view('supervisor_side/dashboard', $data);
        }
	}

	public function supervisor_adjustment_ctrl()
	{
		$data['emp_id'] = $this->session->userdata('emp_id');
		$data['username'] = $this->session->userdata('username');

        if(empty($this->session->userdata('emp_id')))
        {
            redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/');
        }
        else
        {
            $info = $this->main_model->info_mod($this->session->userdata('emp_id'));

            $data['photo_url'] =  $_SERVER['HTTP_HOST'] . "/hrms/" . substr($info->photo, 3);
         
            $this->load->view('supervisor_side/sup_adjustment_form', $data);
        }
	}

}
