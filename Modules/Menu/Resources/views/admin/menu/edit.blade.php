@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{$item->name}}@endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('menu') {{__('admin.menus_site')}} @endslot
            @slot('active') {{$item->name}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card card-body">
        <!-- Small boxes (Stat box) -->

    @php $menu_id = $item->id  @endphp
        <div class="row">
            <div class="col-sm-10">
                <form method="POST" action="{{route('site.admin.menu.update', $item->id)}}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="title">{{__('Название')}}</label>
                            <input type="text" name="name" value="{{$item->name}}"
                                   id="name" class="form-control" required>
                        </div>
                        <div class="form_check col-sm-2" style="margin-top: 40px">
                            <input type="hidden" name="status" value="0">

                            <input type="checkbox"
                                   name="status"
                                   class="form-check-input"
                                   value="1"
                                   @if ($item->status)
                                   checked="checked"
                                @endif
                            >
                            <label for="status" class="form-check-label">{{__('Опубликованно')}}</label>
                        </div>
                        <div class="col-sm-4" style="margin-top: 34px">
                            <button type="submit" class="btn btn-outline-success">{{__('Сохранить')}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-2">
                @if($item->id)
                    <form method="post" onsubmit='return false' action="{{route('site.admin.menu.destroy', $item->id)}}">
                        @method('DELETE')
                        @csrf
                        <div class="row justify-content-start" style="margin-top: 34px">
                            <button type="submit" onclick=' confirm("Точно удалить?") ? this.form.submit() : ""' class="btn btn-outline-danger">{{__('Удалить запись')}}</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>


        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th></th>
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.status')}}</th>
            </tr>
            </thead>
            <tbody>

            </tr>
            @forelse($menuItems as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td style="text-align: center">{!! $item->icon !!}</td>
                    <td>{{$item->title}}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="">{{__('admin.active')}}</span>
                        @else <span class="">{{__('admin.disabled')}}</span>
                        @endif
                    </td>

                    <td>
                        <a class="btn btn-outline-success" href="{{route('site.admin.menu_items.edit', $item->id )}}">{{__('admin.edit')}}</a>
                    </td>
                    <td>
                        <form method="post" onsubmit='return false' action="{{route('site.admin.menu_items.destroy', $item->id)}}">
                            @method('DELETE')
                            @csrf
                            <div class="row justify-content-start">
                                <button type="submit" onclick=' confirm("Точно удалить?") ? this.form.submit() : ""' class="btn btn-outline-danger">{{__('Удалить запись')}}</button>
                            </div>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6">{{__('admin.article_none')}}</td>


                </tr>
            @endforelse
            <tr>

                <td colspan="6">
                    <form action="{{route('site.admin.menu_items.create')}}" method="get">
                        <input type="hidden" name="menu_id" value="{{$menu_id}}">
                        <button type="submit" class="btn btn-outline-success" >{{__('admin.add')}} {{__('admin.menu')}}</button>
                    </form>
                </td>

            </tr>

            </tbody>
        </table>



    </section>
@endsection
