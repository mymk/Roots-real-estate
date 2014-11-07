<?php
	$nb_posts = 5;

	global $prefix, $currency;
	$args = array( 
		'post_type' => 'rent',
		'posts_per_page' => $nb_posts,
		'offset'=> 1,
	);

	$first = true;

	$myposts = get_posts( $args );
?>

<div id="sidebar-slider" class="sidebar-slider carousel slide">

	<h4 class="remove-top add-bottom">
		<?php _e('Rent you may like', 'roots-immo'); ?>
	</h4>

	<ol class="carousel-indicators">
		<?php for($i = 0; $i <= $nb_posts-1; $i++): ?>
			<li data-target="#sidebar-slider" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) echo 'class="active"'; ?>></li>
		<?php endfor; ?>
	</ol>


	<div class="carousel-inner">
		<?php
			foreach ( $myposts as $post ) : setup_postdata( $post );

				$rent = rwmb_meta( $prefix . '_rent' );
		?>
			<div class="item <?php if($first) echo 'active'; ?>">
				<a href="<?php the_permalink(); ?>">
					<?php get_the_main_image('single-item'); ?>
				</a>
				<div>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p class="price"><span><?php echo $rent.$currency; ?></span></p>
				</div>
			</div>
		<?php
			$first = false;
			endforeach; 
			wp_reset_postdata();
		?>
	</div>

</div>