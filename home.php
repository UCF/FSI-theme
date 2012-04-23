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
					<h2>Welcome to the Florida Space Institute</h2>
					<?php the_content();?>
					
					<?php
					$args = array( 'numberposts' => 3 );
					$lastposts = get_posts( $args );
					foreach($lastposts as $post) : setup_postdata($post); ?>
						<div class="post_list">
							<?php if ( has_post_thumbnail() ) { ?>
							  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							<?php } ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</div>
					<?php endforeach; ?>
					
				</article>
			</div>
			
		</div>
		
	</div>
<?php get_footer();?>