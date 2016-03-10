( function( $ ) {
	$(document).ready( function(){

		var app = $( '#app-area' );
		if( app.find( '#example' ).length > 0 ){
			tableInitialization( '#example' );
		}
		$('.nav-pills li').click(function (e) {
			e.preventDefault();
			var currentElement = $( this );
			var controllerAction = $( this ).children( 'a' ).attr( 'data-action' ) 
			console.log( controllerAction );
			$.ajax( {
				url: "/main/"+ controllerAction,
				type: "post",
				data: { action: controllerAction },
				success: function( data ){
					app.html( data );
					currentElement.tab('show');
					if( "get_all_resume" == controllerAction )
						tableInitialization( '#example' );
				},
				error:function(){
					$(".container_scroll").append('Error Occurred while fetching data.');
				}
			} )
		})
		
		app.on( "click",  "button[name='resume-form-submit']", function (e) {
			e.preventDefault();	
			$( 'input' ).each( function( i, elem ){
				if( $( elem ).val().length == 0 ){
					$( elem ).parents( 'div.form-group' ).addClass( 'has-warning' );	
				} else {
					$( elem ).parents( 'div.form-group' ).removeClass( 'has-warning' ).addClass( 'has-success' );	
				}
			} )
			if( $( '#add-resume-form' ).find( '.has-warning' ).length == 0 )
				$( '#add-resume-form' ).submit();
			

		} )
		

		app.on( "click",  "span[ data-toggle='modal']", function (e) {
			e.preventDefault();
			var currentElement = $( this );
			var review_id  = $( this ).attr( 'data-resume-id' );
			var controllerAction = $( this ).attr( 'data-action' ); 	
			$.ajax( {
				//dataType: "json",
				url: "/main/"+ controllerAction,
				type: "post",
				data: { action: controllerAction, action_review: review_id },
				success: function( response ){
					response = $.parseJSON( response )
					console.log( typeof( response ) );
					app.find( '#reviews_section').html( response.reviews );
					app.find( '#review_form_section').html( response.form );

				},
				error:function(){
					$(".container_scroll").append('Error Occurred while fetching data.');
				}
			} )
		} )
			

	})
} )( jQuery );

function tableInitialization( id ){
	( function( $ ) {
		var default_options = {
				"sPaginationType": "full_numbers",
				"oLanguage": {
					"sLengthMenu": "Отображено _MENU_ записей на страницу",
					"sSearch": "Поиск:",
					"sZeroRecords": "Ничего не найдено - извините",
					"sInfo": "Показано с _START_ по _END_ из _TOTAL_ записей",
					"sInfoEmpty": "Показано с 0 по 0 из 0 записей",
					"sInfoFiltered": "(filtered from _MAX_ total records)",
					"oPaginate": {
						"sFirst": "Первая",
						"sLast":"Посл.",
						"sNext":"След.",
						"sPrevious":"Пред.",				
					} 
				}	
			};
		$( id ).dataTable( default_options );
	} )( jQuery );
}

function sendReview() {
	( function( $ ) {
		var msg   = $('#add_review_form').serialize();
		$.ajax({
			type: 'POST',
			url: "/main/save_review_form",
			data: msg,
			success: function( response ) {
				response = $.parseJSON( response )
				$( '#reviews_section' ).text( response );	
			},
			error:  function(xhr, str){
				alert('Возникла ошибка: ' + xhr.responseCode);
			}
		});
	} )( jQuery );
}