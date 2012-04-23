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
					
					<?php
					// Pagination variable
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					//print "<p>Page ".$paged."</p>";
					
					
					// The Query
					$the_query = new WP_Query( array('posts_per_page' => 10, 'paged' => $paged) );

					// The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post();
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
					?>
					
					<div id="post_navigation">
					    <span class="leftnav"><?php next_posts_link('&laquo; View Older Posts', $the_query->max_num_pages) ?></span>
					    <span class="rightnav"><?php previous_posts_link('View Newer Posts &raquo;') ?></span>
					</div>
					
					
						
						
					
				</article>
			</div>
			
		</div>
		
	</div>
<?php get_footer();?>