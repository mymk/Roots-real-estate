<?php
/*
Template Name: single location Template
*/
	global $prefix;
?>
<?php while (have_posts()) : the_post(); ?>
<!-- Single Rent -->
<article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    	<!-- Section: slider -->
	<section class="row add-bottom">

		<div class="col-md-8">
				
			<ul class="nav nav-tabs">
		    	<li class="active"><a href="#photos" data-toggle="tab"><i class="icon-camera"></i><?php _e('Photos', 'roots-immo'); ?></a></li>
		    	<?php if(has_Video()){ ?>
		    	<li><a href="#video" data-toggle="tab"><i class="icon-video"></i><?php _e('Video', 'roots-immo'); ?></a></li>
		    	<?php } ?>
		    	<?php if(has_Map()){ ?>
			  	<li><a href="#map" data-toggle="tab"><i class="icon-map"></i><?php _e('Map', 'roots-immo'); ?></a></li>
			  	<?php } ?>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane active" id="photos">

					<?php 
					 if(has_gallery()){
					 	get_gallery(); 
					 } else if (has_post_thumbnail( )){
					  	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
						?>
							<a id="fancybox-manual-c" class="fancybox" href="<?php echo $large_image_url[0] ;?>">
								<?php the_post_thumbnail('single-item', array('class' => 'img-preview scale-with-grid')); ?>
							</a>
						<?php

					} else {
						?>
						<img src="<?php bloginfo('template_directory' ); ?>/assets/img/logo.jpg" alt="placeholder+image">
							
						<?php
					}		 
					?>

				</div>

			    <?php if(has_Video()): ?>
				<div class="tab-pane" id="video">
					<div class="fluid-width-video-wrapper" style="padding-top: 56.2%;">
						<iframe src="http://player.vimeo.com/video/12158329" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" id="fitvid317791"></iframe>
					</div>
				</div>
			   <?php endif; ?>

			   <?php if(has_Map()): ?>
			  	<div class="tab-pane" id="map">
			  		<?php 
				  		$mapAdresse = rwmb_meta( $prefix.'_adresse' );
						$mapPoint = rwmb_meta( $prefix.'_loc' );
							
						if(!empty($mapAdresse)) :
					?>

						<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="//maps.google.com/maps?f=q&amp;source=s_q&amp;hl=es-419&amp;geocode=&amp;q=<?php echo $mapAdresse; ?>&amp;aq=3&amp;sll=<?php echo $mapPoint; ?>&amp;ie=UTF8&amp;t=m&amp;ll=<?php echo $mapPoint; ?>amp;z=13&amp;output=embed"></iframe>

					<?php endif; ?>
				</div>	
				<?php endif; ?>

			</div>

		</div>

		<div class="col-md-4">
			<?php get_template_part('templates/request-mail'); ?>			
		</div>

	</section>

	<!-- Section: Property tabs -->
	<section class="row ">

		<div class="col-md-12 add-top">

			<ul class="nav nav-tabs">
		    	<li class="active"><a href="#description" data-toggle="tab"><?php _e('Summary ', 'roots-immo'); ?></a></li>
		    	<li><a href="#dossierlocataire" data-toggle="tab"><?php _e('Dossier locataire ', 'roots-immo'); ?></a></li>
		    	<li><a href="#share-on-fb" data-toggle="tab"><?php _e('Share on facebook', 'roots-immo'); ?></a></li>
		    	<li><a href="#send-to-friend" data-toggle="tab"><?php _e('Send to a friend', 'roots-immo'); ?></a></li>
			</ul>
				
			<!-- Tab panes -->
			<div class="tab-content">
			  <div class="tab-pane active" id="description">
			  	<?php get_template_part('templates/details-rent'); ?>
			  </div>
			  <div class="tab-pane" id="dossierlocataire">
			  	<h3>LISTE DES PIÈCES À FOURNIR POUR UNE LOCATION</h3>
				
				<section>
					<h4>Par le locataire :</h4>
					<ul>
						<li>Copie de carte d’identité (ou équivalence)</li>
						<li>Copie du dernier bulletin de salaire et contrat de travail *</li>
						<li>Attestation d’emploi au jour de la remise des clés *</li>
						<li>Copie du dernier avertissement fiscal *</li>
						<li>Attestation de paiement complété par le précédent propriétaire *</li>
						<li>Attestation d’assurance  » Risques locatifs  » : Obligatoire pour la remise des clés, au nom du preneur, avec l’adresse précise de l’appartement et prenant effet le jour de la remise des clés.</li>
						<li>Relevé d’identité bancaire</li>
					</ul>
				</section>

				<section>
					<h4>Par la caution solidaire ** :</h4>
					<ul>
						<li>Copie de carte d’identité (ou équivalence)</li>
						<li>Copie des 3 derniers bulletins de salaire</li>
						<li>Copie du dernier avertissement fiscal</li>
						<li>Imprimé de cautionnement, à compléter impérativement par le cautionnaire, document fourni à l’agence</li>
						<li>Relevé d’identité bancaire</li>
					</ul>
				</section>
			  </div>
			  <div class="tab-pane" id="share-on-fb">
			  	<?php get_template_part('templates/send-to-facebook'); ?>
			  </div>
			  <div class="tab-pane" id="send-to-friend">
			  	<?php get_template_part('templates/send-mail-friend'); ?>
			  </div>
			</div>



		</div>

		

	</section>
	<!-- /section: tagline -->

	<?php get_template_part('templates/featured'); ?>

</article>

<?php endwhile; ?>




