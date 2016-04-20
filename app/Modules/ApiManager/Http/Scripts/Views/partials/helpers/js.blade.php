<script type="text/javascript">

	/**
	 * Ajudante com seus atributos
	 * @type {Object}
	 */
	var helper      = JSON.parse('{!! json_encode($helper) !!}');
	/**
	 * Model Usuário
	 * @type {Object}
	 */
	var userAuth    = JSON.parse('{!! json_encode(/*$user?$user:*/[]) !!}');
	/**
	 * URL BASE
	 * @type {string}
	 */
	var BASE = '{{ url('/') }}';

	/**
	 * LaraToken
	 * @type {String}
	 */
	var TOKEN = '{!! csrf_token() !!}';

	/**
	 * Valor de troca
	 * @type {String}
	 */
	var SWAPVALUE = function()
	{
		return document.getElementById('swapDataFunctions').value;
	};

	/**
	 * Constants
	 */

	const CSS_PATH  = '/assets/manager/css/';
	const JS_PATH   = '/assets/manager/js/';
	const IMG_PATH  = '/assets/manager/images/';
	const PLUG_PATH = '/assets/manager/plugins/';

	/**
	 * Ativos
	 * @type {number}
	 */
	const ACTIVE                    = 1;
	/**
	 * Inativos
	 * @type {number}
	 */
	const UNACTIVE                  = 0;

	/**
	 * Ordem de passagme ativa
	 * @type {number}
	 */
	const OP_ATIVA                  = 1;

	/**
	 * Ordem de passagem cancelada
	 * @type {number}
	 */
	const OP_CANCELADA              = 0;

	/**
	 * Ordem de passagem aguardando pagamento
	 * @type {number}
	 */
	const OP_AGUARDANDO_PAGAMENTO   = 2;

	/**
	 * Ordem de passagem em análise
	 * @type {number}
	 */
	const OP_ANALISE                = 3;

	/**
	 * Ordem de passagem faturada
	 * @type {number}
	 */
	const OP_FATURADA               = 4;

	/**
	 * Tipo de viagem de ida
	 * @type {number}
	 */
	const TYPE_TRIP_STARTING        = 0;

	/**
	 * Tipo de viagem de volta
	 * @type {number}
	 */
	const TYPE_TRIP_BACK            = 1;

	/**
	 * @param route
	 * @returns {*}
	 */
	function getRoute(route, param)
	{
		var url = BASE + '/manager/index/lara-helper';

		$.post(url, { type : "ROUTE", value : route, param : param, _token : TOKEN }, swapping);

		return SWAPVALUE();
	}

	/**
	 * Realizar troca de valores
	 * @param response
	 */
	function swapping(response)
	{
		document.getElementById('swapDataFunctions').value = response;
	}

</script>
{!! Form::hidden('__generated', null, ['id' => 'swapDataFunctions']) !!}