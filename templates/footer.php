<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>

<?php wp_footer(); ?>
<?php echo of_get_option( 'google_analytics', '<--! no google analytics-->' ); ?>