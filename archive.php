<?php
global $post;
global $prefix;
global $types_array;

$meta_query = null;

$post_type = get_post_type();

if (is_post_type_archive('rent')) {
    unset($types_array['value17']); //remove "Land" type
}

$archive_url = get_post_type_archive_link($post_type);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => $post_type,
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => 9,
    'meta_key' => $prefix . '_rent',
    'order_by' => 'meta_value_num',
    'order' => 'ASC'
);

if (isset($_GET['t'])) {
    $key_id = $prefix . '_type';

    $key_value = $_GET['t'];
}

if (isset($_GET['lp'])) {
    $key_id = $prefix . '_low_price';

    $key_value = $_GET['lp'];
}

if ($key_id) {
    $meta_query = array(
        array(
            'key' => $key_id,
            'value' => $key_value,
            'compare' => '=',
            'type' => 'string'
        )
    );
}

if (is_array($meta_query)) $args = array_merge($args, array('meta_query' => $meta_query));

$custom_query = new WP_Query($args);
?>

    <h2><?php echo roots_title(); ?></h2>

    <!-- filters -->
    <div class="add-bottom clearfix">

        <div class="btn-group pull-left">
            <div class="btn-group">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    Type
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $archive_url; ?>">Tous</a>
                    </li>
                    <?php
                    foreach ($types_array as $key => $type):
                        $url = $archive_url . '?t=' . $key;
                        ?>
                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                   href="<?php echo $url; ?>"><?php echo $type; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <a class="btn btn-default" href="<?php echo $archive_url; ?>?lp=1">Low price</a>
        </div>

        <div class="layout btn-group pull-right">
            <button class="grid btn btn-default btn-sm active">
                <span class="glyphicon glyphicon-th"></span>Grid
            </button>
            <button class="list btn btn-default btn-sm">
                <span class="glyphicon glyphicon-th-list"></span>List
            </button>
        </div>
    </div>

    <div id="items" class="items row">
        <?php
        if ($custom_query->have_posts()):
            while ($custom_query->have_posts()): $custom_query->the_post();

                get_template_part('templates/preview');

            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

<?php pagination('', 3, $custom_query); ?>