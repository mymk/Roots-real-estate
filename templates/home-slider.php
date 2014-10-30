<?php
  global $prefix;
  global $logo_url;

  $args = array( 
    'post_type' => 'rent',
    'posts_per_page' => $nb_posts,
    'meta_key' => $prefix . '_featured',
    'meta_value' => '1',
    'post_status' => 'publish',
  ); 

  $myposts = get_posts($args);


?>

<div id="home-slider" class="home-slider carousel slide">

  <ol class="carousel-indicators">
    <?php foreach($myposts as $key => $post): ?>
      <li data-target="#home-slider" data-slide-to="<?php echo $key; ?>" <?php if($key == 0) echo 'class="active"'; ?>></li>
    <?php endforeach; ?>
  </ol>

  <div class="carousel-inner">
        <?php
          $first = true;        
          foreach($myposts as $post): setup_postdata($post);
        ?>
          <div class="item <?php if($first) echo 'active'; ?>">
            <a class="thumbnail" href="<?php the_permalink(); ?>">
            <?php 
              get_the_main_image('single-item');
            ?>
            </a>
            <div>
              <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
              <p><?php the_excerpt();?></p>
            </div>
          </div>
        <?php
          $first = false;                 
          endforeach;
          wp_reset_postdata();
        ?>
  </div> <!-- /carousel-inner -->

 <a class="left carousel-control" href="#home-slider" data-slide="prev">‹</a>
 <a class="right carousel-control" href="#home-slider" data-slide="next">›</a>
</div><!-- #home-slider -->