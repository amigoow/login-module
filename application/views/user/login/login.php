<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="login-page">
	<div class="container">
		<div class="row">
			<?php $this->view('inc/validation_error.php'); ?>
			
			<div class="col-md-6 col-md-offset-3">
				<div class="page-header">
					<h1>Login</h1>
				</div>
				<?= form_open() ?>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Your username" value="<?php echo set_value('username', $this->uri->segment(2)); ?>">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Your password" value="<?php echo set_value('password'); ?>">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-default" value="Login">
						<a id="forgot_password" href="javascript:void(0);" class="pull-right">Forgot your password?</a>
					</div>
				</form>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</div>

<script type="text/javascript">
	
	$(function(){
		
		$(document).ajaxSend(function(event, request, settings) {
		    $('#ajax-load').show();
		});

		$(document).ajaxComplete(function(event, request, settings) {
		    $('#ajax-load').hide();
		});


		$("#forgot_password").click(function(e){
			e.preventDefault();
			prompt_email_forgot_password();
		})
		function prompt_email_forgot_password(){
			bootbox.prompt({
				title: "Enter your email please where we can send you new password.",
				value: "your@email.com",
				callback: function(result) {
				    if (result === null) {
				    	// console.log("cancelled");
				    } else {
						email = result;
						// do a ajax request to check send password to email
						$.ajax({
							method : 'POST',
							data : {email : email},
							dataType: "json",
							url : "<?php base_url(); ?>" + "user/forgot_password" ,
							success : function(data){
								type = data.status == "fail" ? "error" : "success";
								msg = data.message;
								code = data.code;
								noty({
										text : data.message , theme : 'relax', layout: 'bottomRight', type: type
									}
								);

								if(code != 200) //keep prompting utill success
									prompt_email_forgot_password();
							},
							fail : function(data){
							
								noty({
										text : data.message , theme : 'relax', layout: 'bottomRight', type: 'error'
									}
								);
							}
						});
				    
				  	}
				}
			})
		}
	});

</script>