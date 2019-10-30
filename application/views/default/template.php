
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
  <meta name="author" content="Ansonika">
  <title><?php echo $title; ?></title>

    <!-- Favicons-->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/default/img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/default/img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/default/img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/default/img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/default/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,700" rel="stylesheet">

    <!-- COMMON CSS -->
  <link href="<?php echo base_url(); ?>assets/default/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/default/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/default/css/vendors.css" rel="stylesheet">

  <!-- CUSTOM CSS -->
  <link href="<?php echo base_url(); ?>assets/default/css/custom.css" rel="stylesheet">

  
  <?php 
    if(!empty($custom_css)){
      foreach($custom_css as $css){
        echo "<link type='text/css' href='".base_url().$css."' rel='stylesheet'>";
      }
    }
  ?>

</head>

<body>

  <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
  </div>
  <!-- End Preload -->

  <div class="layer"></div>
  <!-- Mobile menu overlay mask -->

  <!-- Header================================================== -->
  <?php $this->load->view("default/header"); ?>
  <!-- End Header -->
 
  <?php 
  if(isset($after_header))
    $this->load->view($after_header); 
  ?>
  <!-- END REVOLUTION SLIDER -->

  <?php 
  if(isset($temp))
    $this->load->view($temp); 
  ?>

  <!-- End main -->
  <?php $this->load->view("default/footer"); ?>
  <!-- End footer -->

  <div id="toTop"></div><!-- Back to top button -->

  <?php 
  if(isset($after_footer)){
    $this->load->view($after_footer);
  }
  ?>
  <!-- Common scripts -->
  <script src="<?php echo base_url(); ?>assets/default/js/jquery-2.2.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/default/js/common_scripts_min.js"></script>
  <script src="<?php echo base_url(); ?>assets/default/js/functions.js"></script>

  <!-- Custom script  -->
  <?php 
    if(!empty($custom_js_external)){
      foreach($custom_js_external as $script){
        echo "<script src='".$script."'></script>";
      }
    }
    if(!empty($custom_js)){
      foreach($custom_js as $script){
        echo "<script src='".base_url().$script."'></script>";
      }
    }
    
  ?>

</body>

</html>