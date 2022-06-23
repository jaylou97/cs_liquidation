


  <!-- BEGIN PAGE LEVEL STYLES -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/select2/select2.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
  <!-- END PAGE LEVEL STYLES -->



<style type="text/css">
  
  table.dataTable td.dataTables_empty 
  {
    text-align: center;    
  }

  table.display tbody tr:nth-child(even):hover td
  {
    color: black !important;
    background-color: #ff5722 !important;
  }

  table.display tbody tr:nth-child(even):hover td
  {
    color: black !important;
    background-color: #ff5722 !important;
  }

  table.display tbody tr:nth-child(odd):hover td 
  {
    color: black !important;
    background-color: #ff5722 !important;
  }

  td {
        text-align: center;
    }

    label{
        font-size: 15px;
        display: block;
    }

/*=========================PENDING MODAL STYLE==================================*/
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    /*height: 80vh;*/
    overflow-y: auto;
}
/*=============================END==============================================*/

  input
  {
      display: block;
  }

  input[type="checkbox"]
  {
    margin-top: -1px;
    zoom: 1.9;
  }

  .swal2-container
  {
      z-index: 300000!important;
  }
  
</style>

<!-- modal -->
<div class="modal" tabindex="-1" id="pending_modal" style="margin-left: -53%;">
  <div class="modal-dialog">
    <div class="modal-content" id="pending_modalcontent" style="width: 220%;">
      <div class="modal-header">
        <center><h5 class="modal-title" id="pending_modaltitle" style="font-weight: bold; font-size: 15px;">Cashier Denomination Details</h5></center>
      </div>

      <div class="modal-body row" id="pending_modalbody" style="height: 500px;">

        <!-- ===========================================CASH DENOMINATION FORM========================================= -->
          <div class="column">

            <form>
              <center><label id="pending_cashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">CASH FORM</label></center>
              <center><label hidden id="empid_cashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;"></label></center>
            </form>

          <div class="table-scrollable" id="liq_cashdendiv">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="35%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="25%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="40%">
                    <center>AMOUNT
                  </th>

                  </tr>
              </thead>
                <form name="liq_cashdenform" id="liq_cashdenform">
                    <tbody id="liq_cashtbody">
                      
                    </tbody>
                </form>
            </table>
          </div>
          </div>                                    
        <!-- ===========================================END CASH DENOMINATION FORM====================================</FORM> -->

         <!-- ===========================================NONCASH DENOMINATION FORM========================================= -->
          <div class="column">

            <form>
              <center><label id="pending_ncashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">NONCASH FORM</label></center>
            </form>

          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="50%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="30%">
                    <center>AMOUNT
                  </th>
          
                  </tr>
              </thead>
                <form name="liq_ncashdenform" id="liq_ncashdenform">
                    <tbody id="liq_ncashtbody">
                      
                    </tbody>
                </form>
            </table>
          </div>
          </div>                               
        <!-- ===========================================END NONCASH DENOMINATION FORM====================================</FORM> -->

        <!-- ===========================================VARIANCE FORM========================================= -->
          <div class="column">

            <form>
              <center><label id="pending_variancelbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">VARIANCE FORM</label></center>
            </form>

          <div class="table-scrollable" id="liq_variancediv">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-size: 15px; width: 50%; font-weight: bold;">
                    <center>DENOMINATION
                  </th>
                  <th style="font-size: 15px; width: 50%; font-weight: bold;">
                    <center>AMOUNT
                  </th>

                  </tr>
              </thead>
                <form name="liq_varianceform" id="liq_varianceform">
                    <tbody id="liq_variancetbody">
                      
                    </tbody>
                </form>
            </table>
          </div>
          </div>                               
        <!-- ===========================================END VARIANCE FORM====================================</FORM> -->

      </div>

      <div class="modal-footer" id="pending_modalfooter">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <div>
        </div>
      </div>
    </div>
 <!-- end of modal -->




    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>


    <script type="text/javascript">

        /*======================================auto comma in number=================================================================*/
        $(".d_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
        /*=============================================================================================================================*/

    </script>

      <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>



