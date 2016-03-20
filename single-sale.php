<?php
/*
Template Name: single vente Template
*/
    global $prefix;
?>
<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
	<!-- Section: slider -->
	<section class="row">	

		<div class="col-md-8">
				
			<ul class="nav nav-tabs">
		    	<li class="active"><a href="#photos" data-toggle="tab"><i class="icon-camera"></i><?php _e('Photos', 'roots-immo'); ?></a></li>
			</ul>
				
			<div class="tab-content">
				<div class="tab-pane active" id="photos">

				<?php 
                 if (has_gallery()) {
                     get_template_part('templates/post-slider');
                 } elseif (has_post_thumbnail()) {
                     $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                     ?>
						<a id="fancybox-manual-c" class="fancybox" href="<?php echo $large_image_url[0];
                     ?>">
							<?php the_post_thumbnail('single-item', ['class' => 'img-preview scale-with-grid']);
                     ?>
						</a>
					<?php

                 } else {
                     ?>
					<div class="svg-container">
						<object type="image/svg+xml" data="<?php bloginfo('template_directory');
                     ?>/assets/img/begip-agence-immobiliere.svg" width="100%" height="100%" class="svg-content">
						</object>
					</div>
					<?php

                 }
                ?>

				</div>

			   	<?php if (has_Map()): ?>
			  	<div class="tab-pane" id="map">
			  		<?php 
                        $mapAdresse = rwmb_meta($prefix.'_address');
                        $mapPoint = rwmb_meta($prefix.'_location');

                        if (!empty($mapAdresse)) :
                    ?>

						<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="//maps.google.com/maps?f=q&amp;source=s_q&amp;hl=es-419&amp;geocode=&amp;q=<?php echo $mapAdresse; ?>&amp;aq=3&amp;sll=<?php echo $mapPoint; ?>&amp;ie=UTF8&amp;t=m&amp;ll=<?php echo $mapPoint; ?>amp;z=13&amp;output=embed"></iframe>

					<?php endif; ?>
				</div>	
				<?php endif; ?>

			</div>
			
		</div>

		<div class="col-md-4">
			<?php get_template_part('templates/request-mail'); ?>			
		</div>

	</section>
	<!-- /section: search form -->

	<!-- Section: Property tabs -->
	<section class="row">

			<ul class="nav nav-tabs">
		    	<li class="active"><a href="#description" data-toggle="tab"><?php _e('Summary ', 'roots-immo'); ?></a></li>
		    	<li><a href="#share-on-fb" data-toggle="tab"><?php _e('Share on facebook', 'roots-immo'); ?></a></li>
		    	<li><a href="#send-to-friend" data-toggle="tab"><?php _e('Send to a friend', 'roots-immo'); ?></a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">			
				<div class="tab-pane active" id="description">
					<?php get_template_part('templates/details-sale'); ?>
				</div>
					
				<div class="tab-pane" id="share-on-fb">
					<?php get_template_part('templates/send-to-facebook'); ?>
				</div>

				<div class="tab-pane" id="send-to-friend">
					<?php get_template_part('templates/send-mail-friend'); ?>
				</div>
			</div>

	</section>
	<!-- /section: tagline -->

	<?php get_template_part('templates/featured'); ?>

</article>

<?php endwhile; ?>