<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>
    
function liqcalculate_breakdown_js() {

  var res = $('#q_onekm').text() * 1000;
  var res1 = $('#q_fivehm').text() * 500;
  var res2 = $('#q_twohm').text() * 200;
  var res3 = $('#q_onehm').text() * 100;
  var res4 = $('#q_fiftym').text() * 50;
  var res5 = $('#q_twentym').text() * 20;
  var res6 = $('#q_tenm').text() * 10;
  var res7 = $('#q_fivem').text() * 5;
  var res8 = $('#q_onem').text() * 1;
  var res9 = $('#q_twentyfivecentsm').text() * 0.25;
  var res10 = $('#q_tencentsm').text() * 0.10;
  var res11 = $('#q_fivecentsm').text() * 0.05;
  var res12 = $('#q_onecentsm').text() * 0.01;
  // console.log(res);
    /* if (res == Number.POSITIVE_INFINITY || res == Number.NEGATIVE_INFINITY || isNaN(res))
    res = "N/A"; // OR 0*/
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

    $('#a_onekm').text(amount.toLocaleString());
    $('#a_fivehm').text(amount1.toLocaleString());
    $('#a_twohm').text(amount2.toLocaleString());
    $('#a_onehm').text(amount3.toLocaleString());
    $('#a_fiftym').text(amount4.toLocaleString());
    $('#a_twentym').text(amount5.toLocaleString());
    $('#a_tenm').text(amount6.toLocaleString());
    $('#a_fivem').text(amount7.toLocaleString());
    $('#a_onem').text(amount8.toLocaleString());
    $('#a_twentyfivecentsm').text(amount9.toLocaleString());
    $('#a_tencentsm').text(amount10.toLocaleString());
    $('#a_fivecentsm').text(amount11.toLocaleString());
    $('#a_onecentsm').text(amount12.toLocaleString());
    
    //   ====================TOTAL=====================================
    $('#total_cashm').text(amount13.toLocaleString());
    // ================================================================


     //   ====================PENDING MODAL=====================================
     var ress = $('#pc_vmodal').text().split(',').join('');
     var ress1 = $('#fc_vmodal').text().split(',').join('');
     var ress2 = $('#tnc_vmodal').text().split(',').join('');
     var ress3 = $('#rs_variancemodal').val().split(',').join('');
     
     var amountt = ress;
     var amountt1 = ress1;
     var amountt2 = ress2;
     var amountt3 = ress3;

     var gt_vmodal = parseFloat(amountt) + parseFloat(amountt1) + parseFloat(amountt2)
     $('#gt_vmodal').text(gt_vmodal.toLocaleString());

     var sop_vmodal = parseFloat(gt_vmodal) - parseFloat(amountt3);
     $('#sop_vmodal').text(sop_vmodal.toLocaleString());

     if(gt_vmodal > amountt3)
     {
       $('#sop_vmodallbl').text('OVER');
     }
     else if(gt_vmodal < amountt3)
     {
       $('#sop_vmodallbl').text('SHORT');
     }
     else
     {
      $('#sop_vmodallbl').text('PERFECT');
     }
     // console.log(ress3);
     // =================================================================================

  }

  function view_pendingdenomination_js()
    {
        $('#divbody_pendingdentable').html('');
        $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>view_pendingdenomination_route',
                dataType: 'json',
                success: function(data) {
                   console.log(data);
                 $('#divbody_pendingdentable').html(data.html);
                 pending_datatable();
                }
              });
    }

  function display_cashierlinkaccess_js()
    {
        $('#divbody_cashierlinkaccesstable').html('');
        $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>display_cashierlinkaccess_route',
                dataType: 'json',
                success: function(data) {
                  // console.log(data);
                 $('#divbody_cashierlinkaccesstable').html(data.html);
                 cashier_linkaccess_datatable();
                }
              });
    }

  function cashier_linkaccess_datatable()
  {
     /*sort datatable*/
      $(document).ready(function() {
        $('#pending_denomination_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2]}
          ],
          "order": [
            [0, "asc"]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function pending_datatable() 
   {

      /*sort datatable*/
      $(document).ready(function() {
        $('#pending_denomination_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2,3,4]}
          ],
          "order": [
            [4, "desc"]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function view_pendingbtn_js(emp_id)
  {
     
     $("#pending_modal").modal("show");
      // console.log("NISUD");
     $('#empid_cashlbl').html('');
     $('#pending_cashlbl').html('');
     $('#pending_modaltitle').html('');
     $('#liq_cashtbody').html('');

     $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>get_pendingdenomination_route',
              data: {'emp_id': emp_id},
              dataType: 'json',
              success: function(data) {
                // console.log(data.html);
                if(data=='EXPIRED SESSION')
                {
                   Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                 
                   setTimeout(function() {
                     window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                    }, 2000);
                }
                else
                {
                  $('#empid_cashlbl').html(data.emp_id);
                  $('#pending_cashlbl').html(data.remit_type);
                  $('#pending_modaltitle').html(data.name);
                  $('#liq_cashtbody').html(data.html); // e pa awahi ang data.html para mo display ang remit type ug name
                }
               
              }
            });
     
     get_pendingnoncashmodal_js(emp_id);
     get_variancemodal_js(emp_id);

  }

  function get_variancemodal_js(emp_id)
  {
     $('#liq_variancetbody').html('');
     $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_variancemodal_route',
          data: {'emp_id': emp_id},
          dataType: 'json',
          success: function(data) {
            $('#liq_variancetbody').html(data.html);
          }
        });
  }

  function get_pendingnoncashmodal_js(emp_id)
  {
    // console.log(emp_id);
     $('#liq_ncashtbody').html('');

     $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_pendingnoncashmodal_route',
          data: {'emp_id': emp_id},
          dataType: 'json',
          success: function(data) {
            // console.log($('#pending_cashlbl').text(),$('#pending_modaltitle').text());
            if($('#pending_cashlbl').text() == '' && $('#pending_modaltitle').text() == '')
            {
                $('#pending_cashlbl').html(data.remit_type);
                $('#pending_modaltitle').html(data.name);
                $('#liq_ncashtbody').html(data.html);
            } 
            else
            {
                $('#liq_ncashtbody').html(data.html);
            }
    
          }
        });
  }

  function confirm_pcpmodal_js(emp_id)
  {
    // console.log(emp_id);
    Swal.fire({
      title: 'Are you sure you want to confirm?',
      icon: 'warning',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {

          $.ajax({

            type: 'post',
            url: '<?php echo base_url(); ?>confirm_pcpmodal_route',
            data: {'emp_id': emp_id},
            dataType: 'json',
            success: function(data) {
             
              if(data=='EXPIRED SESSION')
                {
                   Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                 
                   setTimeout(function() {
                     window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                    }, 2000);
                }
                else
                {
                    Swal.fire('CONFIRMED', '', 'success');

                    refresh_pendingmodal();
                    view_pendingdenomination_js();
                }
            }
          });

      } else if (result.isDenied) {
        Swal.fire('Cancel Confirm', '', 'info')
      }
    })
  }

  function refresh_pendingmodal()
  {

      $('#pending_cashlbl').html('');
      $('#pending_modaltitle').html('');
      $('#liq_cashtbody').html('');

     $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>get_pendingdenomination_route',
              data: {'emp_id': $('#empid_cashlbl').text()},
              dataType: 'json',
              success: function(data) {
              
                $('#pending_cashlbl').html(data.remit_type);
                $('#pending_modaltitle').html(data.name);
                $('#liq_cashtbody').html(data.html); // e pa awahi ang data.html para mo display ang remit type ug name
                
              }
            });

     refresh_getvariancemodal_js();

  }

  function refresh_getvariancemodal_js()
  {
     $('#liq_variancetbody').html('');
     $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_variancemodal_route',
          data: {'emp_id': $('#empid_cashlbl').text()},
          dataType: 'json',
          success: function(data) {
            $('#liq_variancetbody').html(data.html);
          }
        });
  }

 function get_deptamount_js()
 {
   // console.log($("#bunit_code").val(),$("#dept_code").val(),$('#filter_date').val());
  $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_deptamount_route',
        data:{'bunit_code': $('#bunit_code').val(),
              'dept_code': $('#dept_code').val(),
              'filter_date': $('#filter_date').val()
             },
        dataType: 'json',
        success: function(data) {
          // console.log(data.total);
          $('#dept_amount').val(data.total);
          disabled_adjustment_amountfield_js();
        }
      });
 }

 function get_businessunit_js()
 {
   $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_businessunit_route',
        dataType: 'json',
        success: function(data) {
          // console.log(data.bunit);
          $('#tr_no').val('00'+data.trno);
          $('#bunit_list').html(data.bunit_html);
          $('#liq_department').html(data.dept_html);
          get_bunitcode_js();    
        }
      });
 }

 function get_bunitcode_js()
 {
   // console.log($('#bunit_list').val());
  $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_bunitcode_route',
        data:{'bunit_list': $('#bunit_list').val()},
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#bunit_code').val(data.bcode);
          get_department_js();
        }
      });
 }

 function get_department_js()
 {
   // console.log($('#bunit_code').val(),$('#liq_department').val());
  $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_department_route',
        data:{'bunit_code': $('#bunit_code').val(),
              'liq_department': $('#liq_department').val()
             },
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#dept_code').val(data.dcode);
          if($('#dept_code').val() == '')
          {
            Swal.fire('NO ACCESS', 'You dont have access to this department, please check your business unit and department', 'error')
            $('#dept_amount').val('0.00');
            $('#adjustment_amount').val('');
            $('#gt_adjustment').val('');
            disabled_adjustment_amountfield_js();
            return;
          }
          else
          {
            $('#adjustment_amount').val('');
            $('#gt_adjustment').val('');
            get_deptamount_js();
            disabled_adjustment_amountfield_js();
          }

        }
      });
 }

function disabled_adjustment_amountfield_js()
{
    
    if($("#dept_amount").val() == '' || $("#dept_amount").val() == '0.00')
    {
         document.getElementById("adjustment_amount").disabled = true;
    }
    else
    {
        document.getElementById("adjustment_amount").disabled = false;
    }
}

function calculate_gtadjusment_js()
{ 
    var dept_amount = $("#dept_amount").val();
    var dept_amount2 = dept_amount.split(',').join('');

    var adjustment_amount = $("#adjustment_amount").val();

    if(adjustment_amount == '' || adjustment_amount == '.' || adjustment_amount == '-')
    {
        $('#gt_adjustment').val('');
    }
    else
    {
        var gtotal = parseFloat(dept_amount2) + parseFloat(adjustment_amount);
        $('#gt_adjustment').val(gtotal.toLocaleString());
    }
    // console.log(gtotal);
}

function reset_amount_adjustment_js()
{
    Swal.fire({
    title: 'Are you sure you want to reset?',
    icon: 'warning',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {

        window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route"; 
     
      } else if (result.isDenied) {
        Swal.fire('Cancel reset', '', 'info')
      }
    })
}

function submit_amount_adjustment_js()
{
    Swal.fire({
      title: 'Are you sure you want to submit?',
      icon: 'warning',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {

        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + "-" +
        (currentdate.getMonth() + 1) + "-" +
        currentdate.getDate() + " " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes() + ":" +
        currentdate.getSeconds();

        var amount = $('#dept_amount').val();
        var amount2 = amount.split(',').join('');

        var tot = $('#gt_adjustment').val();
        var tot2 = tot.split(',').join('');
        // console.log(amount2);

         if(tot == '' || tot == '0' || tot == $('#dept_amount').val() || $("#adjustment_reason").val() == '')
         {
            Swal.fire('Missing Data', 'Adjustment Amount, Grand Total and Reason must not be empty or 0!', 'error');
         }
         else
         {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>submit_amount_adjustment_route',
            data: {
              'tr_no': $('#tr_no').val(),
              'filter_date': $('#filter_date').val(),
              'bunit_name': $('#bunit_list').val(),
              'dept_name': $('#liq_department').val(),
              'bunit_code': $('#bunit_code').val(),
              'dept_code': $('#dept_code').val(),
              'dept_amount': amount2,
              'adjustment_amount': $('#adjustment_amount').val(),
              'gt_adjustment': tot2,
              'adjustment_reason': $('#adjustment_reason').val(),
              'date_submit': datetime
            },
            dataType: 'json',
            success: function(data) {
              // console.log(data);

              if(data=='EXPIRED SESSION')
              {
                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
               
                 setTimeout(function() {
                   window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                  }, 2000);
              }
              else
              {
                   Swal.fire('Successfully Save!', '', 'success')    
              
                   setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                  }, 2000);
              }

            }
          });
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit', '', 'info')
      }
    })
}

function get_adjusted_data_js()
{
    $('#adjustment_viewing_tbody').html('');
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>get_adjusted_data_route',
            dataType: 'json',
            success: function(data) {
               // console.log(data.html);
             $('#adjustment_viewing_tbody').html(data.html);
             adjustment_datatable();
            }
          });
}

function adjustment_datatable() 
{
  /*sort datatable*/
  $(document).ready(function() {
    $('#adjusted_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1,8,9]}
      ],
      "order": [
        [8, "desc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

</script>