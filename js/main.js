jQuery(document).on('submit','#formlogin', function(event){
	event.preventDefault();

	jQuery.ajax({
		url: 'verificar_usu.php',
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
			$('.boton').val('Validando...');
		}
	})
	.done(function(respuesta) {
		console.log(respuesta);
		if (!respuesta.error) {
			if (respuesta.tipo == '0') {
				location.href = 'administrador';
			} else if (respuesta.tipo == '1') {
				location.href = "usuario";
			}
		} else{
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
			},3000);
			$('.boton').val('Iniciar Sesión');
		}
	})
	.fail(function(resp) {
		console.log(resp.responseText);
	})
	.always(function() {
		console.log("complete");
	});
});
