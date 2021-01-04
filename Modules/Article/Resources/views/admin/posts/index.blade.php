@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.blog_articles')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.blog_articles')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <div class="container content card card-body">
        <div class="row justify-content-center">
            <div class="col-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a href="{{route('admin.posts.create')}}" class="btn btn-primary">{{__('admin.add_article')}}</a>
                </nav>
                <div class="card">

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>{{__('admin.mini_img')}}</th>
                                <th>{{__('admin.name')}}</th>

                                <th>{{__('admin.category')}}</th>
                                <th>{{__('admin.status')}}</th>
                                <th>{{__('admin.created_at')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)

                                <tr @if(!$item->status == 1) style="background:#cccccc" @endif>
                                    <td class="">
                                        {{$item->id}}
                                    </td>
                                    <td >
                                        <img class="admin__thumbnail" src="{{$item->img}}" alt="{{$item->title}}">

                                    </td>
                                    <td class="">
                                        <a href="{{route('admin.posts.edit', $item->id)}}">{{mb_substr($item->title, 0, 40, 'utf-8')}}</a>

                                    </td>

                                    <td class="">
                                        {{$item->category->title}}
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="">{{__('admin.active')}}</span>
                                        @else <span class="">{{__('admin.disabled')}}</span>
                                        @endif
                                    </td>

                                    <td >
                                        {!! $item->created_at !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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

    </div>
@endsection

