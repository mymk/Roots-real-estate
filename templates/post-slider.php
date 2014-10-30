<?php
  global $post;

  $thumbnail_ID = get_post_thumbnail_id();

  $images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

  if ($images) :
  	$nb_images = count($images);
?>
    <div id="post-slider" class="post-slider carousel slide">

		<ol class="carousel-indicators">
			<?php for($i = 0; $i <= $nb_images-1; $i++) : ?>
				<li data-target="#post-slider" data-slide-to="<?php echo $i; ?>" class="<?php if($i == 0) echo 'active'; ?>"></li>
			<?php endfor; ?>
		</ol>

      <div class="carousel-inner">
      <?php 
		$first = true;

		foreach ($images as $attachment_id => $image) :
			$active = ($first ? 'active' : '');

			$large_image_big_array = image_downsize( $image->ID, 'full' );

			$large_image_img_url = $large_image_big_array[0];

			$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true); //alt

			if ($img_alt == '') $img_alt = $image->post_title;

			$big_array = image_downsize( $image->ID, 'single-item' );

			$img_url = $big_array[0];
	
 			
		?>
        <div class="item <?php if($first) echo 'active';?>">
        	<a href="<?php echo $large_image_img_url; ?>" class="fancybox" rel="gallery1">

        		<img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt ?>" class="img-responsive"/>

        	</a>
        </div>

    <?php
		$first = false; 
    	endforeach;
    ?>

	</div>
 	</div>
<?php endif; ?>