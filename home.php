<?php if (function_exists('disallow_direct_load')):?>
<?php disallow_direct_load('home.php');?>
<?php get_header(); ?>
			
<?=get_sidebar();?>
	
	<div class="span8" id="rightcol-content">
			
			<div class="contentwrap page-content" id="home">
				<article>
					<h2>Welcome to the Florida Space Institute</h2>
					<?php $home_content = get_page_by_title('Home'); echo (apply_filters('the_content',$home_content->post_content)); ?>
					<h3>News</h3>
					<?php
					//Get 2 featured posts for the home page.  If no posts tagged as 'featured' exist, pull the 2 newest posts
					$featured_query = new WP_Query( array('posts_per_page' => 2, 'tag' => 'featured') );
					$newest_query = new WP_Query( array('posts_per_page' => 2) );
					
					if ( $featured_query->have_posts() ){
						while ( $featured_query->have_posts() ) : $featured_query->the_post();
					?>
						<div class="post_list">
							<?php if ( has_post_thumbnail() ) { ?>
							  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							<?php } ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</div>
					<?php	
						endwhile;
					}
					else { 
						while ( $newest_query->have_posts() ) : $newest_query->the_post();
					?>
						<div class="post_list">
							<?php if ( has_post_thumbnail() ) { ?>
							  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb'); ?></a>
							<?php } ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</div>
					<?php	
						endwhile;
					}
					?>
					
				</article>
			</div>
			
		</div>
		
	</div>
<?php get_footer();?>
<?php endif;?>