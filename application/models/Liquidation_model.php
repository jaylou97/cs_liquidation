<?php

class Liquidation_model extends CI_Model
{

 
  public function __construct()
  {
  	parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function view_pendingdenomination_model($officer_acess_arr)
  {
      
     $officer_line_arr = explode("^",$officer_acess_arr);  

      $company_code      = ''; 
      $bunit_code        = ''; 
      $dept_code         = '';
      $section_code      = ''; 
      $sub_section_code  = '';  
     for($a=0;$a<count($officer_line_arr);$a++)//loop sa per line
     {
          $officer_line_per_column_arr = explode("-",$officer_line_arr[$a]);
          for($b=0;$b<count($officer_line_per_column_arr);$b++)
          {
              $company_code      .= "'".@$officer_line_per_column_arr[0]."',"; 
              $bunit_code        .= "'".@$officer_line_per_column_arr[1]."',"; 
              $dept_code         .= "'".@$officer_line_per_column_arr[2]."',";
              $section_code      .= "'".@$officer_line_per_column_arr[3]."',"; 
              $sub_section_code  .= "'".@$officer_line_per_column_arr[4]."',";
          }

     }

     $company_code       = substr($company_code ,0,-1); 
     $bunit_code         = substr($bunit_code,0,-1 );
     $dept_code          = substr($dept_code,0,-1 );
     $section_code       = substr($section_code,0,-1 ); 
     $sub_section_code   = substr($sub_section_code,0,-1 );

     $query=$this->db->query("

                                  SELECT
                                              cash.id,cash.emp_id,cash.emp_name,cash.status,cash.remit_type,cash.date_submit,locDept.dept_name

                                  FROM 
                                              cs_cashier_cashdenomination as cash
                                  INNER JOIN
                                              pis.locate_department AS locDept  on locDept.dcode = concat(cash.company_code,cash.bunit_code,cash.dep_code)

                                  WHERE
                                              cash.status in ('PENDING','CONFIRMED') and cash.company_code in ( ".$company_code.") and cash.bunit_code in  (".$bunit_code.") and cash.dep_code in   (".$dept_code.") and cash.section_code in (".$section_code.") and cash.sub_section_code in  (".$sub_section_code.")            

                                  UNION

                                  SELECT    
                                             nonc.batch_id,nonc.emp_id,nonc.emp_name,nonc.status,nonc.remit_type,nonc.date_submit,loc_Dept.dept_name
                                  
                                  FROM   
                                             cs_cashier_noncashdenomination as nonc
                                  INNER JOIN
                                             pis.locate_department AS loc_Dept   on loc_Dept.dcode = concat(nonc.company_code,nonc.bunit_code,nonc.dep_code)

                                  WHERE
                                             nonc.status = 'PENDING' and nonc.company_code in  (".$company_code.") and nonc.bunit_code in  (".$bunit_code.") and nonc.dep_code in (".$dept_code.") and nonc.section_code in (".$section_code.") and nonc.sub_section_code in (".$sub_section_code.") 
                            ");
                            
     return $query->result_array();

  }

  public function get_pisdata($emp_id)
  {

  	$query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   employee3
                              WHERE emp_id = '".$emp_id."'
                            ");

     return $query->result_array();
  }

  public function get_pisdepartment($dcode)
  {

    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_department
                              WHERE dcode = '".$dcode."'
                            ");

     return $query->result_array();
  }

  public function get_businessunit_model($bcode)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_business_unit
                              WHERE bcode = '".$bcode."'
                            ");

     return $query->result_array();
  }

  public function get_deptcode_model($bcode,$deptname)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_department
                              WHERE concat(company_code,bunit_code) = '".$bcode."' and dept_name = '".$deptname."'
                            ");

     return $query->result_array();
  }

  public function get_deptamount_model($dcode,$date)
  {
    $query=$this->db->query("
                            SELECT 
                                    sum(total_denomination) as total
                              FROM 
                                    cebo_cs_denomination
                              WHERE concat(company_code,bunit_code,dept_code) = '".$dcode."' and date_shrt = '".$date."'
                            ");

     return $query->result_array();
  }

  public function get_bunitcode_model($bname)
  {
    $query=$this->db2->query("
                            SELECT 
                                    * 
                              FROM 
                                   locate_business_unit
                              WHERE business_unit = '".$bname."'
                            ");

     return $query->result_array();
  }

  public function get_pendingdenomination_model($emp_id)
  {
  	 $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_cashier_cashdenomination
                              WHERE emp_id = '".$emp_id."' and status in ('PENDING','CONFIRMED')
                            ");
  	 return $query->result_array();
  }

  public function confirm_pcpmodal_model($emp_id)
  {
       $this->db->query(" 

            UPDATE cs_cashier_cashdenomination
            
            SET status = 'CONFIRMED'

            WHERE emp_id = '".$emp_id."' and status = 'PENDING'
            
         ");   
  }

  public function getfinalcash_pmodal_model($emp_id)
  {

    $query=$this->db->query("select * from cs_cashier_cashdenomination where emp_id = '".$emp_id."' and remit_type = 'FINAL' and status = 'PENDING'");

    return $query->result_array();

  }

  public function getnoncash_pmodal_model($emp_id)
  {

    $query=$this->db->query("select * from cs_cashier_noncashdenomination where emp_id = '".$emp_id."' and status = 'PENDING'");

    return $query->result_array();

  }

  public function get_deptaccess($emp_id)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cebo_cs_dept_access
                              WHERE emp_id = '".$emp_id."'
                            ");

     return $query->result_array();
  }

  public function get_pisdepartment_access_model($emp_id)
  {
   
    $query=$this->db->query("select a.*, b.* from cebo_cs_dept_access a INNER JOIN pis.locate_department b ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code where a.emp_id = '".$emp_id."' group by b.dept_name order by b.dept_name ASC ");

     return $query->result_array();
  }

  public function get_pisbunit_access_model($emp_id)
  {
    $query=$this->db->query("select a.*, b.* from cebo_cs_dept_access a INNER JOIN pis.locate_business_unit b ON a.company_code = b.company_code and a.bunit_code = b.bunit_code where a.emp_id = '".$emp_id."' group by b.business_unit order by b.business_unit ASC ");

     return $query->result_array();
  }

  public function get_pisdata_model($emp_id)
  {

    $query=$this->db->query("select a.*, b.* from cebo_cs_dept_access a INNER JOIN pis.employee3 b ON a.company_code = b.company_code and a.bunit_code = b.bunit_code and a.dept_code = b.dept_code and a.section_code = b.section_code and a.sub_section_code = b.sub_section_code where a.emp_id = '".$emp_id."' order by b.name ASC ");

    return $query->result_array();
  }

  public function get_adjustment_trno_model()
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_liq_adjustment
                              ORDER BY id DESC
                              LIMIT 1
                            ");

     return $query->result_array();
  }

  public function submit_amount_adjustment_model(
                                                $emp_id,
                                                $tr_no,
                                                $filter_date,
                                                $bunit_name,
                                                $dept_name,
                                                $bunit_code,
                                                $dept_code,
                                                $dept_amount,
                                                $adjustment_amount,
                                                $gt_adjustment,
                                                $adjustment_reason,
                                                $date_submit)
  {
    $data = array(
                  'transaction_no'              => $this->security->xss_clean(trim($tr_no)),
                  'date_filter'                 => $this->security->xss_clean(trim($filter_date)),
                  'bunit_name'                  => $this->security->xss_clean(trim($bunit_name)),
                  'dept_name'                   => $this->security->xss_clean(trim($dept_name)),
                  'company_bunit_code'          => $this->security->xss_clean(trim($bunit_code)),
                  'dept_code'                   => $this->security->xss_clean(trim($dept_code)),
                  'old_amount'                  => $this->security->xss_clean(trim($dept_amount)),
                  'adjust_amount'               => $this->security->xss_clean(trim($adjustment_amount)),
                  'adjustment_gtotal'           => $this->security->xss_clean(trim($gt_adjustment)),
                  'adjustment_reason'           => $this->security->xss_clean(trim($adjustment_reason)),
                  'liq_officer_incharge'        => $this->security->xss_clean(trim($emp_id))/*,
                  'date_submit'                 => $this->security->xss_clean(trim($date_submit))*/
                 );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_liq_adjustment', $data);
  }

  public function get_adjusted_data_model($emp_id)
  {
    $query=$this->db->query("
                            SELECT 
                                    * 
                              FROM 
                                   cs_liq_adjustment
                              WHERE liq_officer_incharge = '".$emp_id."'
                            ");

     return $query->result_array();
  }
  
}
