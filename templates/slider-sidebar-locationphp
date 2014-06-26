<div class="shadded boxed slider">

	<h4 class="remove-top add-bottom">
		<?php _e('Rent you may like', 'roots-immo'); ?>
	</h4>

	<ul class="bx-slider-points">
	<?php 
	global $prefix, $currency;
	$args = array( 
		'post_type' => 'rent',
		'posts_per_page' => 5,
		'offset'=> 1,
		);

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );

	$rent = rwmb_meta( $prefix . '_loyer' );
	$charge = rwmb_meta( $prefix.'_charges' );
		$rent_ci = $rent + $charge;

	 ?>
		<li>
			<?php 

			if(has_post_thumbnail( )){
				the_post_thumbnail( 'featured-item', array('class' => 'img-preview scale-with-grid'));
			} else {
				?>
				<img src="<?php bloginfo('template_directory' ); ?>/assets/img/begip-agence-immobiliere.svg" class="scale-with-grid" alt="">
				<?php
			}
			
			?>
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<p class="price"><span><?php echo $rent.$currency; ?></span></p>
		</li>
	<?php endforeach; 
	wp_reset_postdata();?>

	</ul>

</div>
<!-- /boxed mini slider -->