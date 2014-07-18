<!-- Section: new development -->

<section class="items row">
	<h2 class="col-sm-12"><?php _e('New rent', 'roots-immo'); ?></h2>
	<?php
	$new_rent = get_transient( 'new_rent' );
	if ( false === $new_rent ) {
	 
		// Show the last 20 rent from the custom post type rent.
		$query = array('post_per_page' => 20,
		             'post_type' => 'rent',
		             'post_status' => 'publish' ) ;

		$new_rent = new WP_Query($query);

		// transient set to last for 1 hour
		set_transient('new_rent', $new_rent, 60*60);
	}
	// do normal new_rent stuff
	global $prefix, $currency;
	if ($new_rent->have_posts()) : while ($new_rent->have_posts()) : $new_rent->the_post();

	$rent = rwmb_meta( $prefix . '_loyer' );
	$charge = rwmb_meta( $prefix.'_charges' );
	$rent_ci = $rent + $charge;
	$rooms = rwmb_meta( $prefix . '_nb_chambres' );
	$baths = rwmb_meta( $prefix . '_nb_sdb' );
	?>
	<div class="item col-sm-6 col-md-3 add-bottom">
		<div class="thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php get_the_main_image('single-item'); ?>
			</a>
		</div>

		<div class="caption">
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

			<?php the_excerpt(); ?>

			<ul>
				<li><?php _e('Rooms', 'roots-immo'); ?>: <span><?php echo $rooms; ?></span></li>
				<li><?php _e('Bathrooms', 'roots-immo'); ?>: <span><?php echo $baths; ?></span></li>
			</ul>

			<p class="price"><?php _e('Price: ', 'roots-immo'); ?><span><?php echo $rent_ci.$currency ;?><?php _e('/Month', 'roots-immo'); ?></span></p>
		</div>
	</div>
 <?php
endwhile;endif; ?>
</section>
<!-- /section: new development -->