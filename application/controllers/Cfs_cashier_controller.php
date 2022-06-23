<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cfs_cashier_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model("main_model");
        $this->load->model("cashier_model");
		$this->load->model("liquidation_model");
		$this->load->model("cfscashier_model");
		$this->load->helper('text');
	}

	public function cfscashier_denomination_ctrl()
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
         
            $this->load->view('cfs_cashier_side/cfs_cashier_denomination', $data);
        }

	}

	public function cfs_forex_denomination_ctrl()
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
         
            $this->load->view('cfs_cashier_side/cfs_forex_denomination', $data);
        }

	}

	public function display_cfsothermop_ctrl()
	{

		$query=$this->cfscashier_model->display_cfsmop_model();
		// var_dump($query);
		
		$html="";
		foreach ($query as $q)
		{
	
			$html.='

					<option id="" style="text-align: center;" value="'.$q['mop_name'].'">'.$q['mop_name'].'</option>

						';
		}

		$data['html']=$html;    	   
		echo json_encode($data);

	}

	public function display_forex_currency_ctrl()
	{
		$query=$this->cfscashier_model->display_forex_currency_model();
		// var_dump($query);
		$html='';
		foreach ($query as $q)
		{
			$html.='

					<option id="" style="text-align: center;" value="'.$q['forex_currency'].'">'.$q['forex_currency'].'</option>

						';
		}
	   
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function display_forex_denomination_form_ctrl()
	{

		$currency = $_POST['currency'];
	 	$query=$this->cfscashier_model->get_forex_symbol_model($currency);

	 	foreach ($query as $q)
		{
			$symbol=$q['forex_symbol'];
			$total_currency=$q['forex_currency'];
		}

		if($symbol == '$')
		{
			$dollar='hidden';
			$euro='';
		}
		else if($symbol == '€')
		{
			$euro='hidden';
			$dollar='';
		}
		// var_dump($dollar);

		$html='
				<tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="'.$symbol.'500">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_fiveh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_fiveh" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_fiveh" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_fiveh" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$dollar.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="'.$symbol.'200">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_twoh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_twoh" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_twoh" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_twoh" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="'.$symbol.'100">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_oneh" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_oneh" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_oneh" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_oneh" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="'.$symbol.'50">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_fifty" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_fifty" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_fifty" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_fifty" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="'.$symbol.'20">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_twenty" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_twenty" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_twenty" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_twenty" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="'.$symbol.'10">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_ten" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_ten" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_ten" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_ten" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <input type="text" class="input-sm" id="d_five" disabled="" placeholder="'.$symbol.'5">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_five" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_five" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_five" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_five" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_two" disabled="" placeholder="'.$symbol.'2">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_two" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_two" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_two" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_two" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr '.$euro.'>
	                <td>
	                    <input type="text" class="input-sm" id="d_one" disabled="" placeholder="'.$symbol.'1">
	                </td>
	                <td>
	                    <input type="number" min="0" class="input-sm" onchange="cfsforex_tfccalculation_js()" onkeyup="cfsforex_tfccalculation_js()" id="q_one" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="tfc_one" placeholder="0" value="0">
	                </td>
	                <td>
	                    <input type="text" min="0" class="input-sm" id="er_one" onchange="cfscalculate_breakdown_js()" onkeyup="cfscalculate_breakdown_js()" placeholder="0">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="pa_one" placeholder="0" value="0">
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_fctxt" disabled="" placeholder="TOTAL '.$total_currency.' ">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="total_forex_fc" placeholder="0.00">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" id="forex_total_pesotxt" disabled="" placeholder="TOTAL PESO AMOUNT">
	                </td>
	                <td>
	                    <input type="text" class="input-sm" disabled id="total_forex_peso" placeholder="0.00">
	                </td>
	            </tr>


	            <script>

	            	document.querySelector("#q_fiveh").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_twoh").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_oneh").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_fifty").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_twenty").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_ten").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_five").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_two").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

			        document.querySelector("#q_one").addEventListener("keypress", function (evt) {
			          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
			          {
			              evt.preventDefault();
			          }
			          });

	            </script>

				';
	   
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function submit_cfscashiercash_ctrl()
	{

		/*$datas_arr = explode("_",$_POST['datas']);

	    $result =$datas_arr[0]."".$datas_arr[1]."".$datas_arr[2]."".$datas_arr[3]."".$datas_arr[4]."".$datas_arr[5]."".$datas_arr[6]."".$datas_arr[7]."".$datas_arr[8]."".$datas_arr[9]."".$datas_arr[10]."".$datas_arr[11]."".$datas_arr[12]." ".$datas_arr[13]." ".$datas_arr[14]."\n" ;
	
          
		$data['result'] = $result;   
        echo json_encode($data);*/

		if(empty($this->session->userdata('emp_id')))
		{
			$save = "EXPIRED SESSION";
			echo json_encode($save);
		}
		else
		{
			$datas_arr = explode("_",$_POST['datas']);

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
			$this->cfscashier_model->save_cfscashdenomination_model(
				$emp_id,
				$sal_no,
				$emp_name,
				$emp_type,
				$company_code,
				$bunit_code,
				$dep_code,
				$section_code,
				$sub_section_code,
				$datas_arr[1],
				$datas_arr[2],
				$datas_arr[3],
				$datas_arr[4],
				$datas_arr[5],
				$datas_arr[6],
				$datas_arr[7],
				$datas_arr[8],
				$datas_arr[9],
				$datas_arr[10],
				$datas_arr[11],
				$datas_arr[12],
				$datas_arr[13],
				$datas_arr[14],
				$datas_arr[15],
				$_POST['status'],
				$_POST['date']
			);

			echo json_encode($save);
		}
	}

	public function submit_cfscashiernoncash_ctrl()
	{
		if(empty($this->session->userdata('emp_id')))
		{
			$save = "EXPIRED SESSION";
			echo json_encode($save);
		}
		else
		{
			$datas_arr = explode("_",$_POST['datas']);

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
			$this->cfscashier_model->save_cfsnoncashdenomination_model(
				$emp_id,
				$sal_no,
				$emp_name,
				$emp_type,
				$company_code,
				$bunit_code,
				$dep_code,
				$section_code,
				$sub_section_code,
				$datas_arr[1],
				$datas_arr[2],
				$datas_arr[3],
				$datas_arr[4],
				$_POST['status'],
				$_POST['date']
			);

			echo json_encode($save);
		}
	}

	public function display_cfsncashmop_ctrl()
	{
		$query=$this->cfscashier_model->display_cfsncashmop_model();
		// var_dump($query);
		
		$html="";
		foreach ($query as $q)
		{
	
			$html.='

					<option id="" style="text-align: center;" value="'.$q['ncash_mopname'].'">'.$q['ncash_mopname'].'</option>

						';
		}

		$data['html']=$html;    	   
		echo json_encode($data);

	}

	public function display_cfsncashbankname_ctrl()
	{
		$query=$this->cfscashier_model->display_cfsncashbankname_model();
		// var_dump($query);
		
		$html="";
		foreach ($query as $q)
		{
	
			$html.='

					<option id="" value="'.$q['bank_name'].'">'.$q['bank_name'].'</option>

						';
		}

		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function display_cfsncashmop_ctrl_old()
	{
		$query=$this->cfscashier_model->display_cfsncashmop_model();
		// var_dump($query);
		
		$html="";
		$mop_id  = '';
		foreach ($query as $q)
		{
			$mop_id.="+mop_".$q['id'];
			$html.='

					<tr>
						<td>
						<input type="text" class="input-sm mop_'.$q['id'].'" disabled id="" value="'.$q['ncash_mopname'].'">
						<input type="text" class="input-sm mop_'.$q['id'].'" hidden disabled id="mop_name" value="'.$q['id'].'">
						</td>
						<td>
						<input type="number" min="0" class="input-sm quantity quantity_'.$q['id'].'  mop_'.$q['id'].' " id="'.$q['id'].'_q" placeholder="0">
						</td>
						<td>
						<input type="tel" onkeyup="cfstotal_noncash_js()" onchange="cfstotal_noncash_js()" class="input-sm cfsncash_d_amount mop_'.$q['id'].'" id="'.$q['id'].'_a" placeholder="0.00" value="0.00">
						</td>
					</tr>

					<script>

						cfstotal_noncash_js();
	
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
						<button type="button" id="btn_reset_noncashform" class="btn btn-primary waves-effect" onclick="reset_cfscashierform_js()">RESET</button>
						<button type="button" id="btn_save_noncashform" class="btn btn-warning waves-effect" onclick="submit_cfsncash_js()">SUBMIT</button>
						</td>
						<td>
						<input type="text" class="input-sm" id="total_noncashtxt" disabled="" value="TOTAL NONCASH">
						</td>
						<td>
						<input type="text" class="input-sm" disabled id="cfstotal_noncash" placeholder="0.00">
						</td>
					</tr>

					<script>

						$("#load_js").load("'.base_url().'cfsnoncash_js_route");
						$("#cfsdata").val("'.$mop_id.'");

					</script>
					';

			$data['html']=$html;    	   
			echo json_encode($data);

	}

	public function cfsnoncash_js_ctrl()
	{
		$this->load->view('cfs_cashier_side/cfsnoncash_js');
	}

	public function submit_cfsncash_ctrl()
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
			$this->cfscashier_model->insert_cfsncash_model($_POST['cfsbatch_id'],
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
														$_POST['status'],
														$_POST['date']);
			
			echo json_encode($message);
		}
	}

	public function cash_duplicate_ctrl()
	{
		
		$query=$this->cfscashier_model->display_cfsmop_model();
		
		$cash_mop='';
		foreach ($query as $q)
		{
			$cash_mop.='
						<option id="" style="text-align: center;" value="'.$q['mop_name'].'">'.$q['mop_name'].'</option>
						';
		}

		$id                   = $_POST['id'];
		$cash_form_counter = $_POST['cash_form_counter'];



		$html='

			<div id="div'.$id.'"><br>
                <form>
                  <center>
                    <label id="pending_cashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT CASH TYPE&nbsp;</label>
                    <select class="quantity'.($cash_form_counter+14).'" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px;" name="cfs_cashmop'.$id.'" id="cfs_cashmop'.$id.'">
                      '.$cash_mop.'
                    </select>
                  </center>
                </form>

          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="35%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="30%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="35%">
                    <center>AMOUNT
                  </th>
                  </tr>
              </thead>
                <form name="cfscashier_cashform" id="cfscashier_cashform">
                    <tbody id="cfscashier_cashtbody">
                      
                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
                            </td>
                            <td>
                                <input type="number" min="0" android:inputType="number" class="input-sm quantity quantity'.($cash_form_counter).' " id="q_onek'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_onek'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+1).'" id="q_fiveh'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_fiveh'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+2).'" id="q_twoh'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_twoh'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+3).'" id="q_oneh'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_oneh'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+4).'" id="q_fifty'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_fifty'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+5).'" id="q_twenty'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_twenty'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_ten">
                            <td>
                                <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+6).'" id="q_ten'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_ten'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_five">
                            <td>
                                <input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+7).'" id="q_five'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_five'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_one">
                            <td>
                                <input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+8).'" id="q_one'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_one'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_twentyfivecents">
                            <td>
                                <input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+9).'" id="q_twentyfivecents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_twentyfivecents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_tencents">
                            <td>
                                <input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+10).'" id="q_tencents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_tencents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_fivecents">
                            <td>
                                <input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+11).'" id="q_fivecents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_fivecents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr id="trcash_onecents">
                            <td>
                                <input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
                            </td>
                            <td>
                                <input type="number" min="0" class="input-sm quantity quantity'.($cash_form_counter+12).'" id="q_onecents'.$id.'" placeholder="0">
                            </td>
                            <td>
                                <input type="text" class="input-sm d_amount" disabled id="a_onecents'.$id.'" placeholder="0" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                
                            </td>
                            <td>
                                <input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
                            </td>
                            <td>
                                <input type="text" class="input-sm quantity'.($cash_form_counter+13).'" disabled id="total_cash'.$id.'" placeholder="0.00">
                            </td>
                        </tr>

                    </tbody>
                </form>
            </table>
          </div>
          

          <script>


          	  



          	 $("#q_onek'.$id.',#q_fiveh'.$id.',#q_twoh'.$id.',#q_oneh'.$id.',#q_fifty'.$id.',#q_twenty'.$id.',#q_ten'.$id.',#q_five'.$id.',#q_one'.$id.',#q_twentyfivecents'.$id.',#q_tencents'.$id.',#q_fivecents'.$id.',#q_onecents'.$id.'").on("change keyup", function() {
	         
	          var res = $("#q_onek'.$id.'").val() * 1000;
			  var res1 = $("#q_fiveh'.$id.'").val() * 500;
			  var res2 = $("#q_twoh'.$id.'").val() * 200;
			  var res3 = $("#q_oneh'.$id.'").val() * 100;
			  var res4 = $("#q_fifty'.$id.'").val() * 50;
			  var res5 = $("#q_twenty'.$id.'").val() * 20;
			  var res6 = $("#q_ten'.$id.'").val() * 10;
			  var res7 = $("#q_five'.$id.'").val() * 5;
			  var res8 = $("#q_one'.$id.'").val() * 1;
			  var res9 = $("#q_twentyfivecents'.$id.'").val() * 0.25;
			  var res10 = $("#q_tencents'.$id.'").val() * 0.10;
			  var res11 = $("#q_fivecents'.$id.'").val() * 0.05;
			  var res12 = $("#q_onecents'.$id.'").val() * 0.01;
			   
			    var amount = res;
			    var amount1 = res1;
			    var amount2 = res2;
			    var amount3 = res3;
			    var amount4 = res4;
			    var amount5 = res5;
			    var amount6 = res6;
			    var amount7 = res7;
			    var amount8 = res8;
			    var amount9 = res9;
			    var amount10 = res10;
			    var amount11 = res11;
			    var amount12 = res12;

			    var amount13 = parseFloat(amount) + 
			    parseFloat(amount1) + 
			    parseFloat(amount2) + 
			    parseFloat(amount3) + 
			    parseFloat(amount4) + 
			    parseFloat(amount5) + 
			    parseFloat(amount6) + 
			    parseFloat(amount7) + 
			    parseFloat(amount8) + 
			    parseFloat(amount9) + 
			    parseFloat(amount10) + 
			    parseFloat(amount11) + 
			    parseFloat(amount12) ;

			    $("#a_onek'.$id.'").val(amount.toLocaleString());
			    $("#a_fiveh'.$id.'").val(amount1.toLocaleString());
			    $("#a_twoh'.$id.'").val(amount2.toLocaleString());
			    $("#a_oneh'.$id.'").val(amount3.toLocaleString());
			    $("#a_fifty'.$id.'").val(amount4.toLocaleString());
			    $("#a_twenty'.$id.'").val(amount5.toLocaleString());
			    $("#a_ten'.$id.'").val(amount6.toLocaleString());
			    $("#a_five'.$id.'").val(amount7.toLocaleString());
			    $("#a_one'.$id.'").val(amount8.toLocaleString());
			    $("#a_twentyfivecents'.$id.'").val(amount9.toLocaleString());
			    $("#a_tencents'.$id.'").val(amount10.toLocaleString());
			    $("#a_fivecents'.$id.'").val(amount11.toLocaleString());
			    $("#a_onecents'.$id.'").val(amount12.toLocaleString());

			    $("#total_cash'.$id.'").val(amount13.toLocaleString());
	
	        });


	        document.querySelector("#q_onek'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_fiveh'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_twoh'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_oneh'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_fifty'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_twenty'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_ten'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_five'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_one'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_twentyfivecents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_tencents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_fivecents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector("#q_onecents'.$id.'").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });


          </script>
          </div>
				';
		
        
        $data['cash_form_counter_last'] = $cash_form_counter+15; 
		$data['html']=$html;    	   
		echo json_encode($data);
	}

	public function noncash_duplicate_ctrl()
	{

		$query=$this->cfscashier_model->display_cfsncashmop_model();
		$query2=$this->cfscashier_model->display_cfsncashbankname_model();
		
		$noncash_mop='';
		foreach ($query as $q)
		{
			$noncash_mop.='
						<option id="" value="'.$q['ncash_mopname'].'">'.$q['ncash_mopname'].'</option>
						';
		}

		$noncash_bankname='';
		foreach ($query2 as $q2)
		{
			$noncash_bankname.='
							<option id="" value="'.$q2['bank_name'].'">'.$q2['bank_name'].'</option>
							';
		}

		$id = $_POST['id'];
		$noncash_form_counter = $_POST['noncash_form_counter'];

		$html='

		<div id="divnoncash'.$id.'"><br>
            <form>
              <center>
                <label id="cfscashier_ncashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT NON CASH TYPE&nbsp;</label>
                <select class="noncash_class'.($noncash_form_counter).'" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px; text-align: center;" name="cfs_ncashmop'.$id.'" id="cfs_ncashmop'.$id.'">
                  '.$noncash_mop.'
                </select>
              </center>
            </form>

          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="40%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="60%">
                    <center>BANK NAME / CHECK NO. / AMOUNT
                  </th>
                 
                  </tr>
              </thead>

                <form name="cfscashier_ncashform'.$id.'" id="cfscashier_ncashform'.$id.'">
                    <tbody id="cfscashier_ncashtbody">
                      
                      <tr>
                            <td>
                                <input type="text" class="input-sm" id="" disabled="" placeholder="BANK NAME">
                            </td>
                            <td>
                                <center><select class="noncash_class'.($noncash_form_counter+1).'" style="font-size: 20px; margin-top: -1%; font-weight: bold; border: solid 2px; text-align: center; margin-top: 0%;" name="cfs_ncash_bankname'.$id.'" id="cfs_ncash_bankname'.$id.'">
                  					'.$noncash_bankname.'
                                </select></center>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="" disabled="" placeholder="CHEQUE NO.">
                            </td>
                            <td>
                                <input type="text" class="input-sm noncash_class'.($noncash_form_counter+2).' cheq_no" required id="cfs_noncash_cheqno'.$id.'" placeholder="CHEQUE NO.">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="input-sm" id="" disabled="" placeholder="AMOUNT">
                            </td>
                            <td>
                                <input type="text" class="input-sm noncash_class'.($noncash_form_counter+3).' ncashd_amount" required id="cfs_noncash_amount'.$id.'" placeholder="₱ 0.00">
                            </td>
                        </tr>

                    </tbody>
                </form>
            </table>
          </div>
          

          <script>

          	  $(".cheq_no").on("change keyup keypress keydown", function() {
		          var sanitized = $(this).val().replace(/[^0-9]/g, "");
		          $(this).val(sanitized);
		        });

          	 $(".ncashd_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});

          </script>
          </div>
				';
		

		$data['noncash_form_counter_last'] = $noncash_form_counter+4; 
		$data['html']=$html;    	   
		echo json_encode($data);
	}

}
