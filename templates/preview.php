<?php
	global $prefix;
	global $currency;

	$rent = rwmb_meta( $prefix . '_loyer' );
	$charge = rwmb_meta( $prefix.'_charges' );

	$rent_ci = $rent + $charge;
		
    $surface = rwmb_meta( $prefix.'_surface' );
    $rooms = rwmb_meta( $prefix . '_nb_chambres' );

    $heating = get_heating();

    $baths = rwmb_meta( $prefix . '_nb_sdb' );

    $type = get_type(rwmb_meta( $prefix . '_type' ));

    $class = get_main_type($type);

    if(is_low_price()) {
    	$class.='low-price';
    }


    $details = '';
    
    if($class == 'appartement' || $class == 'maison') {
    	$details = $rooms.' chambres / '.$baths.' salles de bain / ';
    }

    $details .= $surface.'m²';

?>
<div class="item <?php echo $class; ?> col-xs-4 col-lg-4 add-bottom">
    <div class="thumbnail">
        <a href="<?php the_permalink(); ?>"><?php get_the_main_image('single-item'); ?></a>
    </div>        
    
    <div class="caption">
        <h4 class=""><?php the_title(); ?></h4>
        <p class="">
            Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
            sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
        <div class="row">
            <div class="col-xs-12">
                <p class="lead">
                    <?php 			
					$post_type = get_post_type();

					switch( $post_type )
					{
					    case 'rent':
					         // do code for task post type
					    	echo _e('Rent','roots-immo');
					    break;

					    case 'sale':
					         // do code for task post type
					    	echo _e('Sales','roots-immo');
					    break;
					} ?>
				</p>
				<ul>
					<li><?php echo $rent.$currency; ?></li>
					<li><?php echo $type; ?></li>
				</ul>
				<p class="propr-details"><?php echo $details; ?></p>
				<p class="prop-heat">Chauffage: <?php echo $heating; ?></p>
				
                <a class="btn btn-primary" href="<?php the_permalink(); ?>#map"><?php _e('Map', 'roots-immo'); ?></a>
            
                <a class="btn btn-primary" href="<?php the_permalink(); ?>"><?php _e('Summary', 'roots-immo'); ?></a>
            
            </div>
        </div>
    </div>
</div>