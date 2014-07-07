<?php
	global $prefix;

	$sale = false;

	if(is_post_type_archive('rent')) {
		$post_type = 'rent';
	}
	else if(is_post_type_archive('sale')) {
		$sale = true;
		$post_type = 'sale';
	}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$meta_query = array(
		'key' => $prefix.'_type',
		'value' => $_GET['t'],
		'compare' => '=',
		'type' => 'string'	
	);

	$args = array(
		'post_type' => $post_type,
		'post_status' => 'publish',
		'paged' => $paged,
		'posts_per_page' => 9,
		'meta_key' => $prefix.'_loyer',
		'order_by' => 'meta_value_num',
		'order' => 'ASC'
	);

	if(!empty($meta_query)) $args = array_merge($args, array('meta_query' => $meta_query));

	$custom_query = new WP_Query($args);
?>
		
<h2 class="remove-top"><?php echo roots_title(); ?></h2>

<!-- filters -->
<div class="add-bottom clearfix">
	
	<!-- tag filters -->
	<div class="btn-group">
		<a href="<?php the_permalink(); ?>" class="btn btn-default btn-sm active"data-rel="all" ><?php _e('All', 'roots-immo'); ?></a>
		<a href="<?php the_permalink(); ?>?t=studio" class="btn btn-default btn-sm" data-rel="studio"><?php _e('Studio', 'roots-immo'); ?></a>
		<a href="<?php the_permalink(); ?>?t=appartement" class="btn btn-default btn-sm" data-rel="appartement"><?php _e('Appartement', 'roots-immo'); ?></a>
		<a href="<?php the_permalink(); ?>?t=maison" class="btn btn-default btn-sm" data-rel="maison"><?php _e('House', 'roots-immo'); ?></a>
		<?php if($sale): ?>
		<a href="<?php the_permalink(); ?>?t=terrain" class="btn btn-default btn-sm" data-rel="terrain"><?php _e('Land', 'roots-immo'); ?></a>
		<?php else: ?>
		<a href="<?php the_permalink(); ?>?t=low_price" class="btn btn-default btn-sm" data-rel="low-price"><?php _e('Low price', 'roots-immo'); ?></a>
		<?php endif;?>
	</div>

    <div class="btn-group pull-right">
        <button href="#" id="list" class="btn btn-default btn-sm">
        	<span class="glyphicon glyphicon-th-list"></span>List
        </button>
        <button href="#" id="grid" class="btn btn-default btn-sm">
        	<span class="glyphicon glyphicon-th"></span>Grid
        </button>
    </div>

</div>

<div id="items" class="items row">
	<?php
		if($custom_query->have_posts()):				
			while ($custom_query->have_posts()): $custom_query->the_post();

				get_template_part('templates/preview');

			endwhile;
			wp_reset_postdata();
		endif;
	?>
</div>

<?php pagination(); ?>
