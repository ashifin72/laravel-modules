@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.categories_blog')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.categories_blog')}} @endslot
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
                    <th>{{__('admin.mini_img')}}</th>
                    <th>{{__('admin.parent')}}</th>

                </tr>
                </thead>
                <tbody>

                @forelse($items as $item)
                    @if($item->id != 1)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>@if($item->icon)
                                    {!!($item->icon)!!}
                                @else
                                    <i class="fas fa-ban"></i>
                                @endif
                            </td>
                            <td @if(in_array($item->parent_id, [0, 1])) style="color:#cccccc" @endif>
                                {{ $item->parentTitle }}
                            </td>


                            <td>
                                <a class="btn btn-outline-success"
                                   href="{{route('admin.categories.edit', $item->id )}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                            </td>
                            <td>
                                <form
                                    action="{{ route('admin.categories.destroy', $item->id) }}"
                                    method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Подтвердите удаление')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="6">{{__('admin.article_none')}}</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <a class="btn btn-outline-success btn-add"
           href="{{route('admin.categories.create')}}">{{__('admin.add_article')}}
        </a>
        <br>

            <div class="card-body clearfix admin-paginate">
                {{ $items->links() }}
            </div>

    </section>


@endsection
