

<?php if (!have_posts()) : ?>
<section class="row add-bottom">
	<div class="sixteen columns">
		<div class="alert alert-warning">
	    	<?php _e('Sorry, no results were found.', 'roots-immo'); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>
