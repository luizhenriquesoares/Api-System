<table id="data-table-{{$helper->controller}}" class="display table" style="width: 100%; cellspacing: 0;">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Permissão</th>
        <th>Criado</th>
        <th>Modificado</th>
        <th>Ação</th>
    </tr>
    </thead>
    {{--<tbody>--}}
    {{--@foreach($data as $item)--}}
        {{--<tr>--}}
            {{--<td>{{ $item->fullname }}</td>--}}
            {{--<td>{{ $item->email }}</td>--}}
            {{--<td>{{ $item->roles->display_name }}</td>--}}
            {{--<td>{{ Helper::formatDate($item->created_at, "Y-m-d") }}</td>--}}
            {{--<td>{{ Helper::formatDate ($item->updated_at, "Y-m-d") }}</td>--}}
            {{--<td>--}}
                {{--@include($helper->base . 'partials.actions.default', [$item, 'properties' => $helper->properties])--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    <tfoot>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Permissão</th>
        <th>Criado</th>
        <th>Modificado</th>
        <th>Ação</th>
    </tr>
    </tfoot>
</table>
