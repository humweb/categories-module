@section('title')
    Categories -
    @parent
@stop

@section('content')
    <div class="card card-default card-nestable card-sidebar">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <th colspan="2">Name</th>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.category.get.update', [$category->id]) }}" class="btn btn-primary btm-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('subnav')
    <a href="/admin/categories/create" class="btn btn-primary">New category</a>
@endsection