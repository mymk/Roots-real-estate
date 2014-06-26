<?php
/*
Template Name: contact Template
*/
?>
<!-- Section: map -->
<section class="">
	<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="//maps.google.com.ar/maps?f=q&amp;source=s_q&amp;hl=es-419&amp;geocode=&amp;q=22 Avenue Georges Dumas, 87000 Limoges, France&amp;aq=3&amp;sll=45.8268507,1.2645989999999756&amp;ie=UTF8&amp;t=m&amp;ll=45.8268507,1.2645989999999756amp;z=13&amp;output=embed"></iframe>
</section>
<!-- /section: map -->

<!-- Section: search form -->
<section class="col-md-8 add-bottom relative">
	
	<h2><?php _e('CONTACT FORM', 'roots-immo'); ?></h2>

	<p><?php _e('Please feel free to send us a message if you have any cuestion', 'roots-immo'); ?></p>
	
	<form id="contact-form" class="boxed shadded wide-on-small-screen clearfix" action="contact-form.php" role="form">

		
			<div class="form-group">
				<label for="name-field" class="screen-reader-text"><?php _e('Your Name', 'roots-immo'); ?></label>
				<input name="first-name" id="name-field" class="form-control" type="text" placeholder="<?php _e('Your Name', 'roots-immo'); ?>" class="full-width" required/>
			</div>

			<div class="form-group">
				<label for="last-field" class="screen-reader-text"><?php _e('Last Name', 'roots-immo'); ?></label>
				<input name="last-name" id="last-field" class="form-control" type="text" placeholder="<?php _e('Last Name', 'roots-immo'); ?>" class="full-width" required/>
			</div>

			<div class="form-group">
				<label for="email-field" class="screen-reader-text"><?php _e('Email', 'roots-immo'); ?></label>
				<input name="email" id="email-field" class="form-control" type="email" placeholder="<?php _e('Email', 'roots-immo'); ?>" class="full-width" required/>
			</div>

			<div class="form-group">
				<label for="web-field" class="screen-reader-text"><?php _e('Website', 'roots-immo'); ?></label>
				<input name="website" id="web-field" class="form-control" type="text" placeholder="<?php _e('Website', 'roots-immo'); ?>" class="full-width" required/>
			</div>

			<div class="form-group">
				<label for="message-field" class="screen-reader-text"><?php _e('Message', 'roots-immo'); ?></label>
				<textarea name="message" class="form-control" id="message-field" placeholder="<?php _e('Message', 'roots-immo'); ?>" class="full-width" required></textarea>
			</div>

			<div class="form-group">
				<small><?php _e('All the fields are required.', 'roots-immo'); ?></small>
			</div>

			
			<input type="hidden" name="action" value="contact">
			<?php wp_nonce_field( 'ajax_contact_nonce', 'security' ); ?>
			<input type="submit" class="full-width tall" value="<?php _e('Send', 'roots-immo'); ?>" id="send-message">
	
			<div class="cform-response-output"></div></li> 
	</form>

</section>
<!-- /section: search form -->

<!-- Aside -->
<aside class="col-md-4">
	
	<h2><?php _e('INFORMATION', 'roots-immo'); ?></h2>

	<p>Depuis 1991, l'agence BEGIP accompagne de nombreux étudiants dans leur recherche d'appartement.Nous pouvons proposer un grand chois de logements rénovés sur tout Limoges.Tout au long de votre location nous somme à votre disposition pour rélger tous les petits aléas de la vie courate, administratif ou dépannage. Dans un souci de réativité l'agence dispose d'un service de maintenance.Nombreuses proposition, du Studio au T3, dans Limoges</p>

	<ul class="address">
		<li>Begip</li>
		<li>22 Avenue Georges Dumas</li>
		<li>87000, Limoges</li>
	</ul>
	<ul class="address">
		<li><?php _e('Phone', 'roots-immo'); ?> : 05.55.33.97.50</li>
		<li><?php _e('Fax', 'roots-immo'); ?> : 05.55.33.19.17</li>
		<li><?php _e('Email', 'roots-immo'); ?> : <a href="#">contact@begip.fr</a></li>
	</ul>

</aside>
<!-- /aside -->
