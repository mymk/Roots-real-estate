

	<!-- Section: Office -->
	<section class="row add-bottom row dark">

		<div class="col-md-8 point-slider main-slider">
			<?php get_template_part('templates/home-slider'); ?>
		</div>

		<div class="col-md-4 alpha omega gray">

			<?php get_template_part('templates/searchform'); ?>

		</div>

	</section>
	<!-- /section: Office -->

			
	<?php get_template_part('templates/new-rent-galerie'); ?>

	<div class="row">
		<figure class="col-sm-12 advertising add-bottom ">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/advertise.png" width="940" height="350" class="scale-with-grid" alt="Advertise here">
		</figure>
	</div>


	<?php get_template_part('templates/module-social-page'); ?>

	<?php get_template_part('templates/featured'); ?>

	<?php //get_template_part('templates/propriete-recente'); ?>

	<?php get_template_part('templates/partenaires'); ?>

