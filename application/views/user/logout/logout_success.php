<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Logout success!</h1>
			</div>
			<p>You are being logged out...</p>
			<script>
				setTimeout(function(){
					window.location.href = '/';
				},2000)
			</script>
			
		</div>
	</div><!-- .row -->
</div><!-- .container -->