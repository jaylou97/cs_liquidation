<?php

class Cashier_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('pis', TRUE);
    $this->load->database();
  }

  public function save_cashdenomination_model(
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
    $remit_type,
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
      'remit_type'                  => $this->security->xss_clean(trim($remit_type)),
      'status'                      => $this->security->xss_clean(trim($status))/*,
      'date_submit'                 => $this->security->xss_clean($date)*/
    );

    $this->db->set('date_submit', 'NOW()', FALSE);
    $this->db->insert('cs_cashier_cashdenomination', $data);
  }

  public function display_mop_model()
  {

     $query=$this->db->query("select * from cs_cashier_othermop order by id ASC");
   
    return $query->result_array();

  }

  public function search_mopaccess_model($emp_id)
  {

     $query=$this->db->query("select * from cs_cfscashier_mopaccess where emp_id = '".$emp_id."' ");
    // $query=$this->db->query("select a.*, b.* from cs_cashier_mop_access a INNER JOIN cs_cashier_othermop b ON a.mop_id = b.id where a.emp_id = '".$emp_id."' order by b.id ASC ");

    return $query->result_array();

  }

  public function displayhistory_cashform_model($emp_id)
  {

    $query=$this->db->query("select * from cs_cashier_cashdenomination where emp_id = '".$emp_id."' and status = 'PENDING'");

    return $query->result_array();

  }

  public function getpartialhistory_cashform_model($emp_id)
  {

    $query=$this->db->query("select * from cs_cashier_cashdenomination where emp_id = '".$emp_id."' and remit_type = 'PARTIAL' and status = 'CONFIRMED'");

    return $query->result_array();

  }

   public function update_historycashform_model($id,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n)
    {
      $this->db->query(" 

            UPDATE cs_cashier_cashdenomination
            
            SET onek = '".$a."',
                fiveh = '".$b."',
                twoh = '".$c."',
                oneh = '".$d."',
                fifty = '".$e."',
                twenty = '".$f."',
                ten = '".$g."',
                five = '".$h."',
                one = '".$i."',
                twentyfive_cents = '".$j."',
                ten_cents = '".$k."',
                five_cents = '".$l."',
                one_cents = '".$m."',
                total_cash = '".$n."'

            WHERE id = '".$id."'
            
         ");   
    }

  public function disabled_saveresetbtn_model($emp_id)
  {

    $query=$this->db->query("select * from cs_cashier_cashdenomination where emp_id='".$emp_id."' and status = 'PENDING'");

    return $query->result_array();

  }


  public function insert_non_cash_model($b_id,$emp_id,$sal_no,$emp_name,$emp_type,$company_code,$bunit_code,$dep_code,$section_code,$sub_section_code,$amount_Arr,$remit_type,$status,$date)
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
                                              '".$remit_type."',
                                              '".$status."',
                                              NOW()
                                            )

                               "); //'".$date."'
  }

  public function get_batchid($emp_id)
  {
     $query = $this->db->query(" 
                                SELECT 
                                      * 
                                  FROM 
                                      cs_cashier_noncashdenomination    
                                  WHERE 
                                      emp_id='".$emp_id."'
                                      order by id desc limit 1 
                              ");
     return $query->result_array();
  }

  public function get_empdata($emp_id)
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

  public function disabled_noncashform_model($emp_id)
  {

    $query=$this->db->query("select * from cs_cashier_noncashdenomination where emp_id='".$emp_id."' and status = 'PENDING'");

    return $query->result_array();

  }

  public function displayhistory_noncashform_model($emp_id)
  {

    $query=$this->db->query("select cs.*, co.* from cs_cashier_noncashdenomination cs INNER JOIN cs_cashier_othermop co ON cs.mop_id = co.id where cs.emp_id='".$emp_id."' and cs.status = 'PENDING' order by co.id ASC");
     // $query=$this->db->query("select cs.*, co.* FROM cs_cashier_noncashdenomination cs, cs_cashier_othermop co where cs.mop_id = co.id and cs.emp_id='".$emp_id."' and cs.status = 'PENDING' order by co.id ASC");

    return $query->result_array();

  }

  public function update_historynoncashform_model($emp_id,$bid,$mop_arr)
  {

      $hncash_amount = str_replace(",","",$mop_arr[2]);
      $this->db->query(" 

            UPDATE cs_cashier_noncashdenomination
            
            SET noncash_qty = '".$mop_arr[1]."',
                noncash_amount = '".$hncash_amount."'

            WHERE batch_id = '".$bid."' and emp_id = '".$emp_id."' and mop_id = '".$mop_arr[0]."'
            
                                 ");   
  }
  
}
