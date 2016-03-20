<?php get_template_part('templates/page', 'header'); ?>
<section class="row">
<?php 
      // get all gets
      foreach ($_GET as $name => $value) {
          $search_get[$name] = $value;
      }

      $post_type = 'any';
      if (isset($search_get['post_type'])) {
          $post_type = $search_get['post_type'];
      }

      global $wp_query;
      global $prefix;
      $s_false = false;

      // check baths custom fields
      if (isset($_GET['type_select']) && $_GET['type_select'] != '0') {
          $meta_query_type = [
          'key'     => $prefix.'_type',
          'value'   => $_GET['type_select'],
          'compare' => '=',
          'type'    => 'string',
      ];
      }

      // check price custom fields
      if (isset($_GET['max_price']) && $_GET['max_price'] != '0') {
          $meta_query_price_in = [
        'key'     => $prefix.'_rent',
        'value'   => intval($_GET['max_price']),
        'compare' => '<=',
        'type'    => 'NUMERIC',
      ];
      }

      // build meta query
      $meta_query = [
        'relation' => 'AND',
      ];

      if (!empty($meta_query_type)) {
          array_push($meta_query, $meta_query_type);
      }
      if (!empty($meta_query_price_in)) {
          array_push($meta_query, $meta_query_price_in);
      }

      if (!empty($search_get)) :

        $args = [
          'post_type'      => $post_type,
          's'              => $search_get['s'],
          'paged'          => get_query_var('paged'),
          'posts_per_page' => 9,
          'meta_key'       => $prefix.'_rent',
          'orderby'        => 'meta_value_num',
          'order'          => 'ASC',
        ];

        // add meta query
        if (!empty($meta_query)) {
            $args = array_merge($args, ['meta_query' => $meta_query]);
        }

        // query_posts($args);

        $custom_query = new WP_Query($args);

        if ($s_false) :
          $wp_query->is_home = false;
          $wp_query->is_search = true;
        endif;

      endif;

    ?>
<?php if ($custom_query->have_posts()) : ?>

  <!-- pagination here -->

  <!-- the loop -->
  <div class="items clearfix">
  <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
    <?php get_template_part('templates/preview'); ?>
  <?php endwhile; ?>
  </div>
  <!-- end of the loop -->

  <!-- pagination here -->

  <?php wp_reset_postdata(); ?>

  <?php else:  ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'roots-immo'); ?>
    </div>  
  <?php endif; ?>

  <?php if ($wp_query->max_num_pages > 1) : ?>
    <?php pagination(); ?>
  <?php endif; ?>
</section>