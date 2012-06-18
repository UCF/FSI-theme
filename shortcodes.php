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




function person_by_org_group($attr, $content = null) {
	$alanstern   = get_page_by_title('Alan Stern', 'OBJECT', 'person');
	$joshuacolwell = get_page_by_title('Joshua Colwell', 'OBJECT', 'person');
	
	$group = $attr['group'];
	$taxonomy = get_taxonomy('org_groups');
	if ($group == '') { return ''; }
	$people = get_posts(array('post_type' => 'person', 'taxonomy' => 'org_groups', 'term' => $group, 'numberposts' => -1, 'orderby' => 'person_orderby_name', 'meta_key' => 'person_orderby_name', 'order' => 'ASC', 'exclude' => array($alanstern->ID, $joshuacolwell->ID))); //Exclude Alan Stern and Josh Colwell
	
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
					<?php if ($group == 'FSI Faculty') { //Alan Stern and Joshual Colwell must go first ?>
							<tr>
								<td class="name">
									<a href="<?=get_permalink($alanstern->ID)?>"><?=Person::get_name($alanstern)?></a>
								</td>
								<td class="job_title">
									<?=get_post_meta($alanstern->ID, 'person_jobtitle', True)?>
								</td> 
								<td class="phones">
										<ul>
											<? foreach(Person::get_phones($alanstern) as $phone) {
												  ?>
												<li><?=$phone?></li>
											<?php } ?>
										</ul>
								</td>
								<td class="email">
									<?=((get_post_meta($alanstern->ID, 'person_email', TRUE) != '') ? '<a href="mailto:'.get_post_meta($alanstern->ID, 'person_email', TRUE).'">'.get_post_meta($alanstern->ID, 'person_email', TRUE).'</a>' : '') ?>
								</td>
							</tr>
							<tr>
								<td class="name">
									<a href="<?=get_permalink($joshuacolwell->ID)?>"><?=Person::get_name($joshuacolwell)?></a>
								</td>
								<td class="job_title">
									<?=get_post_meta($joshuacolwell->ID, 'person_jobtitle', True)?>
								</td> 
								<td class="phones">
										<ul>
											<? foreach(Person::get_phones($joshuacolwell) as $phone) {
												  ?>
												<li><?=$phone?></li>
											<?php } ?>
										</ul>
								</td>
								<td class="email">
									<?=((get_post_meta($joshuacolwell->ID, 'person_email', TRUE) != '') ? '<a href="mailto:'.get_post_meta($joshuacolwell->ID, 'person_email', TRUE).'">'.get_post_meta($joshuacolwell->ID, 'person_email', TRUE).'</a>' : '') ?>
								</td>
							</tr>
				
					<?php
					}
					$count = 0;
						foreach($people as $person) {
							$count++;
							$email     = get_post_meta($person->ID, 'person_email', True);
						?>
							<tr>
								<td class="name">
									<a href="<?=get_permalink($person->ID)?>"><?=Person::get_name($person)?></a>
								</td>
								<td class="job_title">
									<?=get_post_meta($person->ID, 'person_jobtitle', True)?>
								</td> 
								<td class="phones">
										<ul>
											<? foreach(Person::get_phones($person) as $phone) {
												  ?>
												<li><?=$phone?></li>
											<?php } ?>
										</ul>
								</td>
								<td class="email">
									<?=(($email != '') ? '<a href="mailto:'.$email.'">'.$email.'</a>' : '') ?>
								</td>
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