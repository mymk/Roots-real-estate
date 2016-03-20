<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php wp_link_pages(['before' => '<nav class="pagination">', 'after' => '</nav>']); ?>
<?php endwhile; ?>