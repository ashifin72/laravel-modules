@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('admin.add')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('menu') {{__('admin.menus_site')}} @endslot
            @slot('active') {{__('admin.add')}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('site.admin.menu.store')}}">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="title">{{__('admin.add')}}</label>
                    <input type="text" name="name" value="{{$item->name}}"
                           id="name" class="form-control" required>
                </div>
            </div>
            <div class="form_check" style="margin: 25px">
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

            <button type="submit" class="btn btn-outline-success">{{__('Сохранить')}}</button>
        </form>


    </section>
@endsection
