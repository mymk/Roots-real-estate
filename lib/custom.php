<?php

/*

* Custom functions

*/

/* allow rent in rest api*/
function allow_my_post_types($allowed_post_types)
{
    $allowed_post_types[] = 'rent';

    return $allowed_post_types;
}

add_filter('rest_api_allowed_post_types', 'allow_my_post_types');

function qt_custom_breadcrumbs()
{
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = ''; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<div class="btn btn-default active">'; // tag before the current crumb
  $after = '</div>'; // tag after the current crumb

  global $post;
    $homeLink = get_bloginfo('url');

    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) {
            echo '<div id="bc1" class="btn-group btn-breadcrumb col-sm-12">';
        }
    } else {
        echo '<div id="bc1" class="btn-group btn-breadcrumb col-sm-12"><a href="'.$homeLink.'" class="btn btn-default"><i class="fa fa-home"></i></a> '.$delimiter.' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                echo get_category_parents($thisCat->parent, true, ' '.$delimiter.' ');
            }
            echo $before.'Archive by category "'.single_cat_title('', false).'"'.$after;
        } elseif (is_search()) {
            echo $before.'Search results for "'.get_search_query().'"'.$after;
        } elseif (is_day()) {
            echo '<a href="'.get_year_link(get_the_time('Y')).'" class="btn btn-default">'.get_the_time('Y').'</a> '.$delimiter.' ';
            echo '<a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'" class="btn btn-default">'.get_the_time('F').'</a> '.$delimiter.' ';
            echo $before.get_the_time('d').$after;
        } elseif (is_month()) {
            echo '<a href="'.get_year_link(get_the_time('Y')).'" class="btn btn-default">'.get_the_time('Y').'</a> '.$delimiter.' ';
            echo $before.get_the_time('F').$after;
        } elseif (is_year()) {
            echo $before.get_the_time('Y').$after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="'.$homeLink.'/'.$slug['slug'].'/" class="btn btn-default">'.$post_type->labels->singular_name.'</a>';
                if ($showCurrent == 1) {
                    echo ' '.$delimiter.' '.$before.get_the_title().$after;
                }
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, ' '.$delimiter.' ');
                if ($showCurrent == 0) {
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", '$1', $cats);
                }
                echo $cats;
                if ($showCurrent == 1) {
                    echo '<a href="#" class="btn btn-default">'.$before.get_the_title().$after.'</a>';
                }
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before.$post_type->labels->singular_name.$after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, true, ' '.$delimiter.' ');
            echo '<a href="'.get_permalink($parent).'" class="btn btn-default">'.$parent->post_title.'</a>';
            if ($showCurrent == 1) {
                echo ' '.$delimiter.' '.$before.get_the_title().$after;
            }
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) {
                echo $before.get_the_title().$after;
            }
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = [];
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="'.get_permalink($page->ID).'" class="btn btn-default">'.get_the_title($page->ID).'</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1) {
                    echo ' '.$delimiter.' ';
                }
            }
            if ($showCurrent == 1) {
                echo ' '.$delimiter.' '.$before.get_the_title().$after;
            }
        } elseif (is_tag()) {
            echo $before.'Posts tagged "'.single_tag_title('', false).'"'.$after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before.'Articles posted by '.$userdata->display_name.$after;
        } elseif (is_404()) {
            echo $before.'Error 404'.$after;
        }

        if (get_query_var('paged')) {
            echo $before.__('Page').' '.get_query_var('paged').$after;
        }

        echo '</div>';
    }
} // end qt_custom_breadcrumbs()

function my_custom_login_logo()
{
    echo '<style type="text/css">

        h1 a { 

          background-image:url('.get_bloginfo('template_url').'/assets/img/begip-agence-immobiliere.svg) !important;

          background-size: 200px 100px !important;

          height: 100px !important;

          width: 200px !important;

          }

    </style>';
}
add_action('login_head', 'my_custom_login_logo');

function get_the_main_image($classe)
{
    global $post;
    global $logo_url;

    if (has_post_thumbnail()) {
        the_post_thumbnail($classe, ['class' => 'img-preview scale-with-grid']);
    } else {
        echo '<img src="'.$logo_url.'" class="scale-with-grid" alt="">';
    }
}

/* ajout d'un thumb specifique a l'admin */

add_action('after_setup_theme', 'my_theme_setup');

function my_theme_setup()
{
    add_image_size('edit-screen-thumbnail', 100, 100, true);
}

/* on definie les colonnes ci dessous comme triable */

add_filter('manage_edit-rent_sortable_columns', 'my_columns_filter_rent');

/* on rajoute des colonnes a rent */

add_filter('manage_edit-rent_columns', 'my_columns_filter_rent', 10, 1);

function my_columns_filter_rent($columns)
{
    $column_thumbnail = ['thumbnail' => 'Thumbnail'];

    $column_type = ['type' => 'Type'];

    $column_rent = ['loyer' => 'Loyer'];

    $column_surface = ['surface' => 'Surface'];

    $column_heat = ['heating' => 'Chauffage'];

  //$column_consumption = array( 'consumption' => 'Consommation énergétique');

  $column_number = ['id' => 'N° de porte'];

    $column_address = ['address' => 'N° d\'immeuble'];

    $columns = array_slice($columns, 0, 1, true) + $column_thumbnail + array_slice($columns, 1, null, true);

    $columns = array_slice($columns, 0, 3, true) + $column_type + array_slice($columns, 3, null, true);

    $columns = array_slice($columns, 0, 4, true) + $column_rent + array_slice($columns, 4, null, true);

    $columns = array_slice($columns, 0, 5, true) + $column_surface + array_slice($columns, 5, null, true);

    $columns = array_slice($columns, 0, 6, true) + $column_heat + array_slice($columns, 6, null, true);

 // $columns = array_slice( $columns, 0, 7, true ) + $column_consumption + array_slice( $columns, 7, NULL, true );

  $columns = array_slice($columns, 0, 8, true) + $column_number + array_slice($columns, 8, null, true);

    $columns = array_slice($columns, 0, 9, true) + $column_address + array_slice($columns, 9, null, true);

    return $columns;
}

/* on rajoute des colonnes a sale */

add_filter('manage_edit-sale_columns', 'my_columns_filter', 10, 1);

function my_columns_filter($columns)
{
    $column_thumbnail = ['thumbnail' => 'Thumbnail'];

    $column_type = ['type' => 'Type'];

    $column_rent = ['loyer' => 'Prix'];

    $column_surface = ['surface' => 'Surface'];

    $column_heat = ['heating' => 'Chauffage'];

    $column_consumption = ['consumption' => 'Consommation énergétique'];

    $columns = array_slice($columns, 0, 1, true) + $column_thumbnail + array_slice($columns, 1, null, true);

    $columns = array_slice($columns, 0, 3, true) + $column_type + array_slice($columns, 3, null, true);

    $columns = array_slice($columns, 0, 4, true) + $column_rent + array_slice($columns, 4, null, true);

    $columns = array_slice($columns, 0, 5, true) + $column_surface + array_slice($columns, 5, null, true);

    $columns = array_slice($columns, 0, 6, true) + $column_heat + array_slice($columns, 6, null, true);

    $columns = array_slice($columns, 0, 7, true) + $column_consumption + array_slice($columns, 7, null, true);

    return $columns;
}

/* on attribue le contenu aux colones */

add_action('manage_posts_custom_column', 'my_column_action', 10, 1);

function my_column_action($column)
{
    global $post;

    global $prefix;

    global $currency;

    global $surface_unit;

    switch ($column) {

    case 'thumbnail':

      echo get_the_post_thumbnail($post->ID, 'edit-screen-thumbnail');

      break;

    case 'loyer':

      echo rwmb_meta($prefix.'_rent').$currency;

      break;

    case 'heating':

      echo get_heating();

      break;

    case 'type':

      $key = rwmb_meta($prefix.'_type');

      echo get_type($key);

      break;

    case 'surface':

      echo rwmb_meta($prefix.'_surface').$surface_unit;

      break;

    case 'consumption':

      echo rwmb_meta($prefix.'_energy_consumption');

      break;

    case 'id':

      echo rwmb_meta($prefix.'_id');

      break;

    case 'address':

      echo rwmb_meta($prefix.'_address');

      break;

  }
}

add_filter('request', 'column_orderby');

function column_orderby($vars)
{
    global $prefix;

    if (!is_admin()) {
        return $vars;
    }

    if (isset($vars['orderby']) && 'address' == $vars['orderby']) {
        $vars = array_merge($vars, ['meta_key' => 'roots_immo_address', 'orderby' => 'meta_value']);
    } elseif (isset($vars['orderby']) && 'surface' == $vars['orderby']) {
        $vars = array_merge($vars, ['meta_key' => 'roots_immo_surface', 'orderby' => 'meta_value_num']);
    } elseif (isset($vars['orderby']) && 'id' == $vars['orderby']) {
        $vars = array_merge($vars, ['meta_key' => 'roots_immo_id', 'orderby' => 'meta_value_num']);
    }

    return $vars;
}

function get_gallery_thumb()
{
    global $post;

    $thumbnail_ID = get_post_thumbnail_id();

    $images = get_children(['post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID']);

    if ($images) :

    echo '<div id="bx-pager">';

    $i = 0;

    foreach ($images as $attachment_id => $image) :

      if ($image->ID != $thumbnail_ID) :

        $img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true); //alt

        if ($img_alt == '') : $img_alt = $image->post_title;
    endif;

    $big_array = image_downsize($image->ID, 'thumbnail');

    $img_url = $big_array[0];

    echo '<a data-slide-index="';

    echo $i;

    echo '" href="">';

    echo '<img src="';

    echo $img_url;

    echo '" alt="';

    echo $img_alt;

    echo '" class="img-preview scale-with-grid"/>';

    echo '</a>';

    $i++;

    endif;
    endforeach;

    echo '</div>';

    endif;
}

function has_gallery()
{
    global $post;

    $thumbnail_ID = get_post_thumbnail_id();

    $images = get_children(['post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID']);

    if (count($images) <= 1) {
        return false;
    } else {
        return true;
    }
}

/**

 * ts_get_option().

 * User generated function

 *

 * @param string $key
 */
function ts_get_option($key)
{
    global $ts_defaults;

    if (empty($ts_defaults) || !is_array($ts_defaults)) {
        return false;
    }

    $ts_options = get_option(TSO_OPTION_FRONTEND);

    foreach ($ts_defaults as $k => $v) {
        if (!isset($ts_options[$k])) {
            $ts_options[$k] = $ts_defaults[$k];
        }
    }

    if (isset($ts_options[$key])) {
        return $ts_options[$key];
    }
}

/*

 * Custom post types

 *

 * => Properties (for Sale)

 * => Properties (for Rent)

 * => Taxonomies (non-hierarchical): Locations, Property Types, Features

 * => Taxonomies (hierarchical): Categories (for Sale), Categories (for Rent)

 *

 */

/*

 * Register post types

 */

add_action('init', 'register_ts_post_types');

function register_ts_post_types()
{
    $labels = [

        'name' => __('Sales', 'roots-immo'),

        'singular_name' => __('Property (for Sale)', 'roots-immo'),

        'add_new' => __('Add New', 'roots-immo'),

        'add_new_item' => __('Add New Property', 'roots-immo'),

        'edit_item' => __('Edit Property', 'roots-immo'),

        'new_item' => __('New Property', 'roots-immo'),

        'view_item' => __('View Property', 'roots-immo'),

        'search_items' => __('Search Properties', 'roots-immo'),

        'not_found' => __('No properties found', 'roots-immo'),

        'not_found_in_trash' => __('No properties found in Trash', 'roots-immo'),

        'parent_item_colon' => __('Parent Property:', 'roots-immo'),

        'menu_name' => __('For Sale', 'roots-immo'),

    ];

    $args = [

        'labels' => $labels,

        'hierarchical' => false,

        'supports' => ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'revisions'],

        'public' => true,

        'show_ui' => true,

        'show_in_menu' => true,

        'menu_position' => 5,

        'menu_icon' => '',

        'show_in_nav_menus' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'has_archive' => true,

        'query_var' => true,

        'can_export' => true,

        'rewrite' => true,

        'capability_type' => 'post',

    ];

    register_post_type('sale', $args);

    $labels_2 = [

        'name' => __('Properties (for Rent)', 'roots-immo'),

        'singular_name' => __('Property (for Rent)', 'roots-immo'),

        'add_new' => __('Add New', 'roots-immo'),

        'add_new_item' => __('Add New Property', 'roots-immo'),

        'edit_item' => __('Edit Property', 'roots-immo'),

        'new_item' => __('New Property', 'roots-immo'),

        'view_item' => __('View Property', 'roots-immo'),

        'search_items' => __('Search Properties', 'roots-immo'),

        'not_found' => __('No properties found', 'roots-immo'),

        'not_found_in_trash' => __('No properties found in Trash', 'roots-immo'),

        'parent_item_colon' => __('Parent Property:', 'roots-immo'),

        'menu_name' => __('For Rent', 'roots-immo'),

    ];

    $args_2 = [

        'labels' => $labels_2,

        'hierarchical' => false,

        'supports' => ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'revisions'],

        'public' => true,

        'show_ui' => true,

        'show_in_menu' => true,

        'menu_position' => 5,

        'menu_icon' => '',

        'show_in_nav_menus' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'has_archive' => true,

        'query_var' => true,

        'can_export' => true,

        'rewrite' => true,

        'capability_type' => 'post',

    ];

    register_post_type('rent', $args_2);
}

/*

 * Registering meta boxes

 *

 * All the definitions of meta boxes are listed below with comments.

 * Please read them CAREFULLY.

 *

 * You also should read the changelog to know what has been changed before updating.

 *

 * For more information, please visit:

 * @link http://www.deluxeblogtips.com/meta-box/

 */

add_filter('rwmb_meta_boxes', 'roots_immo_register_meta_boxes');

/**

 * Register meta boxes.

 *

 * @return void
 */
function roots_immo_register_meta_boxes($meta_boxes)
{

  /*

   * Prefix of meta keys (optional)

   * Use underscore (_) at the beginning to make keys hidden

   * Alt.: You also can make prefix empty to disable it

   */

  // Better has an underscore as last sign

  $prefix = 'roots_immo';

  // 1st meta box

  $meta_boxes[] = [

    // Meta box id, UNIQUE per meta box. Optional since 4.1.5

    'id' => 'standard',

    // Meta box title - Will appear at the drag and drop handle bar. Required.

    'title' => __('Standard Fields', 'rwmb'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.

    'pages' => ['rent', 'sale'],

    // Where the meta box appear: normal (default), advanced, side. Optional.

    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.

    'priority' => 'high',

    // Auto save: true, false (default). Optional.

    'autosave' => true,

    // List of meta fields

    'fields' => [

      [

        'id'            => "{$prefix}_id",

        'name'          => __('N° de porte', 'rwmb'),

        'type'          => 'text',

      ],

      // Mise en avant

      [

        'name' => __('Mise en avant', 'rwmb'),

        'id'   => "{$prefix}_featured",

        'type' => 'checkbox',

        // Value can be 0 or 1

        'std'  => 1,

      ],

      //Petit prix

      [

        'name' => __('Petit prix', 'rwmb'),

        'id'   => "{$prefix}_low_price",

        'type' => 'checkbox',

        // Value can be 0 or 1

        'std'  => 0,

      ],

      // Loyer

      [

        'name' => __('Loyer', 'rwmb'),

        'id'   => "{$prefix}_rent",

        'type' => 'number',

        'min'  => 0,

        'step' => 'any',

      ],

      // Charges

      [

        'name' => __('Charges', 'rwmb'),

        'id'   => "{$prefix}_service_charge",

        'type' => 'number',

        'min'  => 0,

        'step' => 'any',

      ],

      // Honoraires

      [

        'name' => __('Honoraires', 'rwmb'),

        'id'   => "{$prefix}_fee",

        'type' => 'number',

        'step' => 'any',

      ],

       // Disponibilité

      [

        'name' => __('Disponibilité', 'rwmb'),

        'id'   => "{$prefix}_disponibility",

        'type' => 'date',

        // jQuery date picker options. See here http://api.jqueryui.com/datepicker

        'js_options' => [

          'appendText'      => __('(dd-mm-yy)', 'rwmb'),

          'dateFormat'      => __('dd-mm-yy', 'rwmb'),

          'changeMonth'     => true,

          'changeYear'      => true,

          'showButtonPanel' => true,

        ],

      ],

      // Surface du bien

      [

        'name' => __('Surface du bien', 'rwmb'),

        'id'   => "{$prefix}_surface",

        'type' => 'number',

        'min'  => 0,

        'step' => 'any',

      ],

      // Surface du terrain

      [

        'name' => __('Surface du terrain', 'rwmb'),

        'id'   => "{$prefix}_total_surface",

        'type' => 'number',

        'min'  => 0,

        'step' => 5,

      ],

       // Type

      [

        'name'     => __('Type', 'rwmb'),

        'id'       => "{$prefix}_type",

        'type'     => 'select',

        // Array of 'value' => 'Label' pairs for select box

        'options'  => [

          'value1' => __('Studio', 'rwmb'),

          'value2' => __('T1', 'rwmb'),

          'value3' => __('T1B', 'rwmb'),

          'value4' => __('T1D', 'rwmb'),

          'value5' => __('T2', 'rwmb'),

          'value6' => __('T2B', 'rwmb'),

          'value7' => __('T2D', 'rwmb'),

          'value8' => __('T3', 'rwmb'),

          'value9' => __('T3D', 'rwmb'),

          'value10' => __('T4', 'rwmb'),

          'value11' => __('F1', 'rwmb'),

          'value12' => __('F1D', 'rwmb'),

          'value13' => __('F2', 'rwmb'),

          'value14' => __('F3', 'rwmb'),

          'value15' => __('F4', 'rwmb'),

          'value16' => __('Maison', 'rwmb'),

          'value17' => __('Terrain', 'rwmb'),

          'value18' => __('BAR', 'rwmb'),

          'value19' => __('BUR', 'rwmb'),

          'value20' => __('COM', 'rwmb'),

        ],

        // Select multiple values, optional. Default is false.

        'multiple'    => false,

        'std'         => 'value2',

        'placeholder' => __('Select an Item', 'rwmb'),

      ],

       // chauffage

      [

        'name'     => __('Heating', 'rwmb'),

        'id'       => "{$prefix}_heating_type",

        'type'     => 'select',

        // Array of 'value' => 'Label' pairs for select box

        'options'  => [

          'value1' => __('C/C', 'rwmb'),

          'value2' => __('I/E', 'rwmb'),

          'value3' => __('I/G', 'rwmb'),

        ],

        // Select multiple values, optional. Default is false.

        'multiple'    => false,

        'std'         => 'value2',

        'placeholder' => __('Select an Item', 'rwmb'),

      ],

       // Emission de gaz à effet de serre

      [

        'name'     => __('C/L', 'rwmb'),

        'id'       => "{$prefix}_cl",

        'type'     => 'select',

        // Array of 'value' => 'Label' pairs for select box

        'options'  => [

          'value1' => __('C', 'rwmb'),

          'value2' => __('L', 'rwmb'),

        ],

        // Select multiple values, optional. Default is false.

        'multiple'    => false,

        'std'         => 'value2',

        'placeholder' => __('Select an Item', 'rwmb'),

      ],

      // Nombre de Chambres

      [

        'name' => __('Nombre de chambres', 'rwmb'),

        'id'   => "{$prefix}_rooms",

        'type' => 'number',

        'min'  => 0,

        'step' => 1,

      ],

      // Nombre de salles de bain

      [

        'name' => __('Nombre de salles de bain', 'rwmb'),

        'id'   => "{$prefix}_bathrooms",

        'type' => 'number',

        'min'  => 0,

        'step' => 1,

      ],

      // Etage

      [

        'name'     => __('Etage', 'rwmb'),

        'id'       => "{$prefix}_floor",

        'type'     => 'select',

        // Array of 'value' => 'Label' pairs for select box

        'options'  => [

          'value1' => __('Rez-de-chaussée', 'rwmb'),

          'value2' => __('1', 'rwmb'),

          'value3' => __('2', 'rwmb'),

          'value4' => __('3', 'rwmb'),

          'value5' => __('4', 'rwmb'),

          'value6' => __('5', 'rwmb'),

          'value7' => __('6', 'rwmb'),

          'value8' => __('7', 'rwmb'),

          'value9' => __('8', 'rwmb'),

        ],

        // Select multiple values, optional. Default is false.

        'multiple'    => false,

        'std'         => 'value2',

        'placeholder' => __('Select an Item', 'rwmb'),

      ],

      // Consommation énergetique

      [

        'name'     => __('Consommation énergetique', 'rwmb'),

        'id'       => "{$prefix}_energy_consumption",

        'type'     => 'select',

        // Array of 'value' => 'Label' pairs for select box

        'options'  => [

          'value1' => __('A', 'rwmb'),

          'value2' => __('B', 'rwmb'),

          'value3' => __('C', 'rwmb'),

          'value4' => __('D', 'rwmb'),

          'value5' => __('E', 'rwmb'),

          'value6' => __('F', 'rwmb'),

          'value7' => __('G', 'rwmb'),

        ],

        // Select multiple values, optional. Default is false.

        'multiple'    => false,

        'std'         => 'value2',

        'placeholder' => __('Select an Item', 'rwmb'),

      ],

      // Emission de gaz à effet de serre

      [

        'name'     => __('Emission de gaz à effet de serre ', 'rwmb'),

        'id'       => "{$prefix}_gas_emissions",

        'type'     => 'select',

        // Array of 'value' => 'Label' pairs for select box

        'options'  => [

          'value1' => __('A', 'rwmb'),

          'value2' => __('B', 'rwmb'),

          'value3' => __('C', 'rwmb'),

          'value4' => __('D', 'rwmb'),

          'value5' => __('E', 'rwmb'),

          'value6' => __('F', 'rwmb'),

          'value7' => __('G', 'rwmb'),

        ],

        // Select multiple values, optional. Default is false.

        'multiple'    => false,

        'std'         => 'value2',

        'placeholder' => __('Select an Item', 'rwmb'),

      ],

      // map

      [

        'id'            => "{$prefix}_address",

        'name'          => __('Adresse', 'rwmb'),

        'type'          => 'text',

        'std'           => __('Adresse', 'rwmb'),

      ],

      [

        'id'            => "{$prefix}_loc",

        'name'          => __('Location', 'rwmb'),

        'type'          => 'map',

        'std'           => '',

        // 'latitude,longitude[,zoom]' (zoom is optional)

        'style'         => 'width: 500px; height: 500px',

        'address_field' => "{$prefix}_address",

        // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)

      ],

      [

        'id'            => "{$prefix}_area",

        'name'          => __('Secteur', 'rwmb'),

        'type'          => 'text',

        'std'           => __('Secteur', 'rwmb'),

      ],

      [

        'id' => "{$prefix}_nearby",

        'name' => __('A proximité de', 'rwmb'),

        'type' => 'textarea',

        'cols' => 20,

        'rows' => 3,

      ],

    ],

  ];

    $meta_boxes[] = [

    // Meta box id, UNIQUE per meta box. Optional since 4.1.5

    'id' => 'gallery',

    // Meta box title - Will appear at the drag and drop handle bar. Required.

    'title' => __('Gallery', 'rwmb'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.

    'pages' => ['rent', 'sale'],

    // Where the meta box appear: normal (default), advanced, side. Optional.

    'context' => 'side',

    // Order of meta box: high (default), low. Optional.

    'priority' => 'low',

    // Auto save: true, false (default). Optional.

    'autosave' => true,

    // List of meta fields

    'fields' => [

      [

        'name'             => __('Gallery images', 'rwmb'),

        'id'               => "{$prefix}_images",

        'type'             => 'plupload_image',

        'max_file_uploads' => 5,

      ],

    ],

  ];

    $meta_boxes[] = [

    // Meta box id, UNIQUE per meta box. Optional since 4.1.5

    'id' => 'Acienloc',

    // Meta box title - Will appear at the drag and drop handle bar. Required.

    'title' => __('Ancien locataire', 'rwmb'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.

    'pages' => ['rent', 'sale'],

    // Where the meta box appear: normal (default), advanced, side. Optional.

    'context' => 'side',

    // Order of meta box: high (default), low. Optional.

    'priority' => 'low',

    // Auto save: true, false (default). Optional.

    'autosave' => true,

    // List of meta fields

    'fields' => [

      // nom du precedent locataire

      [

        // Field name - Will be used as label

        'name'  => __('Ancien locataire', 'rwmb'),

        // Field ID, i.e. the meta key

        'id'    => "{$prefix}_old_loc",

        // Field description (optional)

        'desc'  => __('Nom du précédent locataire', 'rwmb'),

        'type'  => 'text',

        // Default value (optional)

        'std'   => '',

        // CLONES: Add to make the field cloneable (i.e. have multiple value)

        'clone' => false,

      ],

      // CHECKBOX

      [

        'name' => __('Acc', 'rwmb'),

        'id'   => "{$prefix}_old_loc_acc",

        'type' => 'checkbox',

        // Value can be 0 or 1

        'std'  => 0,

      ],

      // numero de tel

      [

        'name' => __('Numéro du précédent locataire', 'rwmb'),

        'id'   => "{$prefix}_old_loc_number",

        'type' => 'number',

        'min'  => 0,

        'step' => 'any',

      ],

    ],

  ];

    return $meta_boxes;
}

function has_map()
{
    global $post;

    $prefix = 'roots_immo';

    $map_address = rwmb_meta($prefix.'_address');

    if (!empty($map_address)) {
        return true;
    } else {
        return false;
    }
}

function has_Video()
{
    global $post;

    $prefix = 'roots_immo';

    $video_adress = rwmb_meta($prefix.'_video');

    if (!empty($video_adress)) {
        return true;
    } else {
        return false;
    }
}

function get_type($key)
{
    global $types_array;

    $type = '';

    if ($key) {
        $type = $types_array[$key];
    }

    return $type;
}

function get_main_type($type)
{
    switch ($type) {

    case 'T1':

    case 'T1Bis':

    case 'T1Duplex':

    case 'T2Bis':

    case 'T2Duplex':

    case 'T2':

    case 'T3':

    case 'T3Duplex':

    case 'T4':

    case 'F1':

    case 'F1Duplex':

    case 'F2':

    case 'F3':

    case 'F4':

      $type = 'appartement';

    break;

  }

    return strtolower($type);
}

function get_floor()
{
    global $post;

    global $prefix;

    $floor = '';

    $floors = rwmb_meta($prefix.'_floor');

    switch ($floors) {

        case 'value1':

            $floor = 'Rez-de-chaussée';

        break;

        case 'value2':

            $floor = '1';

        break;

        case 'value3':

            $floor = '2';

        break;

        case 'value4':

            $floor = '3';

        break;

        case 'value5':

            $floor = '4';

        break;

        case 'value6':

            $floor = '5';

        break;

        case 'value7':

            $floor = '6';

        break;

        case 'value8':

            $floor = '7';

        break;

        case 'value9':

            $floor = '8';

        break;

    }

    return $floor;
}

function get_consumption()
{
    global $post;

    global $prefix;

    $consumption = '';

    $consumptions = rwmb_meta($prefix.'_energy_consumption');

    switch ($consumptions) {

        case 'value1':

            $consumption = 'A';

        break;

        case 'value2':

            $consumption = 'B';

        break;

        case 'value3':

            $consumption = 'C';

        break;

        case 'value4':

            $consumption = 'D';

        break;

        case 'value5':

            $consumption = 'E';

        break;

        case 'value6':

            $consumption = 'F';

        break;

        case 'value7':

            $consumption = 'G';

        break;

    }

    return $consumption;
}

function get_emission()
{
    global $post;

    global $prefix;

    $emission = '';

    $emissions = rwmb_meta($prefix.'_gas_emissions');

    switch ($emissions) {

        case 'value1':

            $emission = 'A';

        break;

        case 'value2':

            $emission = 'B';

        break;

        case 'value3':

            $emission = 'C';

        break;

        case 'value4':

            $emission = 'D';

        break;

        case 'value5':

            $emission = 'E';

        break;

        case 'value6':

            $emission = 'F';

        break;

        case 'value7':

            $emission = 'G';

        break;

    }

    return $emission;
}

function get_heating()
{
    global $post;

    global $prefix;

    $heating = '';

    $heating_types = rwmb_meta($prefix.'_heating_type');

    switch ($heating_types) {

    case 'value1':

      $heating = 'C/C';

    break;

    case 'value2':

      $heating = 'I/E';

    break;

    case 'value3':

      $heating = 'I/G';

    break;

  }

    return $heating;
}

function is_low_price()
{
    global $post;

    global $prefix;

    $meta_value = rwmb_meta($prefix.'_low_price');

    $checked = false;

    if ($meta_value == 1) {
        $checked = true;
    }

    return $checked;
}

function get_img_slider_home()
{
    global $post;

    $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

    $title = get_the_title();

    $urlPost = get_permalink();

    echo '<img src="'.$url.'" alt="//" title="'.$title.'"/>';

  // <img src="http://dummyimage.com/580x321/4d494d/686a82.gif&text=placeholder+image" alt="//" title="A property title <span>$1.450.000</span>">
}

function get_image_count()
{
    global $post;

    $attachments = get_children(['post_parent' => $post->ID]);

    $count = count($attachments);

    return $count;
}

function get_all_posts($post_type = 'post')
{
    $args = [

    'posts_per_page' => -1,

    'orderby' => 'post_date',

    'order' => 'DESC',

    'post_type' => $post_type,

  ];

    $posts = get_posts($args);

    return $posts;
}

function pagination($pages = '', $range = 3, $custom_query = null)
{
    global $wp_query;
    global $paged;

    $query = $wp_query;

    $showitems = ($range * 2) + 1;

    if ($custom_query) {
        $query = $custom_query;
    }

    if (empty($paged)) {
        $paged = 1;
    }

    if ($pages == '') {
        $pages = $query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo '<ul class="pagination">';
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            echo '<li><a href="'.get_pagenum_link(1).'">&laquo; First</a></li>';
        }
        if ($paged > 1 && $showitems < $pages) {
            echo '<li><a href="'.get_pagenum_link($paged - 1).'">&lsaquo; Previous</a></li>';
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? '<li class="active"><span>'.$i.'</span></li>' : '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
            }
        }

        if ($paged < $pages && $showitems < $pages) {
            echo '<li><a href="'.get_pagenum_link($paged + 1).'">Next &rsaquo;</a></li>';
        }
        if ($paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages) {
            echo '<li><a href="'.get_pagenum_link($pages).'">Last &raquo;</a></li>';
        }
        echo '</ul>';
    }
}

//Add custom post type links to menu builder
add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');

function wpclean_add_metabox_menu_posttype_archive()
{
    add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function wpclean_metabox_menu_posttype_archive()
{
    $post_types = get_post_types(['show_in_nav_menus' => true, 'has_archive' => true], 'object');

    if ($post_types) :
        $items = [];
    $loop_index = 999999;

    foreach ($post_types as $post_type) {
        $item = new stdClass();
        $loop_index++;

        $item->object_id = $loop_index;
        $item->db_id = 0;
        $item->object = 'post_type_'.$post_type->query_var;
        $item->menu_item_parent = 0;
        $item->type = 'custom';
        $item->title = $post_type->labels->name;
        $item->url = get_post_type_archive_link($post_type->query_var);
        $item->target = '';
        $item->attr_title = '';
        $item->classes = [];
        $item->xfn = '';

        $items[] = $item;
    }

    $walker = new Walker_Nav_Menu_Checklist([]);

    echo '<div id="posttype-archive" class="posttypediv">';
    echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
    echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
    echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) ['walker' => $walker]);
    echo '</ul>';
    echo '</div>';
    echo '</div>';

    echo '<p class="button-controls">';
    echo '<span class="add-to-menu">';
    echo '<input type="submit"'.disabled(1, 0).' class="button-secondary submit-add-to-menu right" value="'.__('Add to Menu', 'andromedamedia').'" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
    echo '<span class="spinner"></span>';
    echo '</span>';
    echo '</p>';

    endif;
}
