<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?="\n".header_()."\n"?>
		<!--[if IE]>
		<link href="http://cdn.ucf.edu/webcom/-/css/blueprint-ie.css" rel="stylesheet" media="screen, projection">
		<![endif]-->
		<?php if(GA_ACCOUNT or CB_UID):?>
		
		<script type="text/javascript">
			var _sf_startpt = (new Date()).getTime();
			<?php if(GA_ACCOUNT):?>
			
			var GA_ACCOUNT  = '<?=GA_ACCOUNT?>';
			var _gaq        = _gaq || [];
			_gaq.push(['_setAccount', GA_ACCOUNT]);
			_gaq.push(['_setDomainName', 'none']);
			_gaq.push(['_setAllowLinker', true]);
			_gaq.push(['_trackPageview']);
			<?php endif;?>
			<?php if(CB_UID):?>
			
			var CB_UID      = '<?=CB_UID?>';
			var CB_DOMAIN   = '<?=CB_DOMAIN?>';
			<?php endif?>
			
		</script>
		<?php endif;?>
		
	</head>
	<body class="<?=body_classes()?>">
		<div class="container">
			<div class="row">
				<div id="header" class="row-border-bottom-top">
					<h1 class="span9 sans"><a href="<?=bloginfo('url')?>"><?=bloginfo('name')?></a></h1>
					<?php $options = get_option(THEME_OPTIONS_NAME);?>
					<?php if($options['facebook_url'] or $options['twitter_url']):?>
					<ul class="social menu horizontal span3">
						<?php if($options['facebook_url']):?>
						<li><a class="ignore-external facebook" href="<?=$options['facebook_url']?>">Facebook</a></li>
						<?php endif;?>
						<?php if($options['twitter_url']):?>
						<li><a class="ignore-external twitter" href="<?=$options['twitter_url']?>">Twitter</a></li>
						<?php endif;?>
					</ul>
					<?php else:?>
					<div class="social span3">&nbsp;</div>
					<?php endif;?>
					<div class="end"><!-- --></div>
				</div>
			</div>
			<?=get_menu('header-menu', 'menu horizontal span12', 'header-menu')?>