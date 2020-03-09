<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $this->page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/jupiter/css/bootstrap.min.css'); ?>" >
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/jupiter/css/style.css'); ?>" >
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo get_settings('company_name'); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
	 		<ul class="nav navbar-nav navbar-right">              
	      		<li><a href="../navbar-static-top/">Login</a></li>
	      		<li><a href="../navbar-fixed-top/">Sign Up</a></li>
	 		</ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	<?php echo $content; ?>
	  <hr>

      <footer>
        <p>&copy; <?php echo date('Y') ?> <?php echo get_settings('company_name'); ?></a></p>
      </footer>
    </div>
</body>
</html>