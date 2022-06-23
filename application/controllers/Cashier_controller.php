<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
		$this->load->model("cashier_model");
		$this->load->helper('text');
	}

	public function cashier_dashboard_ctrl()
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
			
			$this->load->view('cashier_side/cashier_dashboard', $data);
		}

	}

	public function cashier_cashform_ctrl()
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
			
			$this->load->view('cashier_side/cashier_cashform', $data);
			$this->load->view('cashier_side/cash_confirmationmodal');
			$this->load->view('cashier_side/cashier_js');
		}
		
	}

	public function cashier_history_ctrl()
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
		
			$this->load->view('cashier_side/cashier_historyform_v2', $data);
			$this->load->view('cashier_side/hpartialdetails_modal');
		}
		
	}

	public function cashier_noncashform_ctrl()
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
			
			$this->load->view('cashier_side/cashier_noncashform_v2', $data);
			$this->load->view('cashier_side/noncash_confirmationmodal');
			$this->load->view('cashier_side/cashier_js');
		}
		
	}

	public function cash_denomination_ctrl()
	{

		if(empty($this->session->userdata('emp_id')))
		{
			$save = "EXPIRED SESSION";
			echo json_encode($save);
		}
		else
		{

			$emp_id = $this->session->userdata('emp_id');
			$emp_data = $this->cashier_model->get_empdata($emp_id);

			$sal_no = '';
			$emp_name = '';
			$emp_type = '';
			$company_code = '';
			$bunit_code = '';
			$dep_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach ($emp_data as $d)
			{
				$sal_no = $d['payroll_no'];
				$emp_name = $d['name'];
				$emp_type = $d['emp_type'];
				$company_code = $d['company_code'];
				$bunit_code = $d['bunit_code'];
				$dep_code = $d['dept_code'];
				$section_code = $d['section_code'];
				$sub_section_code = $d['sub_section_code'];
			}

			$save = "success";
			$this->cashier_model->save_cashdenomination_model(
				$emp_id,
				$sal_no,
				$emp_name,
				$emp_type,
				$company_code,
				$bunit_code,
				$dep_code,
				$section_code,
				$sub_section_code,
				$_POST['onek'],
				$_POST['fiveh'],
				$_POST['twoh'],
				$_POST['oneh'],
				$_POST['fifty'],
				$_POST['twenty'],
				$_POST['ten'],
				$_POST['five'],
				$_POST['one'],
				$_POST['twentyfivecents'],
				$_POST['tencents'],
				$_POST['fivecents'],
				$_POST['onecents'],
				$_POST['total_cash'],
				$_POST['remit_type'],
				$_POST['status'],
				$_POST['date']
			);

			echo json_encode($save);
		}
		
	}


	public function display_mop_ctrl()
	{

		$emp_id = $this->session->userdata('emp_id');
		// $query=$this->cashier_model->search_mopaccess_model($emp_id);
		// var_dump($query);
		/*if(empty($query))
		{
			$query2=$this->cashier_model->display_mop_model();
		}
		else
		{
			$query2=$this->cashier_model->display_cfsmop_model($emp_id);
		}*/
		
		$query2=$this->cashier_model->display_mop_model();

		$html="";
		$mop_id  = '';
		foreach ($query2 as $q)
		{
			$mop_id.="+mop_".$q['id'];
			$html.='

					<tr>
						<td>
						<input type="text" class="input-sm mop_'.$q['id'].'" disabled id="" value="'.$q['mop_name'].'">
						<input type="text" class="input-sm mop_'.$q['id'].'" hidden disabled id="mop_name" value="'.$q['id'].'">
						</td>
						<td>
						<input type="number" min="0" class="input-sm quantity quantity_'.$q['id'].'  mop_'.$q['id'].' " id="'.$q['id'].'_q" placeholder="0">
						</td>
						<td>
						<input type="tel" onkeyup="total_noncash_js()" onchange="total_noncash_js()" style="font-size: 22px; text-align: center; height: 50px; width: 100%;" class="input-sm d_amount mop_'.$q['id'].'" id="'.$q['id'].'_a" placeholder="0.00" value="0.00">
						</td>
					</tr>

					<script>

						total_noncash_js();
	
						document.querySelector(".quantity_'.$q['id'].'").addEventListener("keypress", function (evt) {
							if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
							{
								evt.preventDefault();
							}
							});

		                $(".quantity").on("change keyup top press", function() {
		                  var sanitized = $(this).val().replace(/[^0-9]/g, "");
		                  $(this).val(sanitized);
		                });

					</script>

						';


		}

			$html.='

					<tr>
						<td style="float: right;">
						<button type="button" id="btn_reset_noncashform" style="height: 50px; width: 100px; font-size: 22px;" class="btn btn-primary waves-effect" onclick="reset_noncashform()">RESET</button>
						<button type="button" id="btn_save_noncashform" style="height: 50px; width: 120px; font-size: 22px;" class="btn btn-warning waves-effect" onclick="view_noncashconfimation_modal()">SUBMIT</button>
						</td>
						<td>
						<input type="text" class="input-sm" id="total_noncashtxt" disabled="" value="TOTAL NONCASH">
						</td>
						<td>
						<input type="text" class="input-sm" readonly id="total_noncash" placeholder="0.00">
						</td>
					</tr>

					<script>

						$("#load_js").load("'.base_url().'noncash_js_route");
						$("#data").val("'.$mop_id.'");

					</script>
					';

			$data['html']=$html;    	   
			echo json_encode($data);
		}

		public function noncash_js_ctrl()
		{

			$this->load->view('cashier_side/noncash_js');

		}

		public function hnoncash_js_ctrl()
		{

			$this->load->view('cashier_side/hnoncash_js');

		}


		public function cashtable_history($onek,$fiveh,$twoh,$oneh,$fifty,$twenty,$ten,$five,$one,$twentyfive_cents,$ten_cents,$five_cents,$one_cents,$id)
		{
			$html='

								 <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$onek.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_onek" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$fiveh.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_fiveh" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$twoh.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_twoh" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$oneh.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_oneh" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$fifty.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_fifty" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$twenty.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_twenty" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$ten.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_ten" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$five.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_five" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$one.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_one" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$twentyfive_cents.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_twentyfivecents" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$ten_cents.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_tencents" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$five_cents.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_fivecents" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$one_cents.'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_onecents" placeholder="0" value="0">
		                                <input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$id.'">
		                            </td>   
		                        </tr>


								<script>


								</script>

									';

				return $html;
		}

		public function displayhistory_cashform_ctrl()
		{

			$emp_id = $this->session->userdata('emp_id');
			$query2=$this->cashier_model->getpartialhistory_cashform_model($emp_id);
			

			if(empty($query2))
			{
				$query=$this->cashier_model->displayhistory_cashform_model($emp_id);

				if(!empty($query))
				{
					$html="";
					foreach ($query as $q)
					{

						if($q['remit_type'] == 'PARTIAL')
						{
							$hide = 'hidden';
						}
						else
						{
							$hide = '';
						}
						// $html.=$this->cashtable_history($q['onek'],$q['fiveh'],$q['twoh'],$q['oneh'],$q['fifty'],$q['twenty'],$q['ten'],$q['five'],$q['one'],$q['twentyfive_cents'],$q['ten_cents'],$q['five_cents'],$q['one_cents'],$q['id']);
						$html.='

								 <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$q['onek'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_onek" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$q['fiveh'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_fiveh" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$q['twoh'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_twoh" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$q['oneh'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_oneh" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$q['fifty'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_fifty" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr>
		                            <td>
		                                <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$q['twenty'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_twenty" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr '.$hide.'>
		                            <td>
		                                <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$q['ten'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_ten" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr '.$hide.'>
		                            <td>
		                                <input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$q['five'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_five" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr '.$hide.'>
		                            <td>
		                                <input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$q['one'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_one" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr '.$hide.'>
		                            <td>
		                                <input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$q['twentyfive_cents'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_twentyfivecents" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr '.$hide.'>
		                            <td>
		                                <input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$q['ten_cents'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_tencents" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr '.$hide.'>
		                            <td>
		                                <input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$q['five_cents'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_fivecents" placeholder="0" value="0">
		                            </td>
		                        </tr>

		                        <tr '.$hide.'>
		                            <td>
		                                <input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
		                            </td>
		                            <td>
		                                <input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$q['one_cents'].'">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm d_amount" readonly="" id="a_onecents" placeholder="0" value="0">
		                                <input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$q['id'].'">
		                            </td>   
		                        </tr>


								<script>
									calculate_breakdown_js();
					               disabled_scharacter_js();

								</script>
									';

						$data['cashremit_type']= $q['remit_type'];			

					}

							$html.='

									<tr>
										<td style="float: right">
			                                <button type="button" disabled="" id="btn_cancel_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_cash_denomination()">CANCEL</button>
			                                <button type="button" disabled="" id="btn_update_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historycashform_js()">UPDATE</button>
			                                <button type="button" id="btn_edit_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-primary waves-effect" onclick="enabled_cash_quantity_js()">EDIT</button>
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm" readonly id="historytotal_cash" placeholder="0.00">
			                            </td>
			                        </tr>

			          
									<script>
									
										disabled_editbtn();
										disabled_cash_quantity_js();

									</script>
									';
				}

			}
			else
			{
				$query=$this->cashier_model->displayhistory_cashform_model($emp_id);

					if(empty($query))
					{
							
							$html='';
						    $partial2 = 0;
							foreach ($query2 as $q2)
							{

								$partial2 += $q2['total_cash'];
							
								$data['cashremit_type']= $q2['remit_type'];		

							}

								$html.='

				                        <tr id="tr_partial">
				                            <td>
				                                <a id="view_hpartialdetails" onclick="view_hpartialdetails_js()"><i style="font-style: normal; font-size: xx-large; float: right; margin-right: 10%;">👁️</i></a>
				                            </td>
				                            <td>
				                                <input type="text" class="input-sm" disabled id="" placeholder="PARTIAL REMITTANCE">
				                            </td>
				                            <td>
				                                <input type="text" class="input-sm" readonly="" id="ch_partial" value="'.number_format($partial2,2).'">
				                            </td>   
				                        </tr>

										';

					}
					else
					{
						$html="";
						foreach ($query as $q)
						{

                               
						 if($q['remit_type']=='PARTIAL')
						 {
						 	$status='hidden';
						 }
						 else
						 {
						 	$status = '';
						 }

							$html.='

									 <tr>
			                            <td>
			                                <input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity cash_quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0" value="'.$q['onek'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_onek" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr>
			                            <td>
			                                <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity1 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0" value="'.$q['fiveh'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_fiveh" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr>
			                            <td>
			                                <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity2 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0" value="'.$q['twoh'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_twoh" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr>
			                            <td>
			                                <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity3 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0" value="'.$q['oneh'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_oneh" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr>
			                            <td>
			                                <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity4 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0" value="'.$q['fifty'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_fifty" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr>
			                            <td>
			                                <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity5 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0" value="'.$q['twenty'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_twenty" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr '.$status.'>
			                            <td>
			                                <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity6 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0" value="'.$q['ten'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_ten" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr '.$status.'>
			                            <td>
			                                <input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity7 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0" value="'.$q['five'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_five" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr '.$status.'>
			                            <td>
			                                <input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity8 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0" value="'.$q['one'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_one" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr '.$status.'>
			                            <td>
			                                <input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity9 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0" value="'.$q['twentyfive_cents'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_twentyfivecents" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr '.$status.'>
			                            <td>
			                                <input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity10 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0" value="'.$q['ten_cents'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_tencents" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr '.$status.'>
			                            <td>
			                                <input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity11 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0" value="'.$q['five_cents'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_fivecents" placeholder="0" value="0">
			                            </td>
			                        </tr>

			                        <tr '.$status.'>
			                            <td>
			                                <input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
			                            </td>
			                            <td>
			                                <input type="number" min="0" class="input-sm quantity12 cash_quantity" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0" value="'.$q['one_cents'].'">
			                            </td>
			                            <td>
			                                <input type="text" class="input-sm d_amount" readonly="" id="a_onecents" placeholder="0" value="0">
			                                <input type="number" min="0" hidden class="input-sm number" readonly="" id="history_cashform_id" placeholder="0" value="'.$q['id'].'">
			                            </td>   
			                        </tr>

									<script>

										disabled_scharacter_js();

									</script>

									';


							$data['cashremit_type']= $q['remit_type'];		

						}

						$partial2 = 0;
						foreach ($query2 as $q2)
						{
	
							$partial2 += $q2['total_cash'];
		
						}

						$html.='

								<tr>
									<td style="float: right">
		                                <button type="button" disabled="" id="btn_cancel_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_cash_denomination()">CANCEL</button>
		                                <button type="button" disabled="" id="btn_update_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historycashform_js()">UPDATE</button>
		                                <button type="button" id="btn_edit_cashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-primary waves-effect" onclick="enabled_cash_quantity_js()">EDIT</button>
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm" readonly id="historytotal_cash" placeholder="0.00">
		                            </td>
		                        </tr>

		                        <tr id="tr_partial">
		                            <td>
		                                <a id="view_hpartialdetails" onclick="view_hpartialdetails_js()"><i style="font-style: normal; font-size: xx-large; float: right; margin-right: 10%;">👁️</i></a>
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm" disabled id="" placeholder="PARTIAL REMITTANCE">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm" readonly="" id="ch_partial" value="'.number_format($partial2,2).'">
		                            </td>   
		                        </tr>

		                        <tr id="tr_gtotal">
		                            <td>
		                                
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm" disabled id="" placeholder="GRAND TOTAL">
		                            </td>
		                            <td>
		                                <input type="text" class="input-sm" readonly="" id="gtotal_cash" placeholder="0.00">
		                            </td>   
		                        </tr>


								<script>
								
									disabled_editbtn();
									disabled_cash_quantity_js();
									calculate_breakdown_js();

								</script>
								';

					}

			}
						  	   
				$data['html']=$html;    	   
				echo json_encode($data);
	}

	public function update_historycashform_ctrl()
	{
		if(empty($this->session->userdata('emp_id')))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$edit_project=array("success");
			$this->cashier_model->update_historycashform_model($_POST['id'],
															$_POST['onek'],
															$_POST['fiveh'],
															$_POST['twoh'],
															$_POST['oneh'],
															$_POST['fifty'],
															$_POST['twenty'],
															$_POST['ten'],
															$_POST['five'],
															$_POST['one'],
															$_POST['twentyfivecents'],
															$_POST['tencents'],
															$_POST['fivecents'],
															$_POST['onecents'],
															$_POST['total_cash']);	

			echo json_encode($edit_project);
		}
		
	}

	public function disabled_saveresetbtn_ctrl()
	{

		$emp_id = $this->session->userdata('emp_id');
		$query=$this->cashier_model->disabled_saveresetbtn_model($emp_id);

		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];

		}

		$data=$status;    	   
		echo json_encode(trim($data));
	}

	public function noncash_denomination_ctrl()
	{
		
		if(empty($this->session->userdata('emp_id')))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{
			$emp_id = $this->session->userdata('emp_id');
			$emp_data = $this->cashier_model->get_empdata($emp_id);

			$sal_no = '';
			$emp_name = '';
			$emp_type = '';
			$company_code = '';
			$bunit_code = '';
			$dep_code = '';
			$section_code = '';
			$sub_section_code = '';
			foreach ($emp_data as $d)
			{
				$sal_no = $d['payroll_no'];
				$emp_name = $d['name'];
				$emp_type = $d['emp_type'];
				$company_code = $d['company_code'];
				$bunit_code = $d['bunit_code'];
				$dep_code = $d['dept_code'];
				$section_code = $d['section_code'];
				$sub_section_code = $d['sub_section_code'];
			}

			$message = 'success';
			$this->cashier_model->insert_non_cash_model($_POST['batch_id'],
														$emp_id,
														$sal_no,
														$emp_name,
														$emp_type,
														$company_code,
														$bunit_code,
														$dep_code,
														$section_code,
														$sub_section_code,
														$_POST['amount_Arr'],
														$_POST['remit_type'],
														$_POST['status'],
														$_POST['date']);
			
			echo json_encode($message);
		}
		
	}


	public function get_batchid_ctrl()
	{
		$emp_id = $this->session->userdata('emp_id');
		$batch_id = $this->cashier_model->get_batchid($emp_id);

		if(empty($batch_id))
		{
			$b_id = 1;
		}
		else
		{
			foreach ($batch_id as $batch)
			{	
				$id = $batch['batch_id'];
				$b_id = $id+1;
			}
		}

		$data['batchid'] = $b_id;
		echo json_encode($data);
	}

	public function disabled_noncashform_ctrl()
	{

		$emp_id = $this->session->userdata('emp_id');
		$query=$this->cashier_model->disabled_noncashform_model($emp_id);

		$status="";
		foreach ($query as $q)
		{
			$status = $q['status'];

		}

		$data=$status;    	   
		echo json_encode(trim($data));

	}

	public function view_noncashmodal_ctrl()
	{
		
		$noncash_data=$this->input->post('amount_Arr');

			$html='';
			for($a=0;$a<count($noncash_data);$a+=4)
			{
				$html.='

						<tr>
			                <td>
			                    <center><label id="">'.$noncash_data[$a].'</label></center>
			                </td>
			                <td>
			                    <center><label>'.$noncash_data[$a+2].'</label></center>
			                </td>
			                <td>
			                    <center><label>'.$noncash_data[$a+3].'</label></center>
			                </td>
			           	</tr>

						';
			}

			$html.='

					 <tr>
	                	<td>
	                        <label></label>
	                    </td>
	                    <td>
	                        <center><label id="total_cashtxtm" style="font-weight: bold;">TOTAL NONCASH</label></center>
	                    </td>
	                    <td>
	                        <center><label id="total_noncashm_modal" style="font-weight: bold;"></label></center>
	                    </td>
	                </tr>

					';

		$data['html']=$html;    	      
		echo json_encode($data);

	}

	public function disabled_partialcheckbox_ctrl()
	{
		$emp_id = $this->session->userdata('emp_id');
		$query=$this->cashier_model->getpartialhistory_cashform_model($emp_id);

		if(empty($query))
		{
			$status = 'EMPTY';
		}
		else
		{
			$status = 'NOT EMPTY';
		}

		echo json_encode($status);
	}

	public function displayhistory_noncashform_ctrl()
	{

		$emp_id = $this->session->userdata('emp_id');
		$query=$this->cashier_model->displayhistory_noncashform_model($emp_id);

		
		if(!empty($query))
		{
			$html="";
			$historyncashid="";
			$hmop_id = "";
			foreach ($query as $q)
			{
				
				$hmop_id.="+hmop_".$q['id'];
				$historyncashid.="+".$q['id']."_q";
				$historyncashid.="+".$q['id']."_a";
				$html.='

						<tr>
							<td>
							<input type="text" class="input-sm" disabled id="" value="'.$q['mop_name'].'">
							<input type="text" hidden class="input-sm hmop_'.$q['id'].'" value="'.$q['id'].'">
							</td>
							<td>
							<input type="number" min="0" disabled class="input-sm quantity quantity_'.$q['id'].' hmop_'.$q['id'].'" id="'.$q['id'].'_q" value="'.$q['noncash_qty'].'">
							</td>
							<td>
							<input type="tel" disabled onkeyup="total_hnoncash_js()" style="font-size: 22px; text-align: center; height: 50px; width: 100%;" class="input-sm hd_amount hmop_'.$q['id'].'" id="'.$q['id'].'_a" value="'.number_format($q['noncash_amount'],2).'">
							</td>
						</tr>

						
						<script>

							total_hnoncash_js();
		
							document.querySelector(".quantity_'.$q['id'].'").addEventListener("keypress", function (evt) {
								if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
								{
									evt.preventDefault();
								}
								});

							 $(".quantity").on("change keyup top press", function() {
			                  var sanitized = $(this).val().replace(/[^0-9]/g, "");
			                  $(this).val(sanitized);
			                });

						</script>

							';
				$data["noncashremit_type"]= $q["remit_type"];
				$data["hncash_bid"]= $q["batch_id"];


			}

				$html.='

						<tr>
							<td style="float: right">
	                        <button type="button" disabled="" id="btn_cancel_historyncashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-info waves-effect" onclick="canceledit_historynoncash_denomination()">CANCEL</button>
	                        <button type="button" disabled="" id="btn_update_historyncashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-warning waves-effect" onclick="update_historynoncashform_js()">UPDATE</button>
	                        <button type="button" id="btn_edit_historyncashform" style="height: 50px; width: 90px; font-size: 15px;" class="btn btn-primary waves-effect" onclick="enabled_historynoncash_quantity_js()">EDIT</button>
		                    </td>
							<td>
							<input type="text" class="input-sm" id="total_noncashtxt" disabled="" placeholder="TOTAL NONCASH">
							</td>
							<td>
							<input type="text" class="input-sm" readonly id="historytotal_noncash" placeholder="0.00">
							</td>
						</tr>

						<script>

							$("#historyncashid").text("'.$historyncashid.'");
							$("#hncash_data").text("'.$hmop_id.'");
							$("#load_js").load("'.base_url().'hnoncash_js_route");

						</script>
						';
		}
		

			$data['html']=$html;    	   
			echo json_encode($data);
	}

	public function update_historynoncashform_ctrl()
	{

		if(empty($this->session->userdata('emp_id')))
		{
			$message = "EXPIRED SESSION";
			echo json_encode($message);
		}
		else
		{

			$emp_id = $this->session->userdata('emp_id');

			$update_hnc=array("success");
			$this->cashier_model->update_historynoncashform_model($emp_id,
																  $_POST['batch_id'],
															  	  $_POST['amount_Arr']);	

			echo json_encode($update_hnc);
		}
	}

	public function expired_session()
	{
		redirect('http://'.$_SERVER['HTTP_HOST'].'/hrms/employee/'); 
	}

	public function display_hpartialdetails_ctrl()
	{
		$emp_id = $this->session->userdata('emp_id');
		$query=$this->cashier_model->getpartialhistory_cashform_model($emp_id);
		// var_dump($query);
		
		$html='';
		foreach($query as $q)
		{

			$onek = $q['onek'] * 1000;
			$fiveh = $q['fiveh'] * 500;
			$twoh = $q['twoh'] * 200;
			$oneh = $q['oneh'] * 100;
			$fifty = $q['fifty'] * 50;
			$twenty = $q['twenty'] * 20;

			$html.='

				<form>
                	<center><label id="hpartialdetails_datelblmodal" style="font-weight: bold;">Date/Time Submitted -- '.$q['date_submit'].'</label></center>
                </form>

				<div class="table-scrollable">
                  <table class="table table-striped table-bordered table-hover display">
                      <thead>
                          <tr>
                              <th width="40%">
                                  <center>DENOMINATION
                              </th>
                              <th width="30%">
                                  <center>QUANTITY
                              </th>
                              <th width="30%">
                                  <center>AMOUNT
                              </th>
                          </tr>
                      </thead>
                          <form name="hpartialdetails_formmodal" id="hpartialdetails_formmodal">
                              <tbody id="hpartialdetails_tbodymmodal">

				<tr>
					<td>
                        <center><label id="d_onekm">₱1,000</label></center>
                    </td>
                    <td>
                        <center><label class="quantity" id="q_onek">'.$q['onek'].'</label></center>
                    </td>
                    <td>
                        <center><label class="d_amount" id="a_onek">'.number_format($onek, 2).'</label></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><label id="d_fivehm">₱500</label></center>
                    </td>
                    <td>
                        <center><label class="quantity1" id="q_fiveh">'.$q['fiveh'].'</label></center>
                    </td>
                    <td>
                        <center><label class="d_amount" id="a_fiveh">'.number_format($fiveh, 2).'</label></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><label id="d_twohm">₱200</label></center>
                    </td>
                    <td>
                        <center><label class="quantity2" id="q_twoh">'.$q['twoh'].'</label></center>
                    </td>
                    <td>
                        <center><label class="d_amount" id="a_twoh">'.number_format($twoh, 2).'</label></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><label id="d_onehm">₱100</label></center>
                    </td>
                    <td>
                        <center><label class="quantity3" id="q_oneh">'.$q['oneh'].'</label></center>
                    </td>
                    <td>
                        <center><label class="d_amount" id="a_oneh">'.number_format($oneh, 2).'</label></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><label id="d_fiftym">₱50</label></center>
                    </td>
                    <td>
                        <center><label class="quantity4" id="q_fifty">'.$q['fifty'].'</label></center>
                    </td>
                    <td>
                        <center><label class="d_amount" id="a_fifty">'.number_format($fifty, 2).'</label></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><label id="d_twentym">₱20</label></center>
                    </td>
                    <td>
                        <center><label class="quantity5" id="q_twenty">'.$q['twenty'].'</label></center>
                    </td>
                    <td>
                        <center><label class="d_amount" id="a_twenty">'.number_format($twenty, 2).'</label></center>
                    </td>
                </tr>

                <tr>
                	<td>
                        <label></label>
                    </td>
                    <td>
                        <center><label id="total_cashtxtm" style="font-weight: bold;">TOTAL PARTIAL CASH</label></center>
                    </td>
                    <td>
                        <center><label class="d_amount" id="total_cashm" style="font-weight: bold;">'.number_format($q['total_cash'], 2).'</label></center>
                    </td>
                </tr>

                 	 </tbody>
                    </form>
                  </table>
                </div><br>

				';
		}

		$data['html']=$html;    	   
		echo json_encode($data);
	}


}
