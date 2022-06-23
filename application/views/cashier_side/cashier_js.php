<!-- swal alert -->
<!-- <script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>

  function disabled_btnsave()
  {
    var tot_cash = $('#total_cash').val();
    var tot_cash = $('#total_noncash').val();

    if(tot_cash =='')
    {
      document.getElementById("btn_save_cashform").disabled = true;
    }
    else
    {
     document.getElementById("btn_save_cashform").disabled = false;
   }
 }

 function reset_cashform() {

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
    if (result.isConfirmed) {

      document.getElementById('q_onek').value = "";
      document.getElementById('q_fiveh').value = "";
      document.getElementById('q_twoh').value = "";
      document.getElementById('q_oneh').value = "";
      document.getElementById('q_fifty').value = "";
      document.getElementById('q_twenty').value = "";
      document.getElementById('q_ten').value = "";
      document.getElementById('q_five').value = "";
      document.getElementById('q_one').value = "";
      document.getElementById('q_twentyfivecents').value = "";
      document.getElementById('q_tencents').value = "";
      document.getElementById('q_fivecents').value = "";
      document.getElementById('q_onecents').value = "";
      calculate_breakdown_js();
      document.getElementById('total_cash').value = "";

    } else if (result.isDenied) {
      Swal.fire('Cancel reset', '', 'info')
    }
  })
}

function reset_noncashform() {

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

      window.parent.location.href = "<?php echo base_url() ?>cashier_noncashform_route"; 
   
    } else if (result.isDenied) {
      Swal.fire('Cancel reset', '', 'info')
    }
  })
}

function calculate_breakdown_js() {
  var res = $('#q_onek').val() * 1000;
  var res1 = $('#q_fiveh').val() * 500;
  var res2 = $('#q_twoh').val() * 200;
  var res3 = $('#q_oneh').val() * 100;
  var res4 = $('#q_fifty').val() * 50;
  var res5 = $('#q_twenty').val() * 20;
  var res6 = $('#q_ten').val() * 10;
  var res7 = $('#q_five').val() * 5;
  var res8 = $('#q_one').val() * 1;
  var res9 = $('#q_twentyfivecents').val() * 0.25;
  var res10 = $('#q_tencents').val() * 0.10;
  var res11 = $('#q_fivecents').val() * 0.05;
  var res12 = $('#q_onecents').val() * 0.01;
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

    $('#a_onek').val(amount.toLocaleString());
    $('#a_fiveh').val(amount1.toLocaleString());
    $('#a_twoh').val(amount2.toLocaleString());
    $('#a_oneh').val(amount3.toLocaleString());
    $('#a_fifty').val(amount4.toLocaleString());
    $('#a_twenty').val(amount5.toLocaleString());
    $('#a_ten').val(amount6.toLocaleString());
    $('#a_five').val(amount7.toLocaleString());
    $('#a_one').val(amount8.toLocaleString());
    $('#a_twentyfivecents').val(amount9.toLocaleString());
    $('#a_tencents').val(amount10.toLocaleString());
    $('#a_fivecents').val(amount11.toLocaleString());
    $('#a_onecents').val(amount12.toLocaleString());

    //   ====================TOTAL=====================================
    $('#total_cash').val(amount13.toLocaleString());
    $('#historytotal_cash').val(amount13.toLocaleString());

    /*=======================GRAND TOTAL================================*/
    var partial = $('#ch_partial').val();
    var partial2 = partial.split(',').join('');
    var gtotal = parseFloat(amount13) + parseFloat(partial2);
    $('#gtotal_cash').val(gtotal.toLocaleString());

  }

  function save_cash_denomination() {
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

        var tot = $('#total_cash').val();
        var tot2 = tot.split(',').join('');
          // console.log(tot);

          if(tot == '' || tot == '0')
          {
           Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
         } 
         else
         {
          $.ajax({

            type: 'post',
            url: '<?php echo base_url(); ?>save_cashdenomination_route',
            data: {
              'onek': $('#q_onek').val(),
              'fiveh': $('#q_fiveh').val(),
              'twoh': $('#q_twoh').val(),
              'oneh': $('#q_oneh').val(),
              'fifty': $('#q_fifty').val(),
              'twenty': $('#q_twenty').val(),
              'ten': $('#q_ten').val(),
              'five': $('#q_five').val(),
              'one': $('#q_one').val(),
              'twentyfivecents': $('#q_twentyfivecents').val(),
              'tencents': $('#q_tencents').val(),
              'fivecents': $('#q_fivecents').val(),
              'onecents': $('#q_onecents').val(),
              'total_cash': tot2,
              'remit_type': $('#checkbox_cashremit').val(),
              'status': 'PENDING',
              'date': datetime
            },
            dataType: 'json',
            success: function(data) {
              // console.log(data);

              if(data=='EXPIRED SESSION')
              {
                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
               
                 setTimeout(function() {
                   window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                  }, 2000);
              }
              else
              {
                   Swal.fire('Successfully Save!', '', 'success')    
              
                   setTimeout(function() {
                    $('#cash_confirmationmodal').modal('toggle');
                    window.parent.location.href = "<?php echo base_url() ?>cashier_cashform_route";
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

  function update_historycashform_js()
  {
    Swal.fire({
      title: 'Are you sure you want to update?',
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

        var tot = $('#historytotal_cash').val();
        var tot2 = tot.split(',').join('');
        // var id = $('#history_cashform_id').val();
           // console.log(tot2);

          if(tot == '' || tot == '0')
          {
           Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
         } 
         else
         {
          $.ajax({

            type: 'post',
            url: '<?php echo base_url(); ?>update_historycashform_route',
            data: {
              'id': $('#history_cashform_id').val(),
              'onek': $('#q_onek').val(),
              'fiveh': $('#q_fiveh').val(),
              'twoh': $('#q_twoh').val(),
              'oneh': $('#q_oneh').val(),
              'fifty': $('#q_fifty').val(),
              'twenty': $('#q_twenty').val(),
              'ten': $('#q_ten').val(),
              'five': $('#q_five').val(),
              'one': $('#q_one').val(),
              'twentyfivecents': $('#q_twentyfivecents').val(),
              'tencents': $('#q_tencents').val(),
              'fivecents': $('#q_fivecents').val(),
              'onecents': $('#q_onecents').val(),
              'total_cash': tot2 
            },
            dataType: 'json',
            success: function(data) {
              console.log(data);

              if(data=='EXPIRED SESSION')
              {
                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
               
                 setTimeout(function() {
                   window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                  }, 2000);
              }
              else
              {
                 Swal.fire('Successfully Update!', '', 'success');

                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route"; 
                }, 1000);
              }
             
            }
          });
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Update', '', 'info')
      }
    })
  }

 function disabled_editbtn()
  {
      $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>disabled_saveresetbtn_route',
              dataType: 'json',
              success: function(data) 
              {
                 // console.log(data);
               if(data == 'PENDING') 
               {
                   // console.log('naay pending');
                  /*======================disabled button===========================*/
                   document.getElementById("btn_edit_cashform").disabled = false;
               }
               else
               {
                   // console.log('walay pending');
                  /*======================disabled button===========================*/
                   document.getElementById("btn_edit_cashform").disabled = true;
               }

              }
            });
  }

  function displayhistory_cashform_js() 
  {
        
      $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>displayhistory_cashform_route',
              dataType: 'json',
              success: function(data) {
                console.log(data.cashremit_type);
               $('#cashremit_type').html(data.cashremit_type+'&nbsp;&nbsp;REMITTANCE'); // dapat mao ni mauna ug load kaysa data.html para mo display ang remit type sa cash form
               $('#history_cashform_tbody').html(data.html);
              }
            });

  }

  function disabled_cash_quantity_js()
  {
      document.getElementById("q_onek").disabled = true;
      document.getElementById("q_fiveh").disabled = true;
      document.getElementById("q_twoh").disabled = true;
      document.getElementById("q_oneh").disabled = true;
      document.getElementById("q_fifty").disabled = true;
      document.getElementById("q_twenty").disabled = true;
      document.getElementById("q_ten").disabled = true;
      document.getElementById("q_five").disabled = true;
      document.getElementById("q_one").disabled = true;
      document.getElementById("q_twentyfivecents").disabled = true;
      document.getElementById("q_tencents").disabled = true;
      document.getElementById("q_fivecents").disabled = true;
      document.getElementById("q_onecents").disabled = true;
  }

   function enabled_cash_quantity_js()
  {
      document.getElementById("q_onek").disabled = false;
      document.getElementById("q_fiveh").disabled = false;
      document.getElementById("q_twoh").disabled = false;
      document.getElementById("q_oneh").disabled = false;
      document.getElementById("q_fifty").disabled = false;
      document.getElementById("q_twenty").disabled = false;
      document.getElementById("q_ten").disabled = false;
      document.getElementById("q_five").disabled = false;
      document.getElementById("q_one").disabled = false;
      document.getElementById("q_twentyfivecents").disabled = false;
      document.getElementById("q_tencents").disabled = false;
      document.getElementById("q_fivecents").disabled = false;
      document.getElementById("q_onecents").disabled = false;
      document.getElementById("btn_edit_cashform").disabled = true;
      document.getElementById("btn_update_cashform").disabled = false;
      document.getElementById("btn_cancel_cashform").disabled = false;
  }

  function canceledit_cash_denomination()
  {
        window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route"; 
  }

  function total_noncash_js()
  {

    var amount_Arr = [];
    document.querySelectorAll(".d_amount").forEach(function(el)
    {
      amount_Arr.push(el.value);
    });
    //console.log(amount_Arr);

    var total_amount = 0;
    for(var a=0;a<amount_Arr.length;a++)
    {
      var amount = amount_Arr[a].split(",").join("");
      total_amount += parseFloat(amount);
      
    }

     $("#total_noncash").val(total_amount.toLocaleString());
  
  }

  function total_hnoncash_js()
  {

    var amount_Arr = [];
    document.querySelectorAll(".hd_amount").forEach(function(el)
    {
      amount_Arr.push(el.value);
    });
    //console.log(amount_Arr);

    var total_amount = 0;
    for(var a=0;a<amount_Arr.length;a++)
    {
      var amount = amount_Arr[a].split(",").join("");
      total_amount += parseFloat(amount);
    }

     $("#historytotal_noncash").val(total_amount.toLocaleString());

  }

  function display_mop_js() {
    $.post('<?php echo base_url() ?>display_mop_route',
      function(data) {
               // console.log(data.html);
               $('#tbody_mop').html(data.html);

           }, 'json');

}

function save_noncash_denomination() {
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

        var tot = $('#total_noncash').val();
        var tot2 = tot.split(',').join('');
        // console.log(tot);

          if(tot == '' || tot == '0')
          {
           Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
         } 
         else
         {
               
              var data_arr = $("#data").val().split("+");
              for(var a=1;a<data_arr.length;a++)
              {
               
                var amount_Arr = [];
                document.querySelectorAll("."+data_arr[a]).forEach(function(el)
                {
                  amount_Arr.push(el.value);
                });                     
                
                      $.ajax({

                              type: 'post',
                              url: '<?php echo base_url(); ?>save_noncashdenomination_route',
                              data: {
                                     'batch_id': $('#batch_id').val(),
                                     'amount_Arr':amount_Arr,
                                     // 'remit_type': $('#checkbox_noncashremit').val(),
                                     'remit_type': 'FINAL',
                                     'status':'PENDING',
                                     'date':datetime
                                    },
                              dataType: 'json',
                              success: function(data) {
                                 console.log(data);

                                if(data=='EXPIRED SESSION')
                                {
                                   Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                                 
                                   setTimeout(function() {
                                     window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                                    }, 2000);
                                }
                              }
                            });

              }
               Swal.fire('Successfully Submit!', '', 'success');

                 setTimeout(function() {
                    $('#noncash_confirmationmodal').modal('toggle');
                    window.parent.location.href = "<?php echo base_url() ?>cashier_noncashform_route";
                  }, 2000);
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit', '', 'info')
      }
    })
  }

function get_batchid_js()
{
      $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>get_batchid_route',
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data);                           
                  $("#batch_id").val(data.batchid);
                }

            })
}

function disabled_saveresetbtn_js()
{
    $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>disabled_saveresetbtn_route',
              dataType: 'json',
              success: function(data) 
              {
                 // console.log(data);
               if(data == 'PENDING') 
               {
                   // console.log('naay pending');
                   /*===================disabled textbox===========================*/
                   document.getElementById("q_onek").disabled = true;
                   document.getElementById("q_fiveh").disabled = true;
                   document.getElementById("q_twoh").disabled = true;
                   document.getElementById("q_oneh").disabled = true;
                   document.getElementById("q_fifty").disabled = true;
                   document.getElementById("q_twenty").disabled = true;
                   document.getElementById("q_ten").disabled = true;
                   document.getElementById("q_five").disabled = true;
                   document.getElementById("q_one").disabled = true;
                   document.getElementById("q_twentyfivecents").disabled = true;
                   document.getElementById("q_tencents").disabled = true;
                   document.getElementById("q_fivecents").disabled = true;
                   document.getElementById("q_onecents").disabled = true;

                  /*======================disabled button===========================*/
                   document.getElementById("btn_reset_cashform").disabled = true;
                   document.getElementById("btn_save_cashform").disabled = true;
                   document.getElementById("partial_checkbox").disabled = true;
                   document.getElementById("final_checkbox").disabled = true;

                   /*======================notification message=======================*/
                   Swal.fire('NOTE!', 'You cannot save multiple cash domination, please confirm first your pending cash domination to your liquidation officer before you input another cash domination. THANK YOU AND GODBLESS🙂', 'info');
               }
               else
               {
                   // console.log('walay pending');
                   /*===================disabled textbox===========================*/
                   document.getElementById("q_onek").disabled = false;
                   document.getElementById("q_fiveh").disabled = false;
                   document.getElementById("q_twoh").disabled = false;
                   document.getElementById("q_oneh").disabled = false;
                   document.getElementById("q_fifty").disabled = false;
                   document.getElementById("q_twenty").disabled = false;
                   document.getElementById("q_ten").disabled = false;
                   document.getElementById("q_five").disabled = false;
                   document.getElementById("q_one").disabled = false;
                   document.getElementById("q_twentyfivecents").disabled = false;
                   document.getElementById("q_tencents").disabled = false;
                   document.getElementById("q_fivecents").disabled = false;
                   document.getElementById("q_onecents").disabled = false;

                  /*======================disabled button===========================*/
                   document.getElementById("btn_reset_cashform").disabled = false;
                   document.getElementById("btn_save_cashform").disabled = false;

               }

              }
            });

}

function view_cashconfimation_modal()
{

    if ($('#checkbox_cashremit').val() == '') 
    {
      Swal.fire('MISSING DATA', 'Please select partial or final remit before submit', 'error');
    } 
    else if($('#total_cash').val() == '' || $('#total_cash').val() == 0)
    {
      Swal.fire('MISSING DATA', 'Total must not be empty or 0', 'error');
    }
    else if($('#checkbox_cashremit').val() == 'PARTIAL')
    {

        var crt = $('#checkbox_cashremit').val();
        var q1k = $('#q_onek').val();
        var a1k = $('#a_onek').val();
        var q5h = $('#q_fiveh').val();
        var a5h = $('#a_fiveh').val();
        var q2h = $('#q_twoh').val();
        var a2h = $('#a_twoh').val();
        var q1h = $('#q_oneh').val();
        var a1h = $('#a_oneh').val();
        var q5f = $('#q_fifty').val();
        var a5f = $('#a_fifty').val();
        var q20 = $('#q_twenty').val();
        var a20 = $('#a_twenty').val();
        var ctot = $('#total_cash').val();
       
        $('#cash_confirmationmodal').appendTo("body").modal('show');

        $('#cmodalcashremit_type').text(crt+'  REMITTANCE');
        $('#q_onekm').text(q1k);
        $('#a_onekm').text(a1k);
        $('#q_fivehm').text(q5h);
        $('#a_fivehm').text(a5h);
        $('#q_twohm').text(q2h);
        $('#a_twohm').text(a2h);
        $('#q_onehm').text(q1h);
        $('#a_onehm').text(a1h);
        $('#q_fiftym').text(q5f);
        $('#a_fiftym').text(a5f);
        $('#q_twentym').text(q20);
        $('#a_twentym').text(a20);
        $('#total_cashm').text(ctot);
    }
    else
    {
     
        var crt = $('#checkbox_cashremit').val();
        var q1k = $('#q_onek').val();
        var a1k = $('#a_onek').val();
        var q5h = $('#q_fiveh').val();
        var a5h = $('#a_fiveh').val();
        var q2h = $('#q_twoh').val();
        var a2h = $('#a_twoh').val();
        var q1h = $('#q_oneh').val();
        var a1h = $('#a_oneh').val();
        var q5f = $('#q_fifty').val();
        var a5f = $('#a_fifty').val();
        var q20 = $('#q_twenty').val();
        var a20 = $('#a_twenty').val();
        var q10 = $('#q_ten').val();
        var a10 = $('#a_ten').val();
        var q5 = $('#q_five').val();
        var a5 = $('#a_five').val();
        var q1 = $('#q_one').val();
        var a1 = $('#a_one').val();
        var q25c = $('#q_twentyfivecents').val();
        var a25c = $('#a_twentyfivecents').val();
        var q10c = $('#q_tencents').val();
        var a10c = $('#a_tencents').val();
        var q5c = $('#q_fivecents').val();
        var a5c = $('#a_fivecents').val();
        var q1c = $('#q_onecents').val();
        var a1c = $('#a_onecents').val();
        var ctot = $('#total_cash').val();

        $('#cash_confirmationmodal').appendTo("body").modal('show');

        $('#cmodalcashremit_type').text(crt+'  REMITTANCE');
        $('#q_onekm').text(q1k);
        $('#a_onekm').text(a1k);
        $('#q_fivehm').text(q5h);
        $('#a_fivehm').text(a5h);
        $('#q_twohm').text(q2h);
        $('#a_twohm').text(a2h);
        $('#q_onehm').text(q1h);
        $('#a_onehm').text(a1h);
        $('#q_fiftym').text(q5f);
        $('#a_fiftym').text(a5f);
        $('#q_twentym').text(q20);
        $('#a_twentym').text(a20);
        $('#q_tenm').text(q10);
        $('#a_tenm').text(a10);
        $('#q_fivem').text(q5);
        $('#a_fivem').text(a5);
        $('#q_onem').text(q1);
        $('#a_onem').text(a1);
        $('#q_twentyfivecentsm').text(q25c);
        $('#a_twentyfivecentsm').text(a25c);
        $('#q_tencentsm').text(q10c);
        $('#a_tencentsm').text(a10c);
        $('#q_fivecentsm').text(q5c);
        $('#a_fivecentsm').text(a5c);
        $('#q_onecentsm').text(q1c);
        $('#a_onecentsm').text(a1c);
        $('#total_cashm').text(ctot);

        document.getElementById("trmodalcash_onecents").hidden = false;
        document.getElementById("trmodalcash_fivecents").hidden = false;
        document.getElementById("trmodalcash_tencents").hidden = false;
        document.getElementById("trmodalcash_twentyfivecents").hidden = false;
        document.getElementById("trmodalcash_one").hidden = false;
        document.getElementById("trmodalcash_five").hidden = false;
        document.getElementById("trmodalcash_ten").hidden = false;
    }

}

function disabled_noncashform()
{

  $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>disabled_noncashform_route',
              dataType: 'json',
              success: function(data) 
              {
                 // console.log(data);
               if(data == 'PENDING') 
               {
                   // console.log('naay pending');
                  /*======================disabled button===========================*/
                   document.getElementById("btn_reset_noncashform").disabled = true;
                   document.getElementById("btn_save_noncashform").disabled = true;
                   
                   /*======================notification message=======================*/
                   Swal.fire('NOTE!', 'You cannot save multiple noncash domination, please confirm first your pending noncash domination to your liquidation officer before you input another cash domination. THANK YOU AND GODBLESS🙂', 'info');
               }
               else
               {
                   // console.log('walay pending');
                  /*======================enabled button===========================*/
                   document.getElementById("btn_reset_noncashform").disabled = false;
                   document.getElementById("btn_save_noncashform").disabled = false;
               }

              }
            });

}

function view_noncashconfimation_modal()
{

   if ($('#checkbox_noncashremit').val() == '') 
    {
      Swal.fire('MISSING DATA', 'Please select partial or final remit before submit', 'error');
    } 
    else if($('#total_noncash').val() == '' || $('#total_noncash').val() == 0)
    {
      Swal.fire('MISSING DATA', 'Total must not be empty or 0', 'error');
    }
    else
    {

        var nctot = $('#total_noncash').val();
        var data_noncashm = $("#data").val().split("+");

         $("#tbody_noncash_confirmationmodal").html("");

         var amount_Arr = [];
         for(var a=1;a<data_noncashm.length;a++)
          {
              document.querySelectorAll("."+data_noncashm[a]).forEach(function(el)
              {
               amount_Arr.push(el.value);
              // console.log(data_noncashm[a]);
              });        
          }
          
          var qty = [];
          var amt = [];
          for(var b=0;b<amount_Arr.length;b+=4)
          {
            // console.log(amount_Arr[b], amount_Arr[b+2], amount_Arr[b+3]);
             qty.push(amount_Arr[b+2]);
             amt.push(amount_Arr[b+3]); 
          }


          var result='OK';  
          for(var c=0;c<qty.length;c++)
          {
            
            if( (qty[c] == '0' && amt[c] != '0.00') || (qty[c] != '0' && qty[c] != ''   && amt[c] == '0.00' )  || (qty[c] == '' && amt[c] != '0.00')  || (qty[c] != '' && qty[c] == '0'  && amt[c] != '0.00'))  
            {
              result ='ERROR';
            }      

         }

         if(result == 'OK')
         {
            $.ajax({
                      type:'post',
                      url :'<?php echo base_url(); ?>view_noncashmodal_route',
                      data: {
                             'total_noncash': $('#total_noncash').val(),
                             'amount_Arr':amount_Arr
                            },
                      dataType:'json',
                      success: function(data)
                      { 
                        //console.log(data.html);                      
                        $("#tbody_noncash_confirmationmodal").append(data.html);
                        $('#noncash_confirmationmodal').modal('show');
                        $('#total_noncashm_modal').text(nctot);
                      }

                  })
         }
         else 
         {
           Swal.fire('MISSING DATA', 'Please check your quantity and amount', 'error');
         }
    }

}

function checked_partial()
{
    document.getElementById("final_checkbox").checked = false;

    var partial = document.getElementById("partial_checkbox");
      if (partial.checked) 
      {
       $('#checkbox_cashremit').val('PARTIAL');
        document.getElementById("trcash_onecents").hidden = true;
        document.getElementById("trcash_fivecents").hidden = true;
        document.getElementById("trcash_tencents").hidden = true;
        document.getElementById("trcash_twentyfivecents").hidden = true;
        document.getElementById("trcash_one").hidden = true;
        document.getElementById("trcash_five").hidden = true;
        document.getElementById("trcash_ten").hidden = true;
        // $( "#form_body" ).load(window.location.href + " #form_body" ); //reload div

        $('#q_onecents').val(0);
        $('#q_fivecents').val(0);
        $('#q_tencents').val(0);
        $('#q_twentyfivecents').val(0);
        $('#q_one').val(0);
        $('#q_five').val(0);
        $('#q_ten').val(0);

        calculate_breakdown_js();
      }
      else
      {
        $('#checkbox_cashremit').val('');
      }
}

function checked_final()
{
    document.getElementById("partial_checkbox").checked = false;

    var final = document.getElementById("final_checkbox");
      if (final.checked) 
      {
        $('#checkbox_cashremit').val('FINAL');
        document.getElementById("trcash_onecents").hidden = false;
        document.getElementById("trcash_fivecents").hidden = false;
        document.getElementById("trcash_tencents").hidden = false;
        document.getElementById("trcash_twentyfivecents").hidden = false;
        document.getElementById("trcash_one").hidden = false;
        document.getElementById("trcash_five").hidden = false;
        document.getElementById("trcash_ten").hidden = false;
      } 
      else
      {
        $('#checkbox_cashremit').val('');
        document.getElementById("trcash_onecents").hidden = true;
        document.getElementById("trcash_fivecents").hidden = true;
        document.getElementById("trcash_tencents").hidden = true;
        document.getElementById("trcash_twentyfivecents").hidden = true;
        document.getElementById("trcash_one").hidden = true;
        document.getElementById("trcash_five").hidden = true;
        document.getElementById("trcash_ten").hidden = true;
      }
}

function checked_noncashpartial()
{
    document.getElementById("final_noncashcheckbox").checked = false;

    var partial = document.getElementById("partial_noncashcheckbox");
      if (partial.checked) 
      {
       $('#checkbox_noncashremit').val('PARTIAL');
      }
      else
      {
        $('#checkbox_noncashremit').val('');
      }
}

function checked_noncashfinal()
{
    document.getElementById("partial_noncashcheckbox").checked = false;

    var final = document.getElementById("final_noncashcheckbox");
      if (final.checked) 
      {
        $('#checkbox_noncashremit').val('FINAL');
      } 
      else
      {
        $('#checkbox_noncashremit').val('');
      }
}

function disabled_partialcheckbox_js()
{
   $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>disabled_partialcheckbox_route',
              dataType: 'json',
              success: function(data) {
                //console.log(data);

                if(data=='NOT EMPTY')
                {
                  document.getElementById('partial_checkbox').disabled = true;
                  Swal.fire('NOTE!', 'You already submit partial remit, you can select final remit only. THANK YOU AND GODBLESS🙂', 'info');
                }
              }
            });
}

function displayhistory_noncashform_js() 
  {
        
      $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>displayhistory_noncashform_route',
              dataType: 'json',
              success: function(data) {
                //console.log(data.html);
               $('#historytbody_mop').html(data.html);
               $('#noncashremit_type').html(data.noncashremit_type+'&nbsp;&nbsp;REMITTANCE');
               $('#hncash_bid').html(data.hncash_bid);
              }
            });

  }

  function enabled_historynoncash_quantity_js()
  {
    var hncashid = $("#historyncashid").text().split("+");
      // console.log(hncashid);
 
     for(var a=1;a<hncashid.length;a++)
     {
       document.getElementById(hncashid[a]).disabled = false;
       document.getElementById("btn_edit_historyncashform").disabled = true;
       document.getElementById("btn_update_historyncashform").disabled = false;
       document.getElementById("btn_cancel_historyncashform").disabled = false;
     }     

  }

  function canceledit_historynoncash_denomination()
  {
     window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route";
  }

  function update_historynoncashform_js()
  {

      Swal.fire({
        title: 'Are you sure you want to update?',
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

          var tot = $('#historytotal_noncash').val();
          var tot2 = tot.split(',').join('');
          // var id = $('#history_cashform_id').val();
             // console.log(tot2);

          if(tot == '' || tot == '0')
           {
             Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
           } 
           else
           {
              var data_arr = $("#hncash_data").text().split("+");
              // console.log(data_arr);
              for(var a=1;a<data_arr.length;a++)
              {
               
                var amount_Arr = [];
                document.querySelectorAll("."+data_arr[a]).forEach(function(el)
                {
                  amount_Arr.push(el.value);
                });                     
                console.log(amount_Arr);
                  $.ajax({

                          type: 'post',
                          url: '<?php echo base_url(); ?>update_historynoncashform_route',
                          data: {
                                 'batch_id': $('#hncash_bid').text(),
                                 'amount_Arr':amount_Arr
                                },
                          dataType: 'json',
                          success: function(data) {
                             //console.log(data);
                             // Swal.fire('Successfully Update!', '', 'success');
                             if(data=='EXPIRED SESSION')
                              {
                                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                               
                                 setTimeout(function() {
                                   window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                                  }, 2000);
                              }
                          }
                        });

              }
                  Swal.fire('Successfully Update!', '', 'success');

                 setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route";
                  }, 1000);
          }

        } else if (result.isDenied) {
          Swal.fire('Cancel Update', '', 'info')
        }
      })
  }

  function disabled_scharacter_js()
  {

                // Catch all events related to changes
                $('.cash_quantity').on('change keyup top press', function() {
                  // Remove invalid characters
                  var sanitized = $(this).val().replace(/[^0-9]/g, '');
                 // Update value
                  $(this).val(sanitized);
                  calculate_breakdown_js();
                });


    /*=============================================Disabled (-+e)================================================================*/
                                document.querySelector(".quantity").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity1").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity2").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity3").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity4").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity5").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity6").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity7").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity8").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity9").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity10").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity11").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity12").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });
        /*============================================================================================================================*/

  }

  function view_hpartialdetails_js()
  {
     $('#hpartialdetails_modal').modal('show');
    
    $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>display_hpartialdetails_route',
              dataType: 'json',
              success: function(data) {
                console.log(data.html);
               $('#hpartialdetails_bodymodal').html(data.html);
              }
            });
  }

</script>