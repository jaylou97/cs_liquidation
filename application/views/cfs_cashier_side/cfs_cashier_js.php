<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>

  function submit_cfscashiercash_js() {

    Swal.fire({
      title: 'Are you sure you want to submit?',
      text: 'Please check your denomination first before submit',
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
               var cash_form_counter_last = $("#cash_form_counter").val(); 

               var form_entry =0;
               var datas = '';
               for(var a=0;a<parseInt(cash_form_counter_last);a++)
               {
                  var total = $(".quantity"+a).val(); 

                  if(form_entry == 13)
                  {
                      total =$(".quantity"+a).val().split(',').join('');

                      if(total == '' || total == '0')
                      {
                        Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
                        return;
                      }
                  }
                   datas =datas+"_"+total;

                   form_entry+=1;

                   if(form_entry==15)
                   {
                    datas = datas+'^';
                    form_entry =0;
                   }

               } 
               

               datas = datas.split("^");           

               for(var b=0;b<datas.length-1;b++)
               {
                   // console.log(datas[b]);
                   $.ajax({
                      type:'post',
                      url: '<?php echo base_url(); ?>submit_cfscashiercash_route',
                      data:{'datas':datas[b],
                            'status': 'PENDING',
                            'date': datetime
                            },
                      dataType:'json',
                      success: function(data)
                      {
                         // console.log(data);  
                         if(data=='EXPIRED SESSION')
                          {
                             Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                           
                             setTimeout(function() {
                               window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 2000);
                          }
                          else
                          {
                               Swal.fire('Successfully Submit!', '', 'success')    
                          
                               setTimeout(function() {
                                window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 2000);
                          }
                      }
                    });
                }
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit!', '', 'info')
      }
    })
  }

  function display_cfsothermop_js()
  {
       $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_cfsothermop_route',
          dataType:'json',
          success: function(data)
          { 
            
             // console.log(data.html);                           
             $("#cfs_cashmop").html(data.html);
          }

      })
  }

  function display_forex_currency_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_forex_currency_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#cfs_forex_list").html(data.html);
      
             display_forex_denomination_form_js();
          }

      })
  }

  function display_forex_denomination_form_js()
  {
    var currency = $("#cfs_forex_list").val();
    // console.log(currency);
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_forex_denomination_form_route',
          data:{'currency':currency},
          dataType:'json',
          success: function(data)
          {  
             // console.log(data.html);                           
             $("#cfscashier_forextbody").html(data.html)
          }

      })
  }

  function cfscalculate_breakdown_js() {

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
  }

  function cfsforex_tfccalculation_js()
  {
    var res1 = $('#q_fiveh').val() * 500;
    var res2 = $('#q_twoh').val() * 200;
    var res3 = $('#q_oneh').val() * 100;
    var res4 = $('#q_fifty').val() * 50;
    var res5 = $('#q_twenty').val() * 20;
    var res6 = $('#q_ten').val() * 10;
    var res7 = $('#q_five').val() * 5;
    var res8 = $('#q_two').val() * 2;
    var res9 = $('#q_one').val() * 1;
    /* if (res == Number.POSITIVE_INFINITY || res == Number.NEGATIVE_INFINITY || isNaN(res))
    res = "N/A"; // OR 0*/
    var amount1 = res1;
    var amount2 = res2;
    var amount3 = res3;
    var amount4 = res4;
    var amount5 = res5;
    var amount6 = res6;
    var amount7 = res7;
    var amount8 = res8;
    var amount9 = res9;

    var amount13 = parseFloat(amount1) + 
                   parseFloat(amount2) + 
                   parseFloat(amount3) + 
                   parseFloat(amount4) + 
                   parseFloat(amount5) + 
                   parseFloat(amount6) + 
                   parseFloat(amount7) + 
                   parseFloat(amount8) + 
                   parseFloat(amount9) ;

    $('#tfc_fiveh').val(amount1.toLocaleString());
    $('#tfc_twoh').val(amount2.toLocaleString());
    $('#tfc_oneh').val(amount3.toLocaleString());
    $('#tfc_fifty').val(amount4.toLocaleString());
    $('#tfc_twenty').val(amount5.toLocaleString());
    $('#tfc_ten').val(amount6.toLocaleString());
    $('#tfc_five').val(amount7.toLocaleString());
    $('#tfc_two').val(amount8.toLocaleString());
    $('#tfc_one').val(amount9.toLocaleString());

    //   ====================TOTAL=====================================
    $('#total_forex_fc').val(amount13.toLocaleString());
  }

  function display_cfsncashmop_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_cfsncashmop_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#cfs_ncashmop").html(data.html);
          }
      })
  }

  function display_cfsncashbankname_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_cfsncashbankname_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#cfs_ncash_bankname").html(data.html);
          }
      })
  }

  function cfstotal_noncash_js()
  {

    var amount_Arr = [];
    document.querySelectorAll(".cfsncash_d_amount").forEach(function(el)
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

     $("#cfstotal_noncash").val(total_amount.toLocaleString());
  
  }

  function reset_cfscashierform_js()
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

          window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route"; 
       
        } else if (result.isDenied) {
          Swal.fire('Cancel reset', '', 'info')
        }
      })
  }

  function submit_cfsncash_js()
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

        var tot = $('#total_noncash').val();
        var tot2 = tot.split(',').join('');
        // console.log(tot);

         if(tot == '' || tot == '0')
         {
          Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
         } 
         else
         {
               
              var data_arr = $("#cfsdata").val().split("+");
              for(var a=1;a<data_arr.length;a++)
              {
               
                var amount_Arr = [];
                document.querySelectorAll("."+data_arr[a]).forEach(function(el)
                {
                  amount_Arr.push(el.value);
                });                     
                
                      $.ajax({

                              type: 'post',
                              url: '<?php echo base_url(); ?>submit_cfsncash_route',
                              data: {
                                     'cfsbatch_id': $('#cfsbatch_id').val(),
                                     'amount_Arr':amount_Arr,
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
                                     window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                                    }, 2000);
                                }
                              }
                            });

              }
               Swal.fire('Successfully Submit!', '', 'success');

                 setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                  }, 2000);
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit', '', 'info')
      }
    })

  }

  function get_cfsbatchid_js()
  {
     $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>get_cfsbatchid_route',
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data);                           
                  $("#cfsbatch_id").val(data.batchid);
                }

            })
  }

  function disabled_cfssaveresetbtn_js()
  {
      $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>disabled_cfssaveresetbtn_route',
                dataType: 'json',
                success: function(data) 
                {
                   // console.log(data);
                 if(data == 'PENDING') 
                 {

                      /*======================notification message=======================*/
                     Swal.fire('NOTE!', 'You cannot save multiple cash domination, please confirm first your pending cash domination to your liquidation officer before you input another cash domination. THANK YOU AND GODBLESS🙂', 'info');

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
                     document.getElementById("cfs_cashmop").disabled = true;

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
                     document.getElementById("cfs_cashmop").disabled = false;

                 }

                }
              });

  }

  function disabled_cfsnoncashform()
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

  var counter = 0;
  function cash_duplicate_js()
  {

    var div_id = counter++;
    // console.log(div_id);
    var cash_form_counter = $("#cash_form_counter").val(); 

    var current_val = $("#cfscash_counter").val(); 
    $("#cfscash_counter").val(current_val+"_div"+div_id); 

    $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>cash_duplicate_route',
                data: {
                       'id': div_id,
                       'cash_form_counter':cash_form_counter
                      },
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data.html);                           
                  $(".cfscash_add").append(data.html);
                  $("#cash_form_counter").val(data.cash_form_counter_last);
                }

            })
  }

  var noncash_counter = 0;
  function noncash_duplicate()
  {

    var div_id = noncash_counter++;
    // console.log(div_id);
    var noncash_form_counter = $("#noncash_form_counter").val(); 

    var current_val = $("#counter").val(); 
    $("#counter").val(current_val+"_divnoncash"+div_id); 

    $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>noncash_duplicate_route',
                data: {
                       'id': div_id,
                       'noncash_form_counter':noncash_form_counter
                      },
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data.html);                           
                  $(".cfsnoncash_add").append(data.html);
                  $("#noncash_form_counter").val(data.noncash_form_counter_last);
                }

            })
  }

  function submit_cfsnoncashden_js()
  {
    Swal.fire({
      title: 'Are you sure you want to submit?',
      text: 'Please check your denomination first before submit',
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

        var cheq = $('.cheq_no').val();
        var amount = $('.ncashd_amount').val();
          // console.log(tot);

         if(cheq == '' || cheq == '0' || amount == '' || amount == 0.00)
         {
           Swal.fire('Missing Data', 'Cheque No. and Amount must not be empty or 0!', 'error')
         } 
         else
         {
               var noncash_form_counter_last = $("#noncash_form_counter").val(); 

               var form_entry =0;
               var datas = '';
               for(var a=0;a<parseInt(noncash_form_counter_last);a++)
               {
                  var amount = $(".noncash_class"+a).val(); 

                  if(form_entry == 3)
                  {
                      amount =$(".noncash_class"+a).val().split(',').join('');
                      
                      if(amount == '' || amount == 0.00)
                      {
                        Swal.fire('Missing Data', 'Amount must not be empty or 0!', 'error')
                        return;
                      }
                  }
                  else if(form_entry == 2)
                  {
                      if(amount == '' || amount == '0')
                        {
                          Swal.fire('Missing Data', 'Cheque No. must not be empty or 0!', 'error')
                          return;
                        }
                  }

                   datas =datas+"_"+amount;

                   form_entry+=1;

                   if(form_entry==4)
                   {
                    datas = datas+'^';
                    form_entry =0;
                   }

               } 
               

               datas = datas.split("^");           

               for(var b=0;b<datas.length-1;b++)
               {
                  // console.log('ni sulod ani');
                   $.ajax({
                      type:'post',
                      url: '<?php echo base_url(); ?>submit_cfscashiernoncash_route',
                      data:{'datas':datas[b],
                            'status': 'PENDING',
                            'date': datetime
                            },
                      dataType:'json',
                      success: function(data)
                      {
                         // console.log(data);  
                         if(data=='EXPIRED SESSION')
                          {
                             Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                           
                             setTimeout(function() {
                               window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 2000);
                          }
                          else
                          {
                               Swal.fire('Successfully Submit!', '', 'success')    
                          
                               setTimeout(function() {
                                window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 2000);
                          }
                      }
                    });
                }
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit!', '', 'info')
      }
    })

  }

</script>