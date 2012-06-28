<?php disallow_direct_load('single.php');?>
<?php get_header(); the_post();?>

<?php get_sidebar();?>
			

	<div class="span8" id="rightcol-content">
			
			<div class="contentwrap <?php $posttype = get_post_type(); print $posttype; ?>-content" id="<?=$post->post_name?>">
				<article>
					
					<!-- IF post is type Person, use get_person_meta(): -->
					
					<?php if (get_post_type() == "person") { ?>
						<?=get_person_meta($post->ID); ?>
					<?php } else { ?>
						
					<!-- ELSE display a typical post (news article) output: -->
					
					<a class="news-back" href="../news-and-events/">&laquo; Back to News</a>
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