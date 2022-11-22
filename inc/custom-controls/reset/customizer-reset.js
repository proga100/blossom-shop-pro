jQuery(document).ready(function($){
    $('#customizer_reset_btn button').on( 'click', function(e){
       e.preventDefault();
       
       var data = {
			wp_customize: 'on',	
			action: 'customizer_reset',
            nonce: Blossom_Shop_Pro_Reset.nonce
        };

        $.confirm({
		    title: Blossom_Shop_Pro_Reset.title,
		    content: Blossom_Shop_Pro_Reset.content,
		    type: 'red',
		    typeAnimated: true,
		    icon: 'fas fa-skull-crossbones',
		    autoClose: 'no|15000',
            buttons: {
		        yes: {
		            isHidden: true, // hide the button
		            keys: ['y'],
		            action: function () {
		                $.post(ajaxurl, data, function (e) {
                            wp.customize.state('saved').set(true);
                            location.reload();
                        });
		            }
		        },
		        no: {
		            keys: ['N'],
                    btnClass: 'btn-blue',
		            action: function () {
		                //$.alert('You clicked No.');
		            }
		        },
			}
		});
    });        
});