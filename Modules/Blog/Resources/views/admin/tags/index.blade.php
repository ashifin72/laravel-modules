@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

        @component('admin.components.breadcrumb')
            @slot('title') {{__('blog.tags')}} @endslot

            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('blog.tags')}} @endslot
        @endcomponent

    </div>
    <!-- /.content-header -->

    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="card-body table-responsive p-0 card">

            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.slug')}}</th>
                    <th>
                        <a class="btn btn-outline-success btn-add"
                           href="{{route('admin.tags.create')}}">{{__('admin.add_article')}}
                        </a>
                    </th>

                </tr>
                </thead>
                <tbody>

                @forelse($items as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->slug}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{route('admin.tags.edit', $item->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form
                                    action="{{ route('admin.tags.destroy', $item->id) }}"
                                    method="post" class="float-right ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Подтвердите удаление')">
                                        <i class="fas fa-trash">
                                        </i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                @empty
                    <tr>
                        <td colspan="6">{{__('admin.article_none')}}</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div class="card card-footer clearfix admin-paginate">
            {{ $items->links() }}
        </div>
    </section>



@endsection
