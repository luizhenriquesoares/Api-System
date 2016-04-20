<div class="btn-group">

    @if($item->isActive())
        <a href='javascript:void(0);' route="{{ route("manager.{$helper->controller}.status", $item->id) }}" rel="{{ $item->status }}" class="btn btn-inverse btn-xs statusBtn" title="[Ativo] - Clique para desativar" onclick="checkStatus(this)">
            <i class="fa fa-check-circle-o"></i>
        </a>
    @else
        <a href="javascript:void(0);" route="{{ route("manager.{$helper->controller}.status", $item->id) }}" rel="{{ $item->status }}" class="btn btn-inverse btn-xs statusBtn" title="[Inativo] - Clique para ativar" onclick="checkStatus(this)">
            <i class="fa fa-circle"></i>
        </a>
    @endif

	@if($properties['show'])
	<a title="Detalhes" href="{{ route($helper->actionTable.'.show', $item->id) }}" class="btn btn-xs btn-success m-b-sm">
		<i class="fa fa-search"></i>
	</a>
	@endif

    @if($properties['edit'])
        <a title="Editar" href="{{ route($helper->actionTable.'.edit', $item->id) }}" class="btn btn-xs btn-info m-b-sm">
            <i class="fa fa-edit"></i>
        </a>
    @endif

	@if($properties['destroy'] || $properties['trash'])
	<div class="btn-group m-b-sm">
		<button type="button" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-remove"></i> &nbsp; <span class="caret"></span>
		</button>
		<ul class="dropdown-menu btn-xs" role="menu">
			@if($properties['destroy'])
				<li><a href="{{ route($helper->actionTable.'.destroy', $item->id) }}" class="destroy btn-xs"><i class="fa fa-remove"></i> COMPLETAMENTE</a></li>
			@endif
			@if($properties['trash'])
				<li><a href="{{ route($helper->actionTable.'.trash', $item->id) }}" class="btn-xs"><i class="fa fa-trash"></i> LIXEIRA</a></li>
			@endif
		</ul>
	</div>
	@endif

	@if(isset($flagAirport) && $flagAirport)
		@include($helper->base . 'partials.actions.tax')
	@endif

	@if($helper->controller == 'quotation' && $helper->properties['quotation'])
		@include($helper->base . 'partials.actions.quotations')
	@endif

</div>