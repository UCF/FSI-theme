<?php disallow_direct_load('sidebar.php');?>

<?php if(!function_exists('dynamic_sidebar') or !dynamic_sidebar('Sidebar')):?>
	
	<div class="span4">
        <div id="sidebar">
			
			<a href="<?php print site_url(); ?>"><h1><?php $site_title = get_bloginfo('name'); print $site_title; ?></h1></a>	
	
			<div id="full-navigation-wrap">
				<?=get_menu('main-nav', 'menu', 'menu-main-menu')?>
				<h2 class="widgettitle"><?=get_menu_title('secondary-nav-one')?></h2>
				<?=get_menu('secondary-nav-one', 'menu', 'menu-programs-and-projects')?>
				<h2 class="widgettitle"><?=get_menu_title('secondary-nav-two')?></h2>
				<?=get_menu('secondary-nav-two', 'menu', 'menu-corporate-partners')?>
				<h2 class="widgettitle"><?=get_menu_title('secondary-nav-three')?></h2>
				<?=get_menu('secondary-nav-three', 'menu', 'menu-educational-partners')?>

				<?php get_sidebar_extras(); ?>
			</div>

			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">

					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<!-- Be sure to leave the brand out there if you want it shown -->
					<span class="brand">Navigation</span>

					<!-- Everything you want hidden at 940px or less, place within here -->
					<div class="nav-collapse">
						<?=get_menu('main-nav', 'menu nav nav-list', 'menu-main-menu')?>
						<h2 class="widgettitle"><?=get_menu_title('secondary-nav-one')?></h2>
						<?=get_menu('secondary-nav-one', 'menu nav nav-list', 'menu-programs-and-projects')?>
						<h2 class="widgettitle"><?=get_menu_title('secondary-nav-two')?></h2>
						<?=get_menu('secondary-nav-two', 'menu nav nav-list', 'menu-corporate-partners')?>
						<h2 class="widgettitle"><?=get_menu_title('secondary-nav-three')?></h2>
						<?=get_menu('secondary-nav-three', 'menu nav nav-list', 'menu-educational-partners')?>
					</div>

				</div>
			</div>
		</div>


	</div>
</div>

<?php endif;?>