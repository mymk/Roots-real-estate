<?php
  global $prefix;

  $nb_posts = 5;

  $args = array( 
    'post_type' => 'rent',
    'posts_per_page' => $nb_posts,
    'meta_key' => $prefix . '_featured',
    'meta_value' => '1'
  ); 

  $myposts = get_posts($args);

  $first = true;
?>

<div id="home-slider" class="home-slider carousel slide">

  <ol class="carousel-indicators">
    <?php for($i = 0; $i <= $nb_posts; $i++): ?>
      <li data-target="#home-slider" data-slide-to="<?php echo $i; ?>" <?php if($i === 0) echo 'class="active"'; ?>></li>
    <?php endfor; ?>
  </ol>

  <div class="carousel-inner">
        <?php 
          foreach($myposts as $post): setup_postdata($post);

        ?>
          <div class="item <?php if($first) echo 'active'; ?>">
            <a class="thumbnail" href="<?php the_permalink(); ?>">
            <?php 
              if(has_post_thumbnail()){
                the_post_thumbnail( 'full');
              } else {
                ?>
                <img src="<?php bloginfo('template_directory' ); ?>/assets/img/begip-agence-immobiliere.svg" class="scale-with-grid" alt="">
                <?php
              }
            ?>
            </a>
            <div class="carousel-caption">
              <h4><?php the_title();?></h4>
              <p><?php the_excerpt();?></p>
              <?php the_permalink(); ?>
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