   <div class="container" style="margin-top:30px;">
    <?php $this->load->view('themes/default/includes/alerts');?>
    <div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class='active'>profile</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->                
	<div class="col-md-12 col-sm-12 sign-in">
		<center>
	    <h4 class="">Account Information</h4>
	    <img alt="" style="width:200px; height: 150px;" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo base_url() ?><?php echo $user['profile_image']; ?>" alt="<?php _el('profile_image');?>"  > 
	    </center>
	<div>
	
	<div class="col-md-6 col-sm-6">
		<div class="table-responsive">
           	<form id="signup_form" method="post" action="" class="register-form outer-top-xs">
 
           	    <table class="table table-condensed table-responsive " >
                <tbody>                                                                  
                	<tr>        
                        <td>                        
            			<label class="info-title " for="firstname"><b><?php _el('firstname');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $user['firstname']; ?>     
                        </td>
                    </tr>
                     <tr>        
                        <td>
           				<label class="info-title" for="lastname"><b><?php _el('lastname');?></b> </label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $user['lastname']; ?>     
                        </td>
                    </tr>
                     <tr>        
                        <td>
            			<label class="info-title" for="mobile"><b><?php _el('mobile_no');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $user['mobile']; ?>     
                        </td>
                    </tr>
                        <tr>        
                        <td>
           				<label class="info-title" for="exampleInputEmail2"><b><?php _el('email');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                           <a href="mailto:<?php echo $user['email']; ?>"> <?php echo $user['email']; ?></a>   
                        </td>
                    </tr>              
                </tbody>
            </table>
        </form>
        </div>	
 	</div>
<?php
	//var_dump($users);
	foreach ($users as $users)
	{
	}

?>
        <div class="col-md-6 col-sm-6 ">
            <div class="table-responsive ">
            <form id="signup_form" method="post" action="" class="register-form outer-top-xs">

            	<table class="table table-condensed table-responsive" >
                <tbody>
                    <tr>        
                        <td>
            			<label class="info-title" for="address_1"><b><?php _el('address_1');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $users['address_1']; ?>     
                        </td>
                    </tr>
                    <tr>        
                        <td>
            			<label class="info-title" for="address_2"><b><?php _el('address_2');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $users['address_2']; ?>     
                        </td>
                    </tr>                   
                     <tr >        
                        <td>
            			<label class="info-title" for="city"><b><?php _el('city');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $users['city']; ?>     
                        </td>
                    </tr>
                    <tr>        
                        <td>
        			    <label class="info-title" for="state"><b><?php _el('state');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $users['state']; ?>     
                        </td>
                    </tr>
                    <tr>        
                        <td>
          				  <label class="info-title" for="pin_code"><b><?php _el('pin_code');?></b></label>
           			    </td>
                        <td class="form-control unicase-form-control text-input">
                            <?php echo $users['pincode']; ?>     
                        </td>
                    </tr>                                                  
                </tbody>
            	</table>
        	</form>
            </div>
        </div><!--col-sm-6-->

    </div>
</div>
</div>
