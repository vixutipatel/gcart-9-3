<?php
	$main_categories  = $this->category->get_parent_category();
	$sub_categories    = $this->category->get_sub_category();
	$header_categories = $this->category->get_parent_category(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>GCART</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/blue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/content.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/owl.transitions.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/rateit.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap-select.min.css">
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-1.11.1.min.js"></script>

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/themes/default/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<script src="<?php echo base_url(); ?>assets/themes/default/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-1.11.1.min.js"></script>

<!-- Fonts -->
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">

            <ul class="list-unstyled">
            <?php

            	if (is_user_logged_in())
            	{
            	?>
                <li><a href="#">Welcome&nbsp<?php echo get_loggedin_info('username'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                <li><a href="<?php echo site_url('authentication/logout'); ?>"><?php _el('logout');?></a></li>
                 <div class="dropdown" style="float: right;">
                  <div class="btn-group btn-group-sm">
                  <a class="btn btn-primary  dropdown-toggle" href="<?php echo base_url(); ?>#" id="dropdownMenuLink" data-toggle="dropdown"  >

                 <div class="icon fa fa-user"> My Account </div> </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="<?php echo site_url('profile') ?>">My profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo site_url('profile/edit') ?>"><?php _el('edit_profile');?></a></li>
                     <li><a class="dropdown-item" href="#">My Orders</a></li>
                  </div>

                </div>

                </div>
            <?php }
            	else
            	{
            	?>

            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
            <li><a href="<?php echo base_url(); ?>#"><i class="icon fa fa-check"></i>Checkout</a></li>
            <li><a href="<?php echo site_url('authentication'); ?>"><i class="icon fa fa-lock"></i>Login</a></li>
            <li><a href="<?php echo site_url('vendor'); ?>"><i class="icon fa fa-user"></i>Sell</a></li>
           <?php }

           ?>
          </ul>

        </div>
        <!-- /.cnt-account -->


        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.header-top -->
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>assets/themes/default/images/logo.png" alt="logo"> </a> </div>

          <!-- /.logo -->
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->

        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
          <!-- /.contact-row -->
          <!-- ============================================================= SEARCH AREA ============================================================= -->

            <div class="search-area">
            <form action="<?php echo base_url('categories/search') ?>" name="search" method='post'>

              <div class="control-group">
                
                 <select id="Categories" name="category_id"  data-toggle="dropdown" ><b class="Caret"></b>                    
                 <option value="*" class="dropdown">Categories</option>               
                     <?php
                      	foreach ($main_categories as $key => $main_category)
                      	{
                      	?>                   
                <option class="dropdown"  value="<?php echo $main_category->id; ?>"><?php echo ucwords($main_category->name); ?></option>

                      <?php }
                      ?>                
                </select>
                <input class="search-field" name="name"  placeholder="Search here..." />
                 <button type="submit" id='save' name="submit" class="search-button"></button>
               <!-- <a class="search-button"  href="#" ></a>-->
                </div>
            </form>
          </div>
          <!-- /.search-area -->
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->

        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

          <div class="dropdown dropdown-cart"> <a href="<?php echo base_url(); ?>#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
              <div class="basket-item-count"><span class="count">2</span></div>
              <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign">$</span><span class="value">600.00</span> </span> </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="<?php echo base_url(); ?>detail.html"><img src="assets/themes/default/images/cart.jpg" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="<?php echo base_url(); ?>index.php?page-detail">Simple Product</a></h3>
                      <div class="price">$600.00</div>
                    </div>
                    <div class="col-xs-1 action"> <a href="<?php echo base_url(); ?>#"><i class="fa fa-trash"></i></a> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$600.00</span> </div>
                  <div class="clearfix"></div>
                  <a href="<?php echo base_url(); ?>checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                <!-- /.cart-total-->

              </li>
            </ul>
            <!-- /.dropdown-menu-->
          </div>
          <!-- /.dropdown-cart -->

          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row -->
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

  </div>
  <!-- /.main-header -->

  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                 <li class="active dropdown yamm-fw"> <a href="<?php echo base_url(); ?>#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>
                <?php

                	foreach ($header_categories as $key => $header_category)
                	{
                	?>

                <li class="dropdown yamm mega-menu"><a href="<?php echo base_url().'categories/get_parent_category_products/'.$header_category->id; ?>" data-hover="dropdown" class="dropdown-toggle"  data-toggle="dropdown"><?php echo ucwords($header_category->name); ?> </a>       

                                        <!-- /.accordion-heading -->
                  <ul class="dropdown-menu container"  id="one<?php echo $header_category->id; ?>">
                    <li>
                     <div class="yamm-content">

                        <div class="row">

                          <div class="row-xs-12 row-sm-12 row-md-12 row-menu">
                          <!--  <h2 class="title"><?php echo ucwords($sub_categories->name); ?></h2>-->
                            <ul class="links">
                    <?php
                    	$counter = 0;

                    		foreach ($sub_categories as $key => $sub_category)
                    		{
                    			if ($sub_category->category_id == $header_category->id)
                    			{
                    				if ($counter < 6)
                    				{
                    				?>
                         <div  class="col-xs-12 col-sm-6 col-md-3 col-menu " >
                            <ul class="links">

                              <li><a href="<?php echo base_url().'categories/get_sub_category_products/'.$sub_category->id; ?>"><?php echo ucwords($sub_category->name);
				$counter++; ?>
                                  </a></li>
                                </ul>
                         </div>
                <?php
                	}
                				elseif ($counter >= 6)
                				{
                				?>
                           <div class="col-xs-12 col-sm-6 col-md-3 col-menu" >
                            <ul class="links">
                              <li><a href="<?php echo base_url().'Categories/get_sub_category_products/'.$sub_category->id; ?>"><?php echo ucwords($sub_category->name);
				$counter++; ?>
                                  </a></li>
                                  </ul>
                                  </div>
                                <?php
                                	}
                                				else
                                				{
                                				?>
                           <div class="col-xs-12 col-sm-6 col-md-3 col-menu">
                            <ul class="links">
                              <li><a href="<?php echo base_url().'Categories/get_sub_category_products/'.$sub_categories->id; ?>"><?php echo ucwords($sub_category->name);
				$counter++; ?>
                                  </a></li>
                                  </ul>
                                  </div>
                                <?php
                                	}

                                			?>


                                                    <?php
                                                    	}
                                                    		}

                                                    	?>
                            </ul>
                          </div>

                      <!-- /.yamm-content -->
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>

             <?php }

             ?>

              </ul>

              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer -->
          </div>
          <!-- /.navbar-collapse -->

        </div>
        <!-- /.nav-bg-class -->
      </div>
      <!-- /.navbar-default/ -->
    </div>
    <!-- /.container-class -->

  </div>
  <!-- /.header-nav -->
  <!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- main container -->
  <!-- ============================================== CONTAINER  : START ============================================== -->
  <?php echo $content; ?>

    <!-- ============================================== CONTAINER  : END============================================== -->

 <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
      <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
          <div class="item m-t-15"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand1.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item m-t-10"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand2.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand3.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand4.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand5.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand6.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand2.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand4.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand1.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->

          <div class="item"> <a href="<?php echo base_url(); ?>#" class="image"> <img data-echo="<?php echo base_url(); ?>assets/themes/default/images/brands/brand5.png" src="<?php echo base_url(); ?>assets/themes/default/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
        </div>
        <!-- /.owl-carousel #logo-slider -->
      </div>
      <!-- /.logo-slider-inner -->

    </div>
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
  </div>
  <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->
<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Contact Us</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class="toggle-footer" style="">
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>+(888) 123-4567<br>
                    +(888) 456-7890</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body"> <span><a href="<?php echo base_url(); ?>#">flipmart@themesground.com</a></span> </div>
              </li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Customer Service</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a href="<?php echo base_url(); ?>#" title="Contact us">My Account</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="About us">Order History</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="faq">FAQ</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Popular Searches">Specials</a></li>
              <li class="last"><a href="<?php echo base_url(); ?>#" title="Where is my order?">Help Center</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Corporation</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a title="Your Account" href="<?php echo base_url(); ?>#">About us</a></li>
              <li><a title="Information" href="<?php echo base_url(); ?>#">Customer Service</a></li>
              <li><a title="Addresses" href="<?php echo base_url(); ?>#">Company</a></li>
              <li><a title="Addresses" href="<?php echo base_url(); ?>#">Investor Relations</a></li>
              <li class="last"><a title="Orders History" href="<?php echo base_url(); ?>#">Advanced Search</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Why Choose Us</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a href="<?php echo base_url(); ?>#" title="About us">Shopping Guide</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Blog">Blog</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Company">Company</a></li>
              <li><a href="<?php echo base_url(); ?>#" title="Investor Relations">Investor Relations</a></li>
              <li class=" last"><a href="<?php echo base_url(); ?>contact-us.html" title="Suppliers">Contact Us</a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
      </div>
    </div>
  </div>
  <div class="copyright-bar">
    <div class="container">
      <div class="col-xs-12 col-sm-6 no-padding social">
        <ul class="link">
          <li class="fb pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Facebook"></a></li>
          <li class="tw pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Twitter"></a></li>
          <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="GooglePlus"></a></li>
          <li class="rss pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="RSS"></a></li>
          <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="PInterest"></a></li>
          <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Linkedin"></a></li>
          <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="<?php echo base_url(); ?>#" title="Youtube"></a></li>
        </ul>
      </div>
      <div class="col-xs-12 col-sm-6 no-padding">
        <div class="clearfix payment-methods">
          <ul>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/1.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/2.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/3.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/4.png" alt=""></li>
            <li><img src="<?php echo base_url(); ?>assets/themes/default/images/payments/5.png" alt=""></li>
          </ul>
        </div>
        <!-- /.payment-methods -->
      </div>
    </div>
  </div>
</footer>
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/echo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery.easing-1.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/default/js/lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/default/js/scripts.js"></script>

</body>
</html>