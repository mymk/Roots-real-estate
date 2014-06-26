<?php
?>
<form id="send-to-friend" action="#" method="post" role="form" class="col-sm-12">

	<h4 class="section-titling">
		<?php _e('Send this property to a friend', 'roots-immo'); ?>
	</h4>
	<div class="row">

		<div class="form-group col-md-6">
			<label for="friend-name-field" class="screen-reader-text"><?php _e('Name of your friend', 'roots-immo'); ?></label>
			<input id="friend-name-field" name="friend-name-field" class="form-control" type="text" placeholder="<?php _e('Name of your friend', 'roots-immo'); ?>" class="full-width" required>
		</div>
		<div class="form-group col-md-6">
			<label for="friend-email-field" class="screen-reader-text">
				<?php _e('Email of your friend', 'roots-immo'); ?>
			</label>
			<input id="friend-email-field" name="friend-email-field" class="form-control" type="email" placeholder="<?php _e('Email of your friend', 'roots-immo'); ?>" class="full-width" required>
		</div>

	</div>
	
	<div class="form-group">
		<label for="recomendation-message-field" class="screen-reader-text">
			<?php _e('Recommendation', 'roots-immo'); ?>
		</label>
		<textarea id="recommendation-message-field" class="form-control" name="recommendation-message-field" placeholder="<?php _e('Recommendation', 'roots-immo'); ?>" class="full-width" required></textarea>
	</div>

	<div class="form-group">
		<input type="hidden" name="action" value="send_mail_friend">
			<?php wp_nonce_field( 'ajax_send_mail_friend_nonce', 'security' ); ?>
		<input type="submit" value="<?php _e('Send it', 'roots-immo'); ?>" class="send-message">
		<input type="submit" value="<?php _e('Clear', 'roots-immo'); ?>">
	</div> 

	
	<div class="cform-response-output"></div>
</form>
