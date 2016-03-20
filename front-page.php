<!-- Section: Office -->
<section class="row">

	<div class="col-md-8">
		<?php get_template_part('templates/home-slider'); ?>
	</div>

	<div class="col-md-4">

		<?php get_template_part('templates/searchform'); ?>

	</div>

</section>
<!-- /section: Office -->

		
<?php get_template_part('templates/new-rent-galerie'); ?>

<section class="row">
	<figure class="col-sm-12 advertising add-bottom ">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/advertise.png" width="1170" height="350" class="scale-with-grid" alt="Advertise here">
	</figure>
</section>


<?php get_template_part('templates/module-social-page'); ?>

<?php get_template_part('templates/featured'); ?>

<?php //get_template_part('templates/propriete-recente');?>

<?php get_template_part('templates/partenaires'); ?>