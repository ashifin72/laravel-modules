@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('Список пользователей')}} @endslot
            @slot('parent') {{__('Главная')}} @endslot
            @slot('active') {{__('Список пользователей')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="card card-body table-responsive p-0 box">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('admin.user')}}</th>
                    <th>{{__('admin.photo_users')}}</th>
                    <th>{{__('E-mail')}}</th>
                    <th>{{__('admin.status')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    @if(!isset($items))
                        <tr>
                            <td>{{__('На сайте не загруженно ни одного пользователя!!')}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                @if($item->img == null)
                                    <img style="width: 50px" src="{{asset('/assets/admin/img/logo-mini.png')}}"
                                         alt="{{$item->name}}">
                                @else <img style="width: 50px" src="{{asset('uploads/' . $item->img)}}" alt="{{$item->name}}">
                                @endif
                            </td>
                            <td>{{$item->email}}</td>

                            <td>
                                {{$item->role}}
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{route('admin.users.edit', $item->id )}}">{{__('admin.edit')}}</a>
                            </td>
                            <td>
                                <form method="post" onsubmit='return false' action="{{route('admin.users.destroy', $item->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="row justify-content-start">
                                        <button type="submit" onclick=' confirm("Точно видалити?") ? this.form.submit() : ""' class="btn btn-outline-danger">{{__('admin.remove')}}</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach


                </tbody>
            </table>
        </div>

        <a class="btn btn-outline-success" href="{{route('admin.users.create')}}">{{__('Добавить')}}</a>

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
