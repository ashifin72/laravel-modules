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
                    <th>
                        <a class="btn btn-outline-success float-right" href="{{route('admin.users.create')}}">{{__('Добавить')}}</a>
                    </th>
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
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route('admin.users.edit', $item->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form
                                    action="{{ route('admin.users.destroy', $item->id) }}"
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
                    @endif
                @endforeach


                </tbody>
            </table>
        </div>



        <div class="card card-footer clearfix admin-paginate">
            {{ $items->links() }}
        </div>
    </section>

@endsection
