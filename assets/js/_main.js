/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {

      /* android 2 + ie8 fallback svg   */
      if (!Modernizr.svg) {
          $('img[src$=".svg"]').each(function()
          {
              $(this).attr('src', $(this).attr('src').replace('.svg', '.png'));
          });
      }

      //Scroll top
      $('.scroll-top').click(function() {
        $("html, body").animate({
          scrollTop : 0
        }, 600);
        return false;
      });
      
      $('.new-posts, .items').find('.item').matchHeight(true);

      //Custom Checkbox/Radio
      $('.custom-input').customInput('radio');

      $("textarea").click(function() {
         $(this).height(100);
      });

      $('input[type="radio"]').each(function(){
        var step = $(this).attr('data-price-step'),
            inputs = $(this).parents('form').find('input[type="number"]');
        
        if($(this).is(':checked')) {
          inputs.attr('step', step);
        }
      }).click(function(){
        var step = $(this).attr('data-price-step'),
            inputs = $(this).parents('form').find('input[type="number"]');
        
        inputs.attr('step', step);
      });


      //Champs de recherche avancée
      $('.advanced-search').hide();

      if ($.cookie('ts_advanced_search') === 'open') {
        $('.advanced-search').show();
        $('#advanced-search-btn').addClass('open');
      }

      $('#advanced-search-btn').click(function (e) {
        if ($(".advanced-search").is(":visible")) {
          $.cookie('ts_advanced_search', 'closed',{ expires: 60, path: '/' });
            $(".advanced-search").animate(
                {
                    opacity: "0"
                },
                150,
                function(){
                    $('#advanced-search-btn').removeClass('open');
                    $(".advanced-search").slideUp(150);
                }
            );
        }
        else {
            $(".advanced-search").slideDown(150, function(){
              $.cookie('ts_advanced_search', 'open',{ expires: 60, path: '/' });
                $(".advanced-search").animate(
                    {
                        opacity: "1"
                    },
                    150
                );
            $('#advanced-search-btn').addClass('open');
            });
        }
        e.preventDefault();
      });

   

      //Validation et envoi des formulaires
      (function () {
        if( $('.send-message').length > 0) {

          // on ajoute la div de message d'erreur ou succes
        $('.cform-response-output').append('<div class="alert"></div>');

        // eviter le multiclick 
        var busy = null ;

        // a la soumission du formulaire
        $('.send-message').click( function() {

          var error = false,
          form  = $(this).parents('form'),
          noty = form.find('.alert');

          form.find('[required]').each( function() {

            // on vérifie si le champ est vide ou non
            if ( $.trim( $(this).val() ) === '' ) {
              $(this).addClass('error');
              error = true;
            }

            else {
              $(this).removeClass('error');
            }

          });


          if ( !error ) {

            if (busy){
              busy.abort();
            }

            busy = $.ajax({
              url: ajaxurl,
              type:'POST',
              data:form.serialize(),
              success: function( response ){
                if ( response === 'success') {
                  //on vide  le formulaire
                  form[0].reset();

                  // on affiche un msg de success
                  noty.removeClass('alert-warning').addClass('alert-info').html('Merci ! votre message as bien été envoyé, nous vous contacterons dans les plus brefs délais.');
                }

                if (response === 'error') {
                  // on affiche le message d'erreur
                  noty.removeClass('alert-info').addClass('alert-warning').html('Nous sommes désolé mais une erreur est survenue.');
                }
              }
            });

          } else  {
            noty.removeClass('alert-info').addClass('alert-warning').html('Merci de remplir tout les champ ci-dessus.');
          }
          // on affiche le message
          noty.slideDown();
          noty.delay(5000).slideUp();
          return false;
        });
        }
      }());
    }
  },
  // Home page
  archive: {
    init: function() {

      // change list style
      $('#list').click(
        function(e){
          e.preventDefault();
          $('.items .item').removeClass('col-xs-4 col-lg-4');
          $('.items .item').addClass('col-xs-12 col-lg-12');
          $('.items .item .thumbnail, .items .item .caption').addClass('col-xs-6 col-lg-6');
        }
      );
      $('#grid').click(
        function(e){
          e.preventDefault();
          $('.items .item').removeClass('col-xs-12 col-lg-12');
          $('.items .item .thumbnail, .items .item .caption').removeClass('col-xs-6 col-lg-6');
          $('.items .item').addClass('col-xs-4 col-lg-4');
        }
      );
  
    }
  },

  single: {
    init: function() {

      //FitVids
      $('#video').fitVids();

    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);




         // activate datepickers for all elements with a class of `datepicker`
         moment.lang('fr');


      $(function(){
        $('#showing-date').pikaday({
          firstDay: 1,
          format: 'DD MMMM YYYY',
          i18n: {
            previousMonth : 'Mois précédent',
            nextMonth     : 'Mois suivant',
            months        : ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
            weekdays      : ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'],
            weekdaysShort : ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim']
          },
          onSelect: function() {
            console.log(this.getMoment().format('DD MMMM YYYY'));
          }
        });
      });



})(jQuery); // Fully reference jQuery after this point.
