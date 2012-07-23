<?php


/**
 * Create a javascript slideshow of each top level element in the
 * shortcode.  All attributes are optional, but may default to less than ideal
 * values.  Available attributes:
 * 
 * height     => css height of the outputted slideshow, ex. height="100px"
 * width      => css width of the outputted slideshow, ex. width="100%"
 * transition => length of transition in milliseconds, ex. transition="1000"
 * cycle      => length of each cycle in milliseconds, ex cycle="5000"
 * animation  => The animation type, one of: 'slide' or 'fade'
 *
 * Example:
 * [slideshow height="500px" transition="500" cycle="2000"]
 * <img src="http://some.image.com" .../>
 * <div class="robots">Robots are coming!</div>
 * <p>I'm a slide!</p>
 * [/slideshow]
 **/
function sc_slideshow($attr, $content=null){
	$content = cleanup(str_replace('<br />', '', $content));
	$content = DOMDocument::loadHTML($content);
	$html    = $content->childNodes->item(1);
	$body    = $html->childNodes->item(0);
	$content = $body->childNodes;
	
	# Find top level elements and add appropriate class
	$items = array();
	foreach($content as $item){
		if ($item->nodeName != '#text'){
			$classes   = explode(' ', $item->getAttribute('class'));
			$classes[] = 'slide';
			$item->setAttribute('class', implode(' ', $classes));
			$items[] = $item->ownerDocument->saveXML($item);
		}
	}
	
	$animation = ($attr['animation']) ? $attr['animation'] : 'slide';
	$height    = ($attr['height']) ? $attr['height'] : '100px';
	$width     = ($attr['width']) ? $attr['width'] : '100%';
	$tran_len  = ($attr['transition']) ? $attr['transition'] : 1000;
	$cycle_len = ($attr['cycle']) ? $attr['cycle'] : 5000;
	
	ob_start();
	?>
	<div 
		class="slideshow <?=$animation?>"
		data-tranlen="<?=$tran_len?>"
		data-cyclelen="<?=$cycle_len?>"
		style="height: <?=$height?>; width: <?=$width?>;"
	>
		<?php foreach($items as $item):?>
		<?=$item?>
		<?php endforeach;?>
	</div>
	<?php
	$html = ob_get_clean();
	
	return $html;
}
add_shortcode('slideshow', 'sc_slideshow');


function sc_search_form() {
	ob_start();
	?>
	<div class="search">
		<?get_search_form()?>
	</div>
	<?
	return ob_get_clean();
}
add_shortcode('search_form', 'sc_search_form');


/**
 * Set default menu_order for all people to 999 (from 0) for 
 * accurate sort results (for person_by_org_group):
 **/
$all_people = get_posts(array('post_type' => 'person', 'numberposts' => -1));
foreach ($all_people as $person) {
	if ($person->menu_order == 0) {
		$person->menu_order = 999;
	}
}


/**
 * Output org groups by org group name.
 * 
 **/
function person_by_org_group($attr, $content = null) {	
	$group = $attr['group'];
	$taxonomy = get_taxonomy('org_groups');
	if ($group == '') { return ''; }
	$people = get_posts(array('post_type' => 'person', 'taxonomy' => 'org_groups', 'term' => $group, 'numberposts' => -1, 'orderby' => 'menu_order person_orderby_name', 'meta_key' => 'person_orderby_name', 'order' => 'ASC'));
	
	ob_start();?>
	
	<div class="people-org-group">
			<h3><?=$group?></h3>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th scope="col" class="name">Name</th>
						<th scope="col" class="job_title">Title</th>
						<th scope="col" class="phones">Phone(s)</th>
						<th scope="col" class="email">E-Mail</th>
					</tr>
				</thead>				
				<tbody>
									
					<?php
					$count = 0;
						foreach($people as $person) {
							$count++;
							$email      = get_post_meta($person->ID, 'person_email', True);
							$link = ($person->post_content == '') ? False : True;
						?>
							<tr>
								<td class="name">
									<a href="<?=get_permalink($person->ID)?>">
										<?=Person::get_name($person)?>
									</a>
								</td>
								<td class="job_title">
									<?=get_post_meta($person->ID, 'person_jobtitle', True)?>
								</td> 
								<td class="phones"><?php if(Person::get_phones($person)){?><ul class="unstyled"><?php foreach(Person::get_phones($person) as $phone) { ?><li><?=$phone?></li><?php }?></ul><?php } ?></td>
								<td class="email"><?=(($email != '') ? '<a href="mailto:'.$email.'">'.$email.'</a>' : '')?></td>
							</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	<?php 
	return ob_get_clean();
}
add_shortcode('people-group', 'person_by_org_group');
?>