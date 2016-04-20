function scroll_to(div){
	$('html, body').animate({
		scrollTop: $(div).offset().top
	}, 500);
}

function animate(alvo, tamanho, velocidade){
	$(alvo).animate({
		height: tamanho
	}, velocidade);
}

/**
 * Função auto-excutavel previnir conflito.
 */

(function($){


	$(document).ready(function(){

			/**
			 * Botão para ir ao topo do site
			 * @type {jQuery|*|Mixed|HTMLElement}
			 */
			var btnTop = $(".btn-footer-top");


		if($('#resumo-pedido').length > 0)
		{
			var valorTop = $('#resumo-pedido').offset().top;
			var resumo = parseInt(valorTop);

			$(window).scroll(function () {
				if ($(window).scrollTop() > resumo) {

					$('#resumo-pedido').addClass('fixed');

				} else {
					$('#resumo-pedido').removeClass('fixed');

				}


			});
		}

			/**
			 * função para fazer o btnTop aparecer
			 */
			$(window).scroll(function () {
				if ($(this).scrollTop() > 500) {
					btnTop.fadeIn();
				} else {
					btnTop.fadeOut();
				}
			});

			/**
			 * evento para levar o scroll ao topo do site
			 */
			btnTop.click(function () {

				$('html, body').animate({
					scrollTop: 0
				}, 890);

				return false;
			});


	});


})(jQuery);