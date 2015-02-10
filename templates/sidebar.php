<?php dynamic_sidebar('sidebar-primary'); ?>
<!-- follow us -->
<div class="follow add-bottom">

    <h4 class="half-bottom"><span><?php _e('Follow us', 'roots-immo'); ?></span></h4>

    <ul class="menu social nav nav-pills nav-justified">
        <li><a href="<?php echo of_get_option('facebook_url', '#'); ?>"><i class="fa fa-facebook"></i></a></li>
        <li><a href="<?php echo of_get_option('googleplus_url', '#'); ?>"><i class="fa fa-google"></i></a></li>
        <li><a href="<?php echo of_get_option('twitter_url', '#'); ?>"><i class="fa fa-twitter"></i></a></li>
        <li><a href="<?php echo of_get_option('linkedin_url', '#'); ?>"><i class="fa fa-linkedin"></i></a></li>
    </ul>

</div>
<!-- /.follow -->

<?php
if ($sale) {
    get_template_part('templates/slider-sidebar-sale');
} else {
    get_template_part('templates/slider-sidebar-rent');
}
?>

<?php get_search_form(); ?>

