<?php get_template_part('templates/page', 'header'); ?>
<section class="eleven columns">
<?php   
      // get all gets   
      foreach($_GET as $name=>$value) {
        $search_get[$name] = $value;
      }

      $post_type = 'any';
      if(isset($search_get['post_type'])) $post_type = $search_get['post_type'];

      global $wp_query;
      global $prefix;
      $s_false = false;

      // check baths custom fields  
      if(isset($_GET['type_select']) && $_GET['type_select'] != '0')
      $meta_query_type = array(
          'key' => $prefix.'_type',
          'value' => $_GET['type_select'],
          'compare' => '=',
          'type' => 'string'
      );

      // if(isset($_GET['heating_select']) && $_GET['heating_select'] != '0')
      // $meta_query_heating = array(
      //     'key' => $prefix.'_heating',
      //     'value' => $_GET['heating_select'],
      //     'compare' => '=',
      //     'type' => 'string'
      // );    
        
      // check price custom fields  
      if(isset($_GET['max_price']) && $_GET['max_price'] != '0')
      $meta_query_price_in = array(
        'key' => $prefix.'_loyer',
        'value' => intval($_GET['max_price']),
        'compare' => '<=',
        'type' => 'NUMERIC'
      );

      // build meta query
      $meta_query = array(
        'relation' => 'AND'
      );
      
      if(!empty($meta_query_type))
        array_push($meta_query, $meta_query_type);
      if(!empty($meta_query_heating))
        array_push($meta_query, $meta_query_heating);
      if(!empty($meta_query_price_in))
        array_push($meta_query, $meta_query_price_in); 

      if(!empty($search_get)) :
        
        $args = array(
          'post_type' => $post_type,
          's' => $search_get['s'],
          'paged' => get_query_var('paged'),
          'meta_key' => $prefix.'_loyer',
          'orderby' => 'meta_value_num',
          'order' => 'ASC'
        );

        
        // add meta query
        if(!empty($meta_query))
          $args = array_merge($args, array('meta_query' => $meta_query));

        /* debuging query */
        // echo '<pre>';
        // var_dump($args);
        // echo '</pre>';    

        
        // query_posts($args);

        $custom_query = new WP_Query($args);
        
        if($s_false) :
          $wp_query->is_home = false;
          $wp_query->is_search = true;
        endif;
        
      endif;
      
    ?>
<?php if ( $custom_query->have_posts() ) : ?>

  <!-- pagination here -->

  <!-- the loop -->
  <ul id="property-list" class="list-grid-gallery list">
  <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
    <?php get_template_part('templates/preview');  ?>
  <?php endwhile; ?>
  </ul>
  <!-- end of the loop -->

  <!-- pagination here -->

  <?php wp_reset_postdata(); ?>

  <?php else:  ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'roots-immo'); ?>
    </div>  
  <?php endif; ?>

  <?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="post-nav">
      <ul class="pager">
        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots-immo')); ?></li>
        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots-immo')); ?></li>
      </ul>
    </nav>
  <?php endif; ?>
</section>