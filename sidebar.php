<?php disallow_direct_load('sidebar.php');?>

<?php if(!function_exists('dynamic_sidebar') or !dynamic_sidebar('Sidebar')):?>
<?=get_menu('main-nav', 'menu', 'menu-main-menu')?>
<h2 class="widgettitle"><?=get_menu_title('secondary-nav-one')?></h2>
<?=get_menu('secondary-nav-one', 'menu', 'menu-programs-and-projects')?>
<h2 class="widgettitle"><?=get_menu_title('secondary-nav-two')?></h2>
<?=get_menu('secondary-nav-two', 'menu', 'menu-corporate-partners')?>
<h2 class="widgettitle"><?=get_menu_title('secondary-nav-three')?></h2>
<?=get_menu('secondary-nav-three', 'menu', 'menu-educational-partners')?>
<?php endif;?>