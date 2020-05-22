$(function(){
	var $textarea = $('#ddMultipleFields_richtext');
	
	$textarea
		.val(
			window
				.$ddField
				.html()
				//Decode some HTML entities
				.replace(
					'&lt;',
					'<'
				)
				.replace(
					'&gt;',
					'>'
				)
				.replace(
					'&amp;',
					'&'
				)
		)
		.trigger('change')
	;
	
	$('.js-ok').on(
		'click',
		function(){
			if (typeof tinyMCE != 'undefined'){
				tinyMCE.triggerSave();
			}
			
			window.$ddField.html($textarea.val());
			$textarea.val('');
			window.close();
		}
	);
	
	$('.js-cancel').on(
		'click',
		function(){
			$textarea.val('');
			window.close();
		}
	);
});