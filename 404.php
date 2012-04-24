<?php @header("HTTP/1.1 404 Not found", true, 404);?>
<?php disallow_direct_load('404.php');?>
<?php get_header(); ?>
			
<?=get_sidebar();?>

	
	<div class="span8">
		<div class="contentwrap page-content" id="<?=$post->post_name?>">
			<article>
				<h2>Page Not Found</h2>
				<p>The page you requested cannot be found or does not exist.  Sorry about that.</p>

			</article>
		</div>

	</div>

<?php get_footer();?>