jQuery(document).ready(function($) {
	if ( window.iptFSQMModalPopupForms == undefined ) {
		window.iptFSQMModalPopupForms = [];
	}
	if ( window.iptFSQMModalPopupForms.length ) {
		for ( var i = 0; i < window.iptFSQMModalPopupForms.length; i++ ) {
			var popUpDialog = window.iptFSQMModalPopupForms[i];
			if ( typeof ( popUpDialog ) !== 'object' ) {
				continue;
			}
			var newAnchor = $( '<a><span class="fsqm-popup-inner"><span class="fsqm-popup-label">' + popUpDialog.label + '</span> <i class="ipticm ipt-icomoon-chevron-up"></i></span></a>' );
			newAnchor.addClass( 'ipt-fsqm-popup-anchor ' + 'ipt-fsqm-popup-pos-' + popUpDialog.position );
			newAnchor.data('fsqmpopUpPosition', popUpDialog.position);
			newAnchor.css({
				color: popUpDialog.color,
				backgroundColor: popUpDialog.bgcolor
			});
			newAnchor.attr( 'data-remodal-target', 'ipt-fsqm-popup-form-' + popUpDialog.formID );
			$('body').append(newAnchor);
		}

		$(document).on('opened', '.remodal', function() {
			$(window).trigger('resize');
			var _self = $(this);
			_self.find('iframe').each(function() {
				$(this).attr('src', $(this).attr('src'));
			});
			_self.find('.ipt_uif_conditional').trigger('fsqm.conditional');
		});

		var checkButtonMargin = function() {
			$('.ipt-fsqm-popup-anchor').each(function() {
				var width = $(this).outerWidth( true ),
				height = $(this).outerHeight( true );
				switch ( $(this).data('fsqmpopUpPosition') ) {
					case 'r' :
					case 'l' :
						$(this).css({
							marginTop: '-' + width/2 + 'px'
						});
						break;
					case 'bc' :
						$(this).css({
							marginLeft: '-' + width/2 + 'px'
						});
						break;
				}
			})
		}
		checkButtonMargin();
		$(window).on( 'resize', checkButtonMargin );
	}
});
