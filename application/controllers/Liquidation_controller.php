<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Liquidation_controller extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		// $this->load->library('nativesession');
		$this->load->model("main_model");
        $this->load->model("cashier_model");
		$this->load->model("liquidation_model");
		$this->load->helper('text');
	}

	public function liq_domination_ctrl()
	{
		//array(2) { ["username"]=> string(10) "03827-2017" ["emp_id"]=> string(10) "03827-2017" }
		// $this->session->userdata(= $this-)nativesession->get('user', 'id');
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
         
            $this->load->view('liquidation_side/liq_dominationform', $data);
            $this->load->view('liquidation_side/liq_pendingmodal');
        }

	}

    public function cashier_linkaccess_ctrl()
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
         
            $this->load->view('liquidation_side/addcashier_linkaccess', $data);
        }
    }

    public function liq_adjustment_ctrl()
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
         
            $this->load->view('liquidation_side/liq_adjustment_form', $data);
        }
    }

	public function view_pendingdenomination_ctrl()
	{

        $liq_officer_emp_id = $this->session->userdata('emp_id');
        $liq_officer_access = $this->liquidation_model->get_deptaccess($liq_officer_emp_id);

        $officer_acess_arr = ''; 
        foreach($liq_officer_access as $liq)
        {

            $officer_acess_arr .= $liq['company_code']."-".$liq['bunit_code']."-".$liq['dept_code']."-".$liq['section_code']."-".$liq['sub_section_code']."^";
          
        }
        
        $pending=$this->liquidation_model->view_pendingdenomination_model($officer_acess_arr);
     
         $html='
                <form id="pending_denominationform">
                    <table class="table table-bordered table-hover table-condensed display" id="pending_denomination_table">
                        <thead>
                            <tr>                                                            
                            <th>
                            <center>CASHIER NAME</center>
                            </th>
                            <th>
                            <center>DEPARTMENT</center>
                            </th>
                            <th>
                            <center>REMIT TYPE</center>
                            </th> 
                            <th>
                            <center>STATUS</center>
                            </th>  
                            <th>
                            <center>DATE/TIME SUBMIT</center>
                            </th>
                            <th>
                            <center>ACTION</center>
                            </th>                            
                            </tr>
                        </thead>
                ';
      
/*========================================================IMPORTANT CODE BY SIR RIAN==============================================================*/
        $cashier_details = array();
        $emp_id          = array();            
        foreach($pending as $p)
        {
                array_push($cashier_details,$p['emp_id'],$p['emp_name'],$p['dept_name'],$p['remit_type'],$p['status'],$p['date_submit']);
                if(!in_array($p['emp_id'],$emp_id))
                {
                    array_push($emp_id,$p['emp_id']);        
                }
                
        }

        for($a=0;$a<count($emp_id);$a++)
        {             
            $status          = '';
            $emp_name        = '';
            $dept_name       = '';
            $remit_type      = '';
            $date_submit     = '';
            $emp_id2         = '';   

            for($b=0;$b<count($cashier_details);$b+=6)
            {
                if($cashier_details[$b] == $emp_id[$a])
                {
                     if($status == '')
                     {
                        $status = $cashier_details[$b+4];   
                     }     

                     if($cashier_details[$b+4] == "PENDING")
                     {
                        $status = 'PENDING';                       
                     }
                     else
                     if($status == 'CONFIRMED' && $cashier_details[$b+4] == "PENDING")   
                     {
                            $status = 'PENDING';
                     }
                     else 
                     {
                        $status  = $cashier_details[$b+4];
                     }

                      $emp_id2      = $cashier_details[$b+0];
                      $emp_name     = $cashier_details[$b+1];
                      $dept_name    = $cashier_details[$b+2];
                      $remit_type   = $cashier_details[$b+3];
                      $date_submit  = $cashier_details[$b+5];   

                }          
            }

             $html=$html.' 
                        <tr style="word-wrap:break-word;">
                          <td>'.$emp_name.'</td>
                          <td>'.$dept_name.'</td>
                          <td>'.$remit_type.'</td>
                          <td>'.$status.'</td>
                          <td>'.$date_submit.'</td>
                          <td>
                            <a id="view_pendingbtn" onclick="view_pendingbtn_js('."'".$emp_id2."'".')"><i style="font-style: normal; font-size: large;">👁️</i></a>
                          </td>
                        </tr>
                      ';   
        }
/*================================================================END OF SIR RIAN CODE===================================================================*/
        
        // var_dump($ncashpending);
       /* foreach($pending as $p)
        {           
          
          $dcode = $p['company_code'].$p['bunit_code'].$p['dep_code'];
          $pis_department=$this->liquidation_model->get_pisdepartment($dcode);
          foreach($pis_department as $dept)
          {
            $department = $dept['dept_name'];
          }
          
          $html=$html.' 
                        <tr style="word-wrap:break-word;">
                          <td>'.$p['emp_name'].'</td>
                          <td>'.$department.'</td>
                          <td>'.$p['remit_type'].'</td>
                          <td>'.$p['status'].'</td>
                          <td>'.$p['date_submit'].'</td>
                          <td>
                            <a id="view_pendingbtn" onclick="view_pendingbtn_js('.$p['id'].')"><i style="font-style: normal; font-size: large;">👁️</i></a>
                          </td>
                        </tr>
                      ';                    
             
        }*/

         $html=$html.'      
                                                      
                         </table>
                        </form> 
                     ';

         $data['html']=$html;         
         echo json_encode($data);
        
	}

	public function get_pendingdenomination_ctrl()
	{

        if(empty($this->session->userdata('emp_id')))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $get=$this->liquidation_model->get_pendingdenomination_model($_POST['emp_id']);
            //var_dump($get);

            $html="";
            foreach($get as $g)
            {           
                
                if($g['status']=='CONFIRMED' || $g['status']=='TRANSFERRED')
                {
                     $html.='';
                     $data['emp_id']=$g['emp_id'];
                     $data['remit_type']='CASH FORM';
                     $data['name']=$g['emp_name'].'  -  Denomination Details';
                }
                else
                {
                     $data['emp_id']=$g['emp_id'];
                     $data['remit_type']='CASH FORM  -  '.$g['remit_type'].'  REMITTANCE';
                     $data['name']=$g['emp_name'].'  -  Denomination Details';

                    if($g['remit_type']=='PARTIAL')
                     {
                        $status='hidden';
                        $status2='';
                     }
                     else
                     {
                        $status = '';
                        $status2='hidden';
                     }

                  $html.='  
                            
                        <tr>
                            <td>
                                <label id="d_onekm">₱1,000</label>
                            </td>
                            <td>
                                <label class="quantity" id="q_onekm" value="'.$g['onek'].'">'.$g['onek'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_onekm" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label id="d_fivehm">₱500</label>
                            </td>
                            <td>
                                <label class="quantity1" id="q_fivehm" value="'.$g['fiveh'].'">'.$g['fiveh'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_fivehm" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label id="d_twohm">₱200</label>
                            </td>
                            <td>
                                <label class="quantity2" id="q_twohm" value="'.$g['twoh'].'">'.$g['twoh'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_twohm" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label id="d_onehm">₱100</label>
                            </td>
                            <td>
                                <label class="quantity3" id="q_onehm" value="'.$g['oneh'].'">'.$g['oneh'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_onehm" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label id="d_fiftym">₱50</label>
                            </td>
                            <td>
                                <label class="quantity4" id="q_fiftym" value="'.$g['fifty'].'">'.$g['fifty'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_fiftym" value="0">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label id="d_twentym">₱20</label>
                            </td>
                            <td>
                                <label class="quantity5" id="q_twentym" value="'.$g['twenty'].'">'.$g['twenty'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_twentym" value="0">
                            </td>
                        </tr>

                        <tr '.$status.'>
                            <td>
                                <label id="d_tenm">₱10</label>
                            </td>
                            <td>
                                <label class="quantity6" id="q_tenm" value="'.$g['ten'].'">'.$g['ten'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_tenm" value="0">
                            </td>
                        </tr>

                        <tr '.$status.'>
                            <td>
                                <label id="d_fivem">₱5</label>
                            </td>
                            <td>
                                <label class="quantity7" id="q_fivem" value="'.$g['five'].'">'.$g['five'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_fivem" value="0">
                            </td>
                        </tr>

                        <tr '.$status.'>
                            <td>
                                <label id="d_onem">₱1</label>
                            </td>
                            <td>
                                <label class="quantity8" id="q_onem" value="'.$g['one'].'">'.$g['one'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_onem" value="0">
                            </td>
                        </tr>

                        <tr '.$status.'>
                            <td>
                                <label id="d_twentyfivecentsm">₱0.25</label>
                            </td>
                            <td>
                                <label class="quantity9" id="q_twentyfivecentsm" value="'.$g['twentyfive_cents'].'">'.$g['twentyfive_cents'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_twentyfivecentsm" value="0">
                            </td>
                        </tr>

                        <tr '.$status.'>
                            <td>
                                <label id="d_tencentsm">₱0.10</label>
                            </td>
                            <td>
                                <label class="quantity10" id="q_tencentsm" value="'.$g['ten_cents'].'">'.$g['ten_cents'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_tencentsm" value="0">
                            </td>
                        </tr>

                        <tr '.$status.'>
                            <td>
                                <label id="d_fivecentsm">₱0.05</label>
                            </td>
                            <td>
                                <label class="quantity11" id="q_fivecentsm" value="'.$g['five_cents'].'">'.$g['five_cents'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_fivecentsm" value="0">
                            </td>
                        </tr>

                        <tr '.$status.'>
                            <td>
                                <label id="d_onecentsm">₱0.01</label>
                            </td>
                            <td>
                                <label class="quantity12" id="q_onecentsm" value="'.$g['one_cents'].'">'.$g['one_cents'].'
                            </td>
                            <td>
                                <label class="d_amount" id="a_onecentsm" value="0">
                            </td>
                        </tr>

                        <tr>
                             <td>
                                <a '.$status2.' id="confirm_cpmlink" onclick="confirm_pcpmodal_js('."'".$g['emp_id']."'".')" style="text-decoration: none !important;"><i style="font-style: normal; font-size: xx-large;">👍</i></a>
                            </td>
                            <td>
                                <label id="total_cashtxtm">TOTAL CASH</label>
                            </td>
                            <td>
                                <label class="d_amount" id="total_cashm">
                                <label hidden id="cashpending_idmodal">
                            </td>
                        </tr>

                      ';
                   
                }                   
                 
            }

             $html.='       
                            <script>
                                
                                liqcalculate_breakdown_js();

                            </script>
                         ';

             $data['html']=$html;     
             echo json_encode($data);

        }

	}

    public function get_variancemodal_ctrl()
    { 

        $emp_id = $_POST['emp_id'];
        $query=$this->cashier_model->getpartialhistory_cashform_model($emp_id);
        $query2=$this->liquidation_model->getfinalcash_pmodal_model($emp_id);
        $query3=$this->liquidation_model->getnoncash_pmodal_model($emp_id);

        $html='';
        $partial = 0;
        foreach ($query as $q)
        {
            $partial += $q['total_cash'];
        }

        $final = 0;
        foreach ($query2 as $q2)
        {
            $final = $q2['total_cash'];
        }

        $noncash = 0;
        foreach ($query3 as $q3)
        {
            $noncash += $q3['noncash_amount'];
        }

            $html.='

                    <tr>
                        <td>
                            <label>TOTAL PARTIAL CASH
                        </td>
                        <td>
                            <label id="pc_vmodal" value="'.$partial.'">'.number_format($partial,2).'
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>TOTAL FINAL CASH
                        </td>
                        <td>
                            <label id="fc_vmodal" value="'.$final.'">'.number_format($final,2).'
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>TOTAL NONCASH
                        </td>
                        <td>
                            <label id="tnc_vmodal" value="'.$noncash.'">'.number_format($noncash,2).'
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>GRAND TOTAL
                        </td>
                        <td>
                            <label id="gt_vmodal" value="">
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label>REGISTERED SALES
                        </td>
                        <td>
                            <input onkeyup="liqcalculate_breakdown_js()" style="text-align: center; font-size: 15px;" type="text" class="input-sm rs_vmodal d_amount" id="rs_variancemodal" placeholder="0.00" value="0.00">
                        </td>   
                    </tr>

                    <tr>
                        <td>
                            <label id="sop_vmodallbl">
                        </td>
                        <td>
                            <label id="sop_vmodal" value="">0
                        </td>   
                    </tr>


                    <script>
                            
                        liqcalculate_breakdown_js();

                        document.querySelector(".rs_vmodal").addEventListener("keypress", function (evt) {
                            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                            {
                                evt.preventDefault();
                            }
                            });

                        $(".d_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});

                    </script>

                    ';

         $data['html']=$html;         
         echo json_encode($data);
    }

    public function confirm_pcpmodal_ctrl()
    {

        if(empty($this->session->userdata('emp_id')))
        {
            $message = "EXPIRED SESSION";
            echo json_encode($message);
        }
        else
        {
            $confirm = 'success';
            $emp_id = $_POST['emp_id'];
            $this->liquidation_model->confirm_pcpmodal_model($emp_id);

            echo json_encode($confirm);  
        }
       
    }

    public function get_pendingnoncashmodal_ctrl()
    {
        
        $emp_id = $_POST['emp_id'];
        $query=$this->cashier_model->displayhistory_noncashform_model($emp_id);
         // var_dump($query);
        if(!empty($query))
        {
            $query2=$this->liquidation_model->getnoncash_pmodal_model($emp_id);

            $html="";
            foreach ($query as $q)
            {
                $data['remit_type']='CASH FORM';
                $data['name']=$q['emp_name'].'  -  Denomination Details';

                $html.='

                        <tr>
                            <td>
                                <label id="">'.$q['mop_name'].'
                            </td>
                            <td>
                                <label class="" id="" value="'.$q['noncash_qty'].'">'.$q['noncash_qty'].'
                            </td>
                            <td>
                                <label class="" id="" value="'.$q['noncash_amount'].'">'.number_format($q['noncash_amount'],2).'
                            </td>
                        </tr>

                        ';
            }

            $noncash = 0;
            foreach ($query2 as $q2)
            {
                $noncash += $q2['noncash_amount'];
            }

            $html.='

                    <tr>
                        <td>
                            <label>
                        </td>
                        <td>
                            <label>TOTAL NONCASH
                        </td>
                        <td>
                            <label id="totalnc_pmodal" value="" style="margin-top: 10%;">'.number_format($noncash,2).'
                        </td>
                    </tr>

                     
                    <script>

                         liqcalculate_breakdown_js();

                    </script>

                    ';

            $data['html']=$html;         
            echo json_encode($data);
        }
    }

    public function display_cashierlinkaccess_ctrl()
    {
        $liq_officer_emp_id = $this->session->userdata('emp_id');
       
        $pisdata=$this->liquidation_model->get_pisdata_model($liq_officer_emp_id);
        // var_dump($pisdata);
         $html='
                <form id="cashier_linkaccessform">
                    <table class="table table-bordered table-hover table-condensed display" id="pending_denomination_table">
                        <thead>
                            <tr>                                                            
                            <th>
                            <center>EMPLOYEE NAME</center>
                            </th>
                            <th>
                            <center>DEPARTMENT</center>
                            </th>
                            <th>
                            <center>ACTION</center>
                            </th>                            
                            </tr>
                        </thead>
                ';
         
        foreach($pisdata as $p)
        {           
          
          $dcode = $p['company_code'].$p['bunit_code'].$p['dept_code'];
          $pis_department=$this->liquidation_model->get_pisdepartment($dcode);
          foreach($pis_department as $dept)
          {
            $department = $dept['dept_name'];
          }
          
          $html=$html.' 
                        <tr style="word-wrap:break-word;">
                          <td>'.$p['name'].'</td>
                          <td>'.$department.'</td>
                          <td>
                            <a id="view_pendingbtn" onclick=""><i style="font-style: normal; font-size: large;">👁️</i></a>
                          </td>
                        </tr>
                      ';                    
             
        }

         $html=$html.'      
                                                      
                         </table>
                        </form> 
                     ';

         $data['html']=$html;         
         echo json_encode($data);
    }

    public function get_businessunit_ctrl()
    {
        $liq_emp_id = $this->session->userdata('emp_id');
        
// ================================GET TRANSACTION NO.====================================
        $tr_no = $this->liquidation_model->get_adjustment_trno_model();

        $trno='';
        foreach($tr_no as $no)
        {
            $trno = $no['id'] + 1;
        }
// =======================================================================================

// ================================GET DEPARTMENT ========================================
        $liq_dept_data = $this->liquidation_model->get_pisdepartment_access_model($liq_emp_id);

        $dept_html='';
        foreach($liq_dept_data as $liq_dept)
        {
            $dept_html.='

                    <option id="" style="text-align: center;" value="'.$liq_dept['dept_name'].'">'.$liq_dept['dept_name'].'</option>

                    ';
        }
// ========================================================================================

// =================================GET BUSINESS UNIT=======================================
        $liq_bunit_data = $this->liquidation_model->get_pisbunit_access_model($liq_emp_id);

        $bunit_html='';
        foreach($liq_bunit_data as $liq_bunit)
        {
            $bunit_html.='

                    <option id="" style="text-align: center;" value="'.$liq_bunit['business_unit'].'">'.$liq_bunit['business_unit'].'</option>

                    ';
        }
// =======================================================================================


         $data['dept_html']=$dept_html;         
         $data['bunit_html']=$bunit_html;              
         $data['trno']=$trno;         
         echo json_encode($data);
    }

    public function get_bunitcode_ctrl()
    {
        $bname = $_POST['bunit_list'];
        
        $bunit_code = $this->liquidation_model->get_bunitcode_model($bname);
        $bcode='';
        foreach($bunit_code as $code)
        {
            $bcode = $code['company_code'].$code['bunit_code'];
        }
        // var_dump($bcode);

        $data['bcode']=$bcode;                      
        echo json_encode($data);
    }

    public function get_department_ctrl()
    {
        $bcode = $_POST['bunit_code'];
        $deptname = $_POST['liq_department'];
    
        $dept_code = $this->liquidation_model->get_deptcode_model($bcode,$deptname);
        $dcode='';
        foreach($dept_code as $code)
        {
            $dcode = $code['dept_code'];
        }
        // var_dump($dcode);

        $data['dcode']=$dcode;                      
        echo json_encode($data);
    }

    public function get_deptamount_ctrl()
    {
        $dcode = $_POST['bunit_code'].$_POST['dept_code'];
        $date = $_POST['filter_date'];
        
        $dept_amount = $this->liquidation_model->get_deptamount_model($dcode,$date);
        // var_dump($dept_amount);
        $total = '';
        foreach($dept_amount as $amount)
        {
            $total = number_format($amount['total'], 2);
        }
        
        $data['total']=$total;                      
        echo json_encode($data);
    }

    public function submit_amount_adjustment_ctrl()
    {
        if(empty($this->session->userdata('emp_id')))
        {
            $save = "EXPIRED SESSION";
            echo json_encode($save);
        }
        else
        {

            $emp_id = $this->session->userdata('emp_id');
            $save = "success";
            $this->liquidation_model->submit_amount_adjustment_model(
                $emp_id,
                $_POST['tr_no'],
                $_POST['filter_date'],
                $_POST['bunit_name'],
                $_POST['dept_name'],
                $_POST['bunit_code'],
                $_POST['dept_code'],
                $_POST['dept_amount'],
                $_POST['adjustment_amount'],
                $_POST['gt_adjustment'],
                $_POST['adjustment_reason'],
                $_POST['date_submit']
            );

            echo json_encode($save);
        }
    }

    public function get_adjusted_data_ctrl()
    {
        $emp_id = $this->session->userdata('emp_id');
        $adjusted_data = $this->liquidation_model->get_adjusted_data_model($emp_id);
        // var_dump($adjusted_data);
        $html='';
        foreach($adjusted_data as $data)
        {
            $html.=' 
                        <tr>
                          <td>'.$data['transaction_no'].'</td>
                          <td>'.$data['date_filter'].'</td>
                          <td>'.$data['bunit_name'].'</td>
                          <td>'.$data['dept_name'].'</td>
                          <td>'.number_format($data['old_amount'], 2).'</td>
                          <td>'.number_format($data['adjust_amount'], 2).'</td>
                          <td>'.number_format($data['adjustment_gtotal'], 2).'</td>
                          <td>'.$data['adjustment_reason'].'</td>
                          <td>'.$data['date_submit'].'</td>
                          <td>
                            <a id="" onclick=""><i style="font-style: normal; font-size: x-large;">🖨️</i></a>
                          </td>
                        </tr>
                      ';
        } 
        

        $data['html']=$html;                      
        echo json_encode($data);
    }


}
