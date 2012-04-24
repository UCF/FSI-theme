<?php disallow_direct_load('single.php');?>
<?php get_header(); the_post();?>
	<div class="span4">
        <div id="sidebar">
			
			<a href="<?php print site_url(); ?>"><h1><?php $site_title = get_bloginfo('name'); print $site_title; ?></h1></a>
			
			<?php get_sidebar();?>
			<?php get_sidebar_extras(); ?>
			
		</div>
	</div>
	
	<div class="span8">
			
			<div class="contentwrap <?php $posttype = get_post_type(); print $posttype; ?>-content" id="<?=$post->post_name?>">
				<article>
					
					<!-- IF post is type Person, use get_person_meta(): -->
					
					<?php if (get_post_type() == "person") { ?>
						<?=get_person_meta($post->ID); ?>
					<?php } else { ?>
						
					<!-- ELSE display a typical post output: -->
					
					<h2><?php the_title();?></h2>
					<p class="header-img-wrap">
					<?php
					if ( has_post_thumbnail() ) { 
						the_post_thumbnail( 'page-header-img', array('class' => 'page-header-img') );
						} ?>
					</p>	
					<?php the_content(); } ?>
					
				</article>
			</div>
			
		</div>
		
	</div>
<?php get_footer();?>