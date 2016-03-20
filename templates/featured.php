<?php 
    global $prefix, $currency;

    $args = [
        'post_type'      => 'rent',
        'posts_per_page' => -1,
        'meta_key'       => $prefix.'_featured',
        'meta_value'     => '1',
    ];

    $myposts = get_posts($args);

    $pages = ceil(count($myposts) / 4);

    $offset = 0;
?>

<!-- Section: carousel -->
<section class="row">
	
	<h2 class="col-sm-12"><?php _e('Best rent: ', 'roots-immo'); ?></h2>


	<div class="col-md-12">
		<div id="Carousel" class="featured carousel slide">

			<ol class="carousel-indicators">
				<?php for ($i = 1; $i <= $pages; $i++): ?>
				<li data-target="#Carousel" data-slide-to="<?php echo $i - 1; ?>" <?php if ($i === 1) {
    echo 'class="active"';
} ?>></li>
				<?php endfor; ?>
            </ol>

			<div class="carousel-inner">
				<?php for ($i = 1; $i <= $pages; $i++): ?>
 					<div class="item <?php if ($i === 1) {
    echo 'active';
} ?>">
						<div class="row">
						<?php	
                            $new_args = [
                                'post_type'      => 'rent',
                                'posts_per_page' => 4,
                                'offset'         => $offset,
                                'meta_key'       => $prefix.'_featured',
                                'meta_value'     => '1',
                            ];

                            $items = get_posts($new_args);

                            foreach ($items as $post) : setup_postdata($post);
                                $rent = rwmb_meta($prefix.'_rent');
                                $type = get_type(rwmb_meta($prefix.'_type'));
                            ?>
							<div class="col-md-3">
								<a class="thumbnail" href="<?php the_permalink(); ?>">
									<?php get_the_main_image('best-item'); ?>
								</a>
								<div>
									<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
									<p class="text"> <?php echo $type; ?> | <span> <?php echo $rent.$currency; ?><?php _e('/Month', 'roots-immo'); ?></span></p>
								</div>
							</div>
						<?php 
                            endforeach;
                            wp_reset_postdata();

                            $offset = $offset + 4;
                        ?>
						</div>
					</div>
				<?php endfor; ?>
			</div> <!-- /carousel-inner -->

			<a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
			<a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
		</div><!-- /carousel -->
	</div>

	
</section>