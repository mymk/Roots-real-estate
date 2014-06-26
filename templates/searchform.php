<?php
	global $types_array;

	$sale = false;
	$rental = false;
	$type_select = '0';
	$heating_select = '0';
	$min_price = 0;
	$max_price = 0;

	if(isset($_GET['post_type']) && $_GET['post_type']=="sale") $sale = true;

	if(isset($_GET['post_type']) && $_GET['post_type']=="rent") $rental = true;

	if(isset($_GET['type_select'])) $type_select = $_GET['type_select'];

	if(isset($_GET['heating_select'])) $heating_select = $_GET['heating_select'];

	if(isset($_GET['min_price'])) $min_price = $_GET['min_price'];

	if(isset($_GET['max_price'])) $max_price = $_GET['max_price'];
?>

<div class="shadded boxed">
	<h4 class="remove-top add-bottom"><?php _e('Search', 'roots-immo'); ?></h4>
	
	<form role="search" method="get" class="search-form  remove-bottom" action="<?php echo home_url('/'); ?>" role="form">
	  
		<div class="form-group form-inline custom-input">
			<label for="type-sale" class="screen-reader-text"><?php _e('Type of property', 'roots-immo'); ?></label>
				<span>
				<input id="type-sale" class="form-control" type="radio" name="post_type" data-price-step="1000" value="sale" <?php if($sale) echo "checked"; ?>>
				<label for="type-sale"><?php _e('Sales', 'roots-immo'); ?></label>
			</span>
			<span>
				<input id="type-rent" class="form-control" type="radio" name="post_type" data-price-step="100" value="rent" <?php if($rental) echo "checked"; ?>>
				<label for="type-rent"><?php _e('Rent', 'roots-immo'); ?></label>
			</span>
		</div>

		<div class="form-group">
			<label for="type-select" class=""><?php _e('Size of property', 'roots-immo'); ?></label>
			<select id="type-select" name="type_select" class="custom-select form-control" title="Property type">
				<option value="0"><?php _e('Size of property', 'roots-immo'); ?></option>
				<?php foreach($types_array as $key => $name) : ?>
					<option value="<?php echo $key; ?>" <?php if ($type_select == $key ) echo 'selected'; ?>><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

			<div class="form-group advanced-search">
			<label for="heating-select" class=""><?php _e('Heating', 'roots-immo'); ?></label>
			<select id="heating-select" name="heating_select" class="custom-select form-control" title="Heating type">
				<option value="0" <?php if($heating_select == '0') echo 'selected'; ?>><?php _e('Heating', 'roots-immo'); ?></option>
				<option value="value1" <?php if($heating_select == 'value1') echo 'selected'; ?>>C/C</option>
				<option value="value2" <?php if($heating_select == 'value2') echo 'selected'; ?>>I/E</option>
				<option value="value3" <?php if($heating_select == 'value3') echo 'selected'; ?>>I/G</option>
			</select>
		</div>

		<div class="form-group advanced-search">
			<label for="max-price"><?php _e('Maximum price', 'roots-immo'); ?></label>
			<input id="max-price" class="form-control" name="max_price" type="number" step="100" min="0" value="<?php echo $max_price ?>"/>
		</div>

		<div class="form-group">
			<input id="s" name="s" type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" class="search-field form-control" placeholder="<?php _e('Search', 'roots-immo'); ?> <?php bloginfo('name'); ?>" autocomplete="off">
			<label class="screen-reader-text"><?php _e('Search for:', 'roots-immo'); ?></label>
		</div>
	
	    <button type="submit" class="btn btn-default"><?php _e('Search', 'roots-immo'); ?></button>
	</form>
</div>	

<!-- /boxed search form -->

