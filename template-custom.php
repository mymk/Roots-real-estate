<?php
/*
Template Name: location Template
*/
$sale = false;

if(is_page('location')) {
	$myposts = get_all_posts('rent');
}
else if(is_page('ventes')) {
	$sale = true;
	$myposts = get_all_posts('sale');
}
?>
		
<h2 class="remove-top"><?php echo roots_title(); ?></h2>

<!-- filters -->
<div class="clearfix">
	
	<!-- tag filters -->
	<ul class="filter-list nav nav-tabs">
		
		<li class="active"><a data-rel="all" class="current"><?php _e('All', 'roots-immo'); ?></a></li>
		<li><a data-rel="studio"><?php _e('Studio', 'roots-immo'); ?></a></li>
		<li><a data-rel="appartement"><?php _e('Appartement', 'roots-immo'); ?></a></li>
		<li><a data-rel="maison"><?php _e('House', 'roots-immo'); ?></a></li>
		<?php if($sale): ?>
		<li><a data-rel="terrain"><?php _e('Land', 'roots-immo'); ?></a></li>
		<?php else: ?>
		<li><a data-rel="low-price"><?php _e('Low price', 'roots-immo'); ?></a></li>
		<?php endif;?>
	</ul>

	<div class="switcher fr">
		<a href="#" id="gridview" class="switcher"><i class="icon-layout"></i></a> <a href="#" id="listview" class="switcher active"><i class="icon-menu"></i></a>
	</div>

</div>

<div class="well well-sm">
<strong>Category Title</strong>
    <div class="btn-group">
        <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
        </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
            class="glyphicon glyphicon-th"></span>Grid</a>
    </div>
</div>
<div class="col-xs-12">
	<div id="products" class=" list-group row">
	<?php						
		foreach ( $myposts as $post ) : setup_postdata( $post );

		get_template_part('templates/preview');

		endforeach; 
		wp_reset_postdata();
	?>
</div>

<ul id="hidden-list" style="display: none">

</ul>	
<div class="clear"></div>
<div class="holder"><a class="jp-previous jp-disabled">←<?php _e('previous', 'roots-immo'); ?></a><a class="jp-current">1</a><span class="jp-hidden">...</span><a href="#" class="">2</a><a href="#" class="">3</a><a href="#" class="">4</a><span class="jp-hidden">...</span><a>5</a><a class="jp-next"><?php _e('next', 'roots-immo'); ?>→</a></div>

</div>
