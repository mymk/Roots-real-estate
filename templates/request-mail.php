<h4>Demande de rendez vous </h4>

<p>Veuillez remplir ce formulaire et nous vous recontacterons dans les plus brefs délais.</p>

<form id="recuest-showing" action="#" method="post" role="form">
	<div class="row">
		<div class="form-group col-md-12">
			<label for="your-text" class="screen-reader-text"><?php _e('Your text', 'roots-immo'); ?></label>
			<textarea id="your-text" name="text" class="full-width form-control">Je suis intéressé(e) par cette annonce.Pouvez-vous me contacter pour de plus amples informations ?
Cordialement</textarea>
		</div>

		<div class="form-group col-md-6">
			<label for="your-name" class="screen-reader-text"><?php _e('Your Name', 'roots-immo'); ?></label>
			<input id="your-name" name="name" class="form-control" placeholder="<?php _e('Your Name', 'roots-immo'); ?>" type="text" required="">
		</div>

		<div class="form-group col-md-6">
			<label for="your-email" class="screen-reader-text"><?php _e('E-mail', 'roots-immo'); ?></label>
			<input id="your-email" name="email" class="form-control" placeholder="<?php _e('E-mail', 'roots-immo'); ?>" type="email" required="">
		</div>

		<div class="form-group col-md-6">
			<label for="your-telephone" class="screen-reader-text"><?php _e('Your telephone', 'roots-immo'); ?></label>
			<input id="your-telephone" name="telephone" class="form-control" placeholder="<?php _e('Your telephone', 'roots-immo'); ?>" type="text" required="">
		</div>

		<div class="form-group col-md-6">
			<label for="showing-date" class="screen-reader-text"><?php _e('Showing date', 'roots-immo'); ?></label>
			<input id="showing-date" name="date" class="date form-control" placeholder="<?php _e('Showing date', 'roots-immo'); ?>" type="text" required="">
		</div>
		
		<div class="form-group col-md-6">
		<input type="hidden" name="title" value="<?php the_title( ); ?>">
		<input type="hidden" name="url" value="<?php echo post_permalink(); ?>">

	  	<input type="hidden" name="action" value="contact">
	  	<?php wp_nonce_field( 'ajax_contact_nonce', 'security' ); ?>
	  	<button type="submit" class="btn btn-default send-message"><?php _e('Request showing', 'roots-immo'); ?></button>
	  </div>
		<div class="cform-response-output"></div>
	</div>
</form>