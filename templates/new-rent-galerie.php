<!-- Section: new development -->

<section class="row new-posts">
	<h2 class="col-sm-12"><?php _e('New rent', 'roots-immo'); ?></h2>
	<?php
	global $prefix, $currency;

	$args = array( 
		'post_type' => 'rent',
		'posts_per_page' => 8,
		'post_status' => 'publish'
		);

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );
		$rent = rwmb_meta( $prefix . '_loyer' );
		$charge = rwmb_meta( $prefix.'_charges' );
		$rent_ci = $rent + $charge;
		$rooms = rwmb_meta( $prefix . '_nb_chambres' );
		$baths = rwmb_meta( $prefix . '_nb_sdb' );
	?>

	<div class="item col-sm-6 col-md-3">
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


	<?php endforeach; 
	wp_reset_postdata();?>
</section>
<!-- /section: new development -->