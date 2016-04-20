<div class="page-title">

    <div class="page-breadcrumb">
        <ol class="breadcrumb">

            <li>
                <a href="{{ url('/') }}">Home</a>
            </li>

            @if($helper->controller !== "index" && !$helper->hasParent)
            <li>
                <a href="{{ route("{$helper->controller}.index") }}">{{ ucwords($helper->controller) }}</a>
            </li>
            @endif

            @if($helper->hasParent)
                <li>
                    <a href="{{ route("{$helper->parent}.index") }}">{{ ucwords($helper->parent) }}</a>
                </li>
                @if($data->id)
                    <li>
                        <a href="{{ route("{$helper->parent}.{$helper->controller}.show", $data->id) }}">{{ ucwords($helper->controller) }}</a>
                    </li>
                @endif
            @endif

            @if($helper->action !== "index")
            <li class="active">
                {{ ucwords($helper->action) }}
            </li>
            @endif

        </ol>
    </div>

</div>