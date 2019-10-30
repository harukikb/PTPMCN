<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-6"><i class="icon-phone"></i><strong>0045 043204434</strong></div>
                <div class="col-6">
                    <ul id="top_links">
                        <li><a href="#sign-in-dialog" id="access_link">Sign in</a></li>
                        <li><a href="wishlist.html" id="wishlist_link">Wishlist</a></li>
                    </ul>
                </div>
            </div><!-- End row -->
        </div><!-- End container-->
    </div><!-- End top line-->

    <div class="container">
        <div class="row">
            <div class="col-3">
                <div id="logo_home">
                  <h1><a href="<?php echo base_url(); ?>" title="City tours travel template">City Tours travel</a></h1>
              </div>
            </div>
            <nav class="col-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                <div id="header_menu">
                    <img src="<?php echo base_url(); ?>assets/default/img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">
                </div>
                <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                <ul>
                    <li class="submenu">
                        <a href="<?php echo base_url(); ?>" class="show-submenu">Home</a>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);" class="show-submenu">Tours <i class="icon-down-open-mini"></i></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>tour/?view=1">All tours list</a></li>
                            <li><a href="<?php echo base_url(); ?>tour/?view=2">All tours grid</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="<?php echo base_url(); ?>" class="show-submenu">Tra đơn đặt tour</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="show-submenu">FanTour<i class="icon-down-open-mini"></i></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>about">About</a></li>
                            <li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
                        </ul>
                        
                    </li>
                </ul>
                </div><!-- End main-menu -->
                <ul id="top_tools">
                    <li>
                        <a href="javascript:void(0);" class="search-overlay-menu-btn"><i class="icon_search"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div><!-- container -->
</header>

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
      <h3>Sign In</h3>
  </div>
  <form>
      <div class="sign-in-wrapper">
        <a href="#0" class="social_bt facebook">Login with Facebook</a>
        <a href="#0" class="social_bt google">Login with Google</a>
        <div class="divider"><span>Or</span></div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" id="email">
          <i class="icon_mail_alt"></i>
      </div>
      <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" id="password" value="">
          <i class="icon_lock_alt"></i>
      </div>
      <div class="clearfix add_bottom_15">
          <div class="checkboxes float-left">
            <input id="remember-me" type="checkbox" name="check">
            <label for="remember-me">Remember Me</label>
        </div>
        <div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
    </div>
    <div class="text-center"><input type="submit" value="Log In" class="btn_login"></div>
    <div class="text-center">
      Don’t have an account? <a href="javascript:void(0);">Sign up</a>
  </div>
  <div id="forgot_pw">
      <div class="form-group">
        <label>Please confirm login email below</label>
        <input type="email" class="form-control" name="email_forgot" id="email_forgot">
        <i class="icon_mail_alt"></i>
    </div>
    <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
    <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
</div>
</div>
</form>
<!--form -->
</div>
<!-- /Sign In Popup -->

<!-- Search Menu -->
<div class="search-overlay-menu">
    <span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
    <form role="search" id="searchform" method="get">
      <input value="" name="q" type="search" placeholder="Search..." />
      <button type="submit"><i class="icon_set_1_icon-78"></i>
      </button>
  </form>
</div>
  <!-- End Search Menu -->