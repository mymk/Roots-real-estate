<!-- Section: new development -->

<div class="row">
	<h2 class="col-sm-12 section-titling"><?php _e('New rent', 'roots-immo'); ?></h2>
	<?php
	global $prefix, $currency;

	$args = array( 
		'post_type' => 'rent',
		'posts_per_page' => 8,
		'offset'=> 1,
		);

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );
		$rent = rwmb_meta( $prefix . '_loyer' );
		$charge = rwmb_meta( $prefix.'_charges' );
		$rent_ci = $rent + $charge;
		$rooms = rwmb_meta( $prefix . '_nb_chambres' );
		$baths = rwmb_meta( $prefix . '_nb_sdb' );
	?>

  <div class="col-sm-6 col-md-3">
    <div class="thumbnail">
      <?php get_the_main_image('single-item'); ?>
      <div class="caption">
        <h3><?php the_title(); ?></h3>
        <?php the_excerpt(); ?>
		<ul class="table-list">
			<li><?php _e('Rooms: ', 'roots-immo'); ?><span><?php echo $rooms; ?></span></li>
			<li><?php _e('Bath: ', 'roots-immo'); ?><span><?php echo $baths; ?></span></li>
		</ul>
        <p class="price"><?php _e('Price: ', 'roots-immo'); ?><span><?php echo $rent_ci.$currency ;?><?php _e('/Month', 'roots-immo'); ?></span></p>
        <p><a href="<?php the_permalink(); ?>" class="btn btn-primary" role="button"><?php the_title(); ?></a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>


	<?php endforeach; 
	wp_reset_postdata();?>
</div>
<!-- /section: new development -->