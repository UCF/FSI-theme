<?php @header("HTTP/1.1 404 Not found", true, 404);?>
<?php disallow_direct_load('404.php');?>
<?php get_header(); ?>
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
				<h2>Page Not Found</h2>
				<p>The page you requested cannot be found or does not exist.  Sorry about that.</p>

			</article>
		</div>

	</div>

<?php get_footer();?>