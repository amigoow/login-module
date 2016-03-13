<?php if (validation_errors() || isset($error)) : ?>
	<div class="col-md-12">
		<?php $error_msg = isset($error) ? $error :  validation_errors(); ?>
		<script type="text/javascript">
			$(function(){
				var msg = ('<?php echo json_encode($error_msg); ?>');
				
				noty({
						text : msg , theme : 'relax', layout: 'bottomRight', type: 'error',
						animate : {
							open: 'flipInX',
					        close: 'flipOutX',
					        
						}
					}
				);
			});
		</script>
	</div>
<?php endif; ?>