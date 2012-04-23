<?php
/**
 * Template Name: Two Column
 **/
?>
<?php get_header(); the_post();?>
	<div class="span4">
        <div id="sidebar">
			<?=get_sidebar();?>
		</div>
	</div>
	
	<div class="span8">
		
		<div id="contentwrap">
			
			<div class="row page-content" id="<?=$post->post_name?>">
				<article>
					<h2><?php the_title();?></h2>
					<?php the_content();?>
				</article>
			</div>
			
		</div>
		
	</div>
	<?
	if(get_post_meta($post->ID, 'page_hide_fold', True) != 'on'): 
		get_template_part('includes/below-the-fold'); 
	endif
	?>
<?php get_footer();?>