	$.fn.customInput = function(){

		//Walk through each container
		$(this).each(function(){
			var container = $(this),
				labels = container.find('label'),
				inputs = container.find('input'),
				type = inputs.attr('type'),

				triggerSelector = '.'+type,
				triggerHTML = '<i class="ci-'+type+'"></i>',
				inputSelector = 'input[type="'+type+'"]';

			inputs.hide();

			//Change icon state based on input type
			function check(trigger){
				var neighbors =  null,
					type = trigger.siblings('input').attr('type');

				switch (type) {
					case 'radio':
						neighbors = container.find('.checked');

						neighbors.removeClass('checked');
						trigger.addClass('checked');
					break;

					case 'checkbox':
						trigger.toggleClass('checked');
					break;
				}
			}
			
			//Walk through each input in the container
			inputs.each(function(){
				var input = $(this),
					wrapper = input.parent();

				//Add custom HTML
				wrapper.prepend(triggerHTML);
				
				//Tick default inputs
				if(input.is(':checked')) {
					input.siblings(triggerSelector).addClass('checked');
				}
			});

			//Activate input by clicking icon
			$(triggerSelector).on('click', function(){
				var trigger = $(this),
					input = $(this).siblings(inputSelector);

				input.click();

				check(trigger);
			});

			//Check icon on label click
			labels.on('click', function(){
				var trigger = $(this).siblings(triggerSelector);
				
				check(trigger);
			});
		});
	};