<?php get_header(); ?>
	<section id="blog">
		<?php
        while( have_posts() ) {
            the_post();
        ?>
        <div class="container">
			<section class="blog-header">
			
				<div class="sixteen columns">
				
					<!-- Title -->
					<div class="single-title">
						<h1><?php the_title(); ?></h1>
						<span class="meta">Posted by <?php the_author_link(); ?> | <?php the_date(); ?> | <?php the_category( ', ') ?> | <?php comments_popup_link(); ?></span>
                        <?php the_tags( '<span class="tags">tags: ', ', ', '</span>' ); ?>
					</div>
				
					<!-- Breadcrumbs -->
					<nav class="breadcrumbs">
						<p>You are here:</p>
						<ul>
							<li><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Blog</a></li>
							<li><i class="icon-angle-right"></i></li>
							<li><?php the_title(); ?></li>
						</ul>
					</nav>
					
				</div>
			
			</section>
		</div>
		<!-- Blog Content -->
		<div class="grey">
			<div class="container">
				<!-- Blog Posts Column -->
				<div class="eleven columns">
                    <!-- Blog Post -->
                    <article class="post">
                    	
                    	<!-- Post Thumbnail -->
                    	<?php get_image( 'width=640' ); ?>
                    	
                    	<!-- Post Content -->
                        <?php spyropress_the_content(); ?>
                    	
                    </article>
                    <hr class="posts" />
                    <?php get_template_part( 'templates/author', 'box') ?>
                    
                    <!-- Comments -->
                    <?php comments_template( '', true ); ?>
                <?php
                    }
                ?>
				</div>
				<!-- Sidebar Column -->
				<div class="five columns">
					<aside class="sidebar">
                        <?php get_sidebar(); ?>
					</aside>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>