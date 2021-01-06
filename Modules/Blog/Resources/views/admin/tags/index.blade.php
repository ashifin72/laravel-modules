@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <a class="btn btn-outline-success btn-add"
           href="{{route('admin.tags.create')}}">{{__('admin.add_article')}}
        </a>
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

                </tr>
                </thead>
                <tbody>

                @forelse($items as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->slug}}</td>
                            <td>
                                <a class="btn btn-outline-success"
                                   href="{{route('admin.tags.edit', $item->id )}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                            </td>
                            <td>
                                <form
                                    action="{{ route('admin.tags.destroy', $item->id) }}"
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

                @empty
                    <tr>
                        <td colspan="6">{{__('admin.article_none')}}</td>
                    </tr>
                @endforelse
            </table>
        </div>


    </section>

    @if($items->total() > $items->count())

        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>{{count($items)}} {{__('admin.entries_from')}} {{$items->total()}} </p>
                        {{$items->links()}}
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
