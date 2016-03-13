

	<div id="login-page">
	  	<div class="container">
	  		<?php $this->view('inc/validation_error.php'); ?>
		    <form class="form-login" method="POST" action="<?php echo base_url('user/admin_login') ?>">
		        <h2 class="form-login-heading">ADMIN SIGNIN</h2>
		        <div class="login-wrap">
		            
		            <input type="text" class="form-control" placeholder="Username" name="username" autofocus required value="<?php echo set_value('username'); ?>">
		            <br>
		            <input type="password" class="form-control" name="password" placeholder="Password" required value="<?php echo set_value('password'); ?>">
		            <label class="checkbox">
		                <span class="pull-right">
							<!-- <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a> -->
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		          
		        </div>
			</form>	  	
	  	
	  	</div>
	</div>
	