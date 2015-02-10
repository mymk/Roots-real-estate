<?php
global $prefix;
global $currency;
global $surface_unit;

$rent = rwmb_meta($prefix . '_rent');

$charge = rwmb_meta($prefix . '_service_charge');

$rent_ci = $rent + $charge;

$fees = rwmb_meta($prefix . '_fee');

$surface = rwmb_meta($prefix . '_surface');

$total_surface = rwmb_meta($prefix . '_total_surface');

$availability = rwmb_meta($prefix . '_disponibility');

$availability_format = date('d/m/Y', strtotime($availability));

$sector = rwmb_meta($prefix . '_area');

$type = get_type(rwmb_meta($prefix . '_type'));

$heating = get_heating();

$floor = get_floor();

$rooms = rwmb_meta($prefix . '_rooms');

$baths = rwmb_meta($prefix . '_bathrooms');

$near = rwmb_meta($prefix . '_nearby');

$consumption = get_consumption();

$emission = get_emission();
?>
<div class="col-md-8">

    <h4><?php _e('Summary ', 'roots-immo'); ?></h4>

    <?php the_content(); ?>

    <div class="details-overview clearfix">
        <?php echo $type; ?> | <?php _e('Sector ', 'roots-immo'); ?> : <?php echo $sector; ?>

        <ul class="arrow">
            <li><?php _e('Rent ', 'roots-immo'); ?> : <?php echo $rent . $currency; ?></li>
            <li><?php _e('Load ', 'roots-immo'); ?> : <?php echo $charge . $currency; ?></li>
            <li><?php _e('Rent + load ', 'roots-immo'); ?> : <?php echo $rent_ci . $currency; ?></li>
            <li><?php _e('Fees ', 'roots-immo'); ?> : <?php echo $fees . $currency; ?></li>
            <li><?php _e('Surface ', 'roots-immo'); ?> : <?php echo $surface . $surface_unit; ?></li>
            <li><?php _e('Total surface ', 'roots-immo'); ?> : <?php echo $total_surface . $surface_unit; ?></li>
            <li><?php _e('Floor ', 'roots-immo'); ?> : <?php echo $floor; ?> </li>

            <?php if (!empty($rooms)): ?>
                <li><?php _e('Rooms ', 'roots-immo'); ?> : <?php echo $rooms; ?> </li>
            <?php endif; ?>

            <?php if (!empty($baths)): ?>
                <li><?php _e('Baths ', 'roots-immo'); ?> : <?php echo $baths; ?> </li>
            <?php endif; ?>

            <li><?php _e('Heating ', 'roots-immo'); ?> : <?php echo $heating; ?> </li>

        </ul>

        <?php if (!empty($near)): ?>
            <p><?php _e('A proximité de: ', 'roots-immo'); ?><?php echo $near; ?></p>
        <?php endif; ?>

        <p>
            <?php echo (!is_element_empty($availability)) ? _e('Availability ', 'roots-immo') . ' : ' . $availability_format : '' ?>
        </p>

    </div>


</div>

<div class="col-md-4">
    <h4><?php _e('Energy consumption ', 'roots-immo'); ?><?php echo $consumption; ?></h4>
    <?php if ($consumption != '') { ?>
        <div class="progressbar consommation">
            <div class="progress-label <?php echo $consumption; ?> animated slideInLeft"></div>
        </div>
    <?php } else { ?>
        <p><?php _e('blank', 'roots-immo'); ?></p>
    <?php } ?>

    <h4><?php _e('Greenhouse gas emission in kWh/m²/year', 'roots-immo'); ?> <?php echo $emission; ?></h4>
    <?php if ($emission != '') { ?>
        <div class="progressbar emission ">
            <div class="progress-label <?php echo $emission; ?> animated slideInLeft"></div>
        </div>
    <?php } else { ?>
        <p><?php _e('blank', 'roots-immo'); ?></p>
    <?php } ?>


</div>
