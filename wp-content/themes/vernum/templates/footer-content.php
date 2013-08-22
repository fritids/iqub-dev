<!-- Twitter Feed -->
<div class="bluebg">
	<div class="container">
		<ul id="twitter-feed"></ul>
		<script type="text/javascript">
			jQuery(document).ready(function($){
			$.getJSON( '<?php echo admin_url('admin-ajax.php'); ?>?action=spyropress_footer_twitter&count=3', function(tweets){
				$("#twitter-feed").html(tz_format_twitter(tweets));
			}); });
		</script>
	</div>
</div>
<div class="contact-details">
	<img src="<?php get_setting_e( 'logo' ); ?>">
    <?php
        echo do_shortcode( get_setting( 'footer_text' ) );
        echo do_shortcode( '[socials]' );
    ?>
</div>