<?php get_header(); ?>
	<section id="blog">
		<div class="container">
			<!-- Title -->
			<div class="title">
				<div class="six columns">
                    <h2 class="archive-title"><?php get_setting_e( 'blog_heading' ); ?></h2>
    				<h3 class="archive-title"><?php
    					if ( is_category() ) :
    						printf( __( 'Category Archives: %s', 'spyropress' ), single_cat_title( '', false ) );
                        elseif ( is_tag() ) :
    						printf( __( 'Tag Archives: %s', 'spyropress' ), single_tag_title( '', false ) );
                        elseif ( is_day() ) :
    						printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
    					elseif ( is_month() ) :
    						printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
    					elseif ( is_year() ) :
    						printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
    					else :
    						_e( 'Archives', 'twentythirteen' );
    					endif;
    				?></h3>
				</div>
				<div class="ten columns">
					<p class="two-lines"><?php get_setting_e( 'blog_description' ); ?></p>
				</div>
			</div>
		</div>
		<!-- Blog Content -->
		<div class="grey">
			<div class="container">
				<!-- Blog Posts Column -->
				<div class="eleven columns">
                <?php
                while( have_posts() ) {
                    the_post();
                ?>
                    <!-- Blog Post -->
                    <article class="post">
                    	
                    	<!-- Post Thumbnail -->
                    	<a class="thumb" href="<?php the_permalink(); ?>"><?php get_image( 'width=640' ); ?></a>
                    	
                    	<!-- Post Title -->
                    	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    	
                    	<!-- Post Meta -->
                    	<span class="meta">By <?php the_author_link(); ?> on <?php the_date(); ?> in <?php the_category( ', ') ?></span>
                    	<?php the_tags( '<span class="tags">tags: ', ', ', '</span>' ); ?>
                    	<div class="clearfix"></div>
                    	
                    	<!-- Post Content -->
                        <?php spyropress_the_content(); ?>
                    	<div class="clearfix"></div>
                    	
                    </article>
                    <hr class="posts" />
                <?php
                    }
                    
                    wp_pagenavi();
                ?>
				</div>
				<!-- Sidebar Column -->
				<div class="five columns">
					<aside class="sidebar">
					</aside>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>