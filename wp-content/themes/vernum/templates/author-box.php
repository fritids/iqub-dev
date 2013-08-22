<?php
$meta_author = get_setting_array( 'meta_authorbox', array() );
if( !in_array( 'box', $meta_author ) ) return;

?>
<!-- About Author -->					
<article class="post-author">

	<div class="author-avatar">
		<?php echo wp_kses( get_avatar( get_the_author_meta( 'ID' ), 80 ), array( 'img' => array( 'src' => array(), 'alt' => array(), 'height' => array(), 'width' => array() ) ) ); ?>
	</div>
	
	<h4><?php echo get_setting( 'authorbox_title', 'About' ) . ' ' . get_the_author_meta( 'display_name' ); ?></h4>
	<p><?php the_author_meta( 'description' ); ?></p>
	
</article>
<hr class="posts"/>