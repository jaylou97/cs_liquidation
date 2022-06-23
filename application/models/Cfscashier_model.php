<?php

class Cfscashier_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

  public function display_cfsmop_model() 
  {

     $query=$this->db->query("select * from cs_cfsothermop where mop_name <> '' order by mop_name ASC");
   
     return $query->result_array();

  }

  public function display_forex_currency_model()
  {
    $query=$this->db->query("select * from cs_cfsothermop where forex_currency <> '' order by forex_currency ASC");
   
     return $query->result_array();
  }

  public function get_forex_symbol_model($currency)
  {
    $query=$this->db->query("select * from cs_cfsothermop where forex_currency = '".$currency."' ");
   
     return $query->result_array();
  }

  public function display_cfsncashmop_model()
  {
    $query=$this->db->query("select * from cs_cfsothermop where ncash_mopname <> '' order by ncash_mopname ASC");
   
     return $query->result_array();
  }

  public function display_cfsncashbankname_model()
  {
     $query=$this->db->query("select * from cs_cfsothermop where bank_name <> '' order by bank_name ASC");
   
     return $query->result_array();
  }

  public function save_cfscashdenomination_model(
    $emp_id,
    $sal_no,
    $emp_name,
    $emp_type,
    $company_code,
    $bunit_code,
    $dep_code,
    $section_code,
    $sub_section_code,
    $onek,
    $fiveh,
    $twoh,
    $oneh,
    $fifty,
    $twenty,
    $ten,
    $five,
    $one,
    $twentyfivecents,
    $tencents,
    $fivecents,
    $onecents,
    $total_cash,
    $cfscash_type,
    $status,
    $date
  ) {

    $data = array(
      'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
      'sal_no'                      => $this->security->xss_clean(trim($sal_no)),
      'emp_name'                    => $this->security->xss_clean(trim($emp_name)),
      'emp_type'                    => $this->security->xss_clean(trim($emp_type)),
      'company_code'                => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                  => $this->security->xss_clean(trim($bunit_code)),
      'dep_code'                    => $this->security->xss_clean(trim($dep_code)),
      'section_code'                => $this->security->xss_clean(trim($section_code)),
      'sub_section_code'            => $this->security->xss_clean(trim($sub_section_code)),
      'onek'                        => $this->security->xss_clean(trim($onek)),
      'fiveh'                       => $this->security->xss_clean(trim($fiveh)),
      'twoh'                        => $this->security->xss_clean(trim($twoh)),
      'oneh'                        => $this->security->xss_clean(trim($oneh)),
      'fifty'                       => $this->security->xss_clean(trim($fifty)),
      'twenty'                      => $this->security->xss_clean(trim($twenty)),
      'ten'                         => $this->security->xss_clean(trim($ten)),
      'five'                        => $this->security->xss_clean(trim($five)),
      'one'                         => $this->security->xss_clean(trim($one)),
      'twentyfive_cents'            => $this->security->xss_clean(trim($twentyfivecents)),
      'ten_cents'                   => $this->security->xss_clean(trim($tencents)),
      'five_cents'                  => $this->security->xss_clean(trim($fivecents)),
      'one_cents'                   => $this->security->xss_clean(trim($onecents)),
      'total_cash'                  => $this->security->xss_clean(trim($total_cash)),
      'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
      'cfs_cashtype'                => $this->security->xss_clean(trim($cfscash_type)),
      'status'                      => $this->security->xss_clean(trim($status))/*,
      'date_submit'                 => $this->security->xss_clean($date)*/
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_cashdenomination', $data);

  }

  public function save_cfsnoncashdenomination_model(
    $emp_id,
    $sal_no,
    $emp_name,
    $emp_type,
    $company_code,
    $bunit_code,
    $dep_code,
    $section_code,
    $sub_section_code,
    $type,
    $bank_name,
    $cheq_no,
    $amount,
    $status,
    $date
  ) {

    $data = array(
      'emp_id'                      => $this->security->xss_clean(trim($emp_id)),
      'sal_no'                      => $this->security->xss_clean(trim($sal_no)),
      'emp_name'                    => $this->security->xss_clean(trim($emp_name)),
      'emp_type'                    => $this->security->xss_clean(trim($emp_type)),
      'company_code'                => $this->security->xss_clean(trim($company_code)),
      'bunit_code'                  => $this->security->xss_clean(trim($bunit_code)),
      'dep_code'                    => $this->security->xss_clean(trim($dep_code)),
      'section_code'                => $this->security->xss_clean(trim($section_code)),
      'sub_section_code'            => $this->security->xss_clean(trim($sub_section_code)),
      'cfs_noncashtype'             => $this->security->xss_clean(trim($type)),
      'cfs_bankname'                => $this->security->xss_clean(trim($bank_name)),
      'cfs_cheqno'                  => $this->security->xss_clean(trim($cheq_no)),
      'cfs_amount'                  => $this->security->xss_clean(trim($amount)),
      'remit_type'                  => $this->security->xss_clean(trim('FINAL')),
      'status'                      => $this->security->xss_clean(trim($status))/*,
      'date_submit'                 => $this->security->xss_clean($date)*/
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_noncashdenomination', $data);

  }

  public function insert_cfsncash_model($b_id,$emp_id,$sal_no,$emp_name,$emp_type,$company_code,$bunit_code,$dep_code,$section_code,$sub_section_code,$amount_Arr,$status,$date)
  {

    $noncash_amount = str_replace(",","",$amount_Arr[3]);
     $query = $this->db->query("
                                  INSERT INTO
                                              cs_cashier_noncashdenomination
                                            (
                                              id,
                                              batch_id,
                                              emp_id,
                                              sal_no,
                                              emp_name,
                                              emp_type,
                                              company_code,
                                              bunit_code,
                                              dep_code,
                                              section_code,
                                              sub_section_code,
                                              mop_id,
                                              noncash_qty,
                                              noncash_amount,
                                              remit_type,
                                              status,
                                              date_submit
                                            )  
                                    values
                                            (
                                              null,
                                              '".$b_id."',
                                              '".$emp_id."',
                                              '".$sal_no."',
                                              '".$emp_name."',
                                              '".$emp_type."',
                                              '".$company_code."',
                                              '".$bunit_code."',
                                              '".$dep_code."',
                                              '".$section_code."',
                                              '".$sub_section_code."',
                                              '".$amount_Arr[1]."',
                                              '".$amount_Arr[2]."',
                                              '".$noncash_amount."',
                                              'FINAL',
                                              '".$status."',
                                              NOW()
                                            )

                               "); //'".$date."'

  }

}
