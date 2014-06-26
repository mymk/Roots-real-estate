<?php 
    global $prefix;
    global $currency;
    global $surface_unit;

    $rent = rwmb_meta( $prefix . '_loyer' );

    $fees = rwmb_meta( $prefix . '_honoraires' );

    $surface = rwmb_meta( $prefix.'_surface' );
    $total_surface = rwmb_meta( $prefix.'_total_surface' );

    $sector = rwmb_meta( $prefix . '_secteur' );

    $type = get_type(rwmb_meta( $prefix . '_type' ));

    $floor = get_floor();

    $heating = get_heating();

    $rooms = rwmb_meta( $prefix . '_nb_chambres' );

    $baths = rwmb_meta( $prefix . '_nb_sdb' );

    $consumption = get_consumption();

    $emission = get_emission();
?>
<div class="seven columns">
                    
                    <h4><?php _e('Summary ', 'roots-immo'); ?></h4>

                    <?php the_content( );?>

                    <div class="details-overview clearfix">
                        <?php echo $type; ?> | <?php _e('Sector ', 'roots-immo'); ?> : <?php echo $sector; ?>
                    <ul class="arrow">
                        <li><?php _e('Price ', 'roots-immo'); ?> : <?php echo $rent.$currency ; ?></li>
                        <li><?php _e('Fees ', 'roots-immo'); ?> : <?php echo $fees.$currency; ?></li>
                        <li><?php _e('Surface ', 'roots-immo'); ?> : <?php echo $surface.$surface_unit ; ?></li>
                        <li><?php _e('Total surface ', 'roots-immo'); ?> : <?php echo $total_surface.$surface_unit ; ?></li>
                        <li><?php _e('Floor ', 'roots-immo'); ?> : <?php echo $floor; ?> </li>
                        
                        <?php if(!empty($rooms)): ?><li><?php _e('Rooms ', 'roots-immo'); ?> : <?php echo $rooms; ?> </li><?php endif; ?>
                        <?php if(!empty($baths)): ?><li><?php _e('Baths ', 'roots-immo'); ?> : <?php echo $baths; ?> </li><?php endif; ?>
                        
                        <li><?php _e('Heating ', 'roots-immo'); ?> : <?php echo $heating; ?> </li>
                    </ul>
                    </div>

                    
                </div>

                <div class="six columns push by-two">

                    <h4><?php _e('Energy consumption ', 'roots-immo'); ?> <?php echo $consumption; ?></h4>

                    <div class="progressbar consommation">
                       
                        <div class="progress-label <?php echo $consumption; ?> animated slideInLeft"></div>
                    </div>
                        

                    <h4><?php _e('Greenhouse gas emission in kWh/m²/year', 'roots-immo'); ?> <?php echo $emission; ?></h4>
                    <div class="progressbar emission ">
                        <div class="progress-label <?php echo $emission; ?> animated slideInLeft"></div>
                    </div>

                </div>
