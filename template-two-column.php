<?php
/**
 * Template Name: Two Column
 **/
?>
<?php get_header(); the_post();?>
	<div class="span4">
        <div id="sidebar">
			
			<a href="<?php print site_url(); ?>"><h1><?php $site_title = get_bloginfo('name'); print $site_title; ?></h1></a>
			
			<?=get_sidebar();?>
			
			<div class="sidebar_social">
                <a class="sidebar_socialbtn" id="sidebar_facebook" href="http://www.facebook.com/floridaspaceinstitute/">Facebook</a>
                <a class="sidebar_socialbtn" id="sidebar_twitter" href="http://www.twitter.com/floridaspaceinstitute/">Twitter</a>
            </div>
            
            <div>
                <address>Florida Space Institute<br/>
                    12443 Research Parkway<br/>
                    Orlando, Florida 32333-3333<br/>
                    407-823-0000
                </address>
            </div>
			
		</div>
	</div>
	
	<div class="span8">
			
			<div class="contentwrap page-content" id="<?=$post->post_name?>">
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