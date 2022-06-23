    
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">

<style>
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  .topnav {
    overflow: hidden;
    background-color: #fff;
  }

  .topnav a {
    float: left;
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnav a:hover {
    background-color: #ddd;
    color: #e45000;
  }

  .topnav a.active {
    background-color: #e45000;
    color: white;
  }

  .topnav .icon {
    display: none;
  }

  @media screen and (max-width: 600px) {
    .topnav a:not(:first-child) {display: none;}
    .topnav a.icon {
      float: right;
      display: block;
    }
  }

  @media screen and (max-width: 600px) {
    .topnav.responsive {position: relative;}
    .topnav.responsive .icon {
      position: absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive a {
      float: none;
      display: block;
      text-align: left;
    }
  }
</style>

<!-- BEGIN TOP BAR -->
<div class="pre-header">
  <div class="container">
    <div class="row">
      <!-- BEGIN TOP BAR LEFT PART -->
      <div class="col-md-6 col-sm-6 additional-shop-info">
        <ul class="list-unstyled list-inline">
          <li>Contact Us : <i class="fa fa-phone"></i><span>+ 1821</span></li>
          <li>Look for : Ma'am Lanie / Ma'am April</span></li>
        </ul>
      </div>
      <!-- END TOP B  AR LEFT PART -->
      <!-- BEGIN TOP BAR MENU -->

      <div class="col-md-6 col-sm-6 additional-nav">
        <ul class="list-unstyled list-inline pull-right">
          <li><img alt="" class="img-square" src="http://<?php echo $photo_url; ?>" style="width: 25px;">&nbsp;&nbsp;<?php echo $username ?> [ <?php echo $emp_id ?> ]
          </li>

          <li><a href="<?php echo site_url('main_controller/log_out') ?>">Log Out</a></li>
        </ul>
      </div>
      <!-- END TOP BAR MENU -->
    </div>
  </div>
</div>
<!-- END TOP BAR -->
<!-- BEGIN HEADER -->

<div class="header">
  <div class="container">
    <!-- <div>
      <h2 style="margin-top: 1%; color: #e45000;"> CS CASHIER </h2>
    </div> -->
    <a class="site-logo" href="<?php echo site_url()?>"><img src="<?php echo base_url();?>assets/agc_logo/liquidation_logo.png" alt="Metronic FrontEnd"></a>
        <!-- <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a> -->

    <!-- END NAVIGATION -->
  </div>
</div>
<!-- Header END -->
<div class="topnav" id="myTopnav" style="margin-top: -1%; margin-left: 10%;">

  <button class="btn btn-primary waves-effect"><a href="<?php echo base_url() ?>cashier_cashform_route">
    CASH DENOMINATION FORM
  </a></button>

  <button class="btn btn-success waves-effect"><a href="<?php echo base_url() ?>cashier_noncashform_route">
    NON CASH DENOMINATION FORM
  </a></button>

  <button class="btn btn-info waves-effect"><a href="<?php echo base_url() ?>cashier_historyform_route">
    HISTORY
  </a></button>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>

</div>

<script>
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
</script>