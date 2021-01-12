@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.menus_site')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.menus_site')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="card card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.status')}}</th>
                </tr>
                </thead>
                <tbody>

                </tr>
                @forelse($items as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>


                            <td>
                                @if ($item->status == 1)
                                <span class="">{{__('admin.active')}}</span>
                                @else <span class="">{{__('admin.disabled')}}</span>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-outline-success" href="{{route('admin.menus.edit', $item->id )}}">{{__('admin.edit')}}</a>
                            </td>
                            <td>
                                <form action="{{route('admin.menu_items.create')}}" method="get">
                                    <input type="hidden" name="menu_id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-outline-success" >{{__('admin.add')}} {{__('admin.item_menu')}}</button>
                                </form>
                            </td>
                        </tr>

                @empty
                    <tr>
                        <th colspan="6">{{__('admin.article_none')}}</th>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <a class="btn btn-outline-success btn-add" href="{{route('admin.menus.create')}}">{{__('admin.add')}}</a>
    </section>
@endsection
