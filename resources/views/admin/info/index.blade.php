@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('Онформация о фирме')}} @endslot
            @slot('parent') {{__('Главная')}} @endslot
            @slot('active') {{__('Локации')}} @endslot
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
                    <th>{{__('Название')}}</th>
                    <th>{{__('Логотип')}}</th>
                    <th>{{__('Локализация')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td><span class="tag tag-success">{{$item->img}}</span></td>

                            <td>
                                {{$item->parentInfo->local ?? '?'}}
                            </td>
                            <td>
                                <a href="{{route('site.admin.info.edit', $item->id )}}">{{__('Редактировать')}}</a>
                            </td>
                        </tr>

                @endforeach


                </tbody>
            </table>
        </div>


    </section>
@endsection
