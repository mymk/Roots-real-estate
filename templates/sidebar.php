<?php dynamic_sidebar('sidebar-primary'); ?>
<!-- follow us -->
<div class="follow">
  
  <h6 class="half-bottom"><span><?php _e('Follow us', 'roots-immo'); ?></span></h6>
  
  <ul class="menu social">
    <li><a href="<?php echo of_get_option( 'facebook_url', '#' ); ?>"><i class="glyphicon glyphicon-facebook"></i></a></li>
    <li><a href="<?php echo of_get_option( 'googleplus_url', '#' ); ?>"><i class="glyphicon glyphicon-gplus-1"></i></a></li>
    <li><a href="<?php echo of_get_option( 'twitter_url', '#' ); ?>"><i class="glyphicon glyphicon-twitter"></i></a></li>
    <li><a href="<?php echo of_get_option( 'linkedin_url', '#' ); ?>"><i class="glyphicon glyphicon-linkedin"></i></a></li>
  </ul>

</div>
<!-- /.follow -->

<?php 
	if($sale) {
		get_template_part('templates/slider-sidebar-sale');
	} else {
		get_template_part('templates/slider-sidebar-rent');
	}
?>

<?php get_search_form(); ?>

