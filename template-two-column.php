<?php
/**
 * Template Name: Two Column
 **/
?>
<?php get_header(); the_post();?>

<?php get_sidebar();?>
	
	<div class="span8">
			
			<div class="contentwrap page-content" id="<?=$post->post_name?>">
				<article>
					<h2><?php the_title(); ?></h2>
					<p class="header-img-wrap">
					<?php
					if ( has_post_thumbnail() ) { 
						the_post_thumbnail( 'page-header-img', array('class' => 'page-header-img') );
						} ?>
					</p>	
					<?php the_content(); ?>
					
				</article>
			</div>
			
		</div>
		
	</div>
<?php get_footer();?>