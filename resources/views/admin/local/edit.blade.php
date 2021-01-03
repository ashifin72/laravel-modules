@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{$item->name}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('local') {{__('admin.locales')}} @endslot
            @slot('active') {{__('admin.edit ')}}{{$item->name}}@endslot
        @endcomponent
    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.locales.update', $item->id)}}">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="title">{{__('admin.name')}}</label>
                    <input type="text" name="name" value="{{$item->name}}"
                           id="name" class="form-control" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="title">Кодировка</label>
                    <input type="text" name="local" value="{{$item->local}}"
                           id="local" class="form-control" required>
                </div>
                <div class="form-group col-sm-2">
                    <label for="title">{{__('admin.sort')}}</label>
                    <input type="number" min="1" max="10" name="sort" value="{{$item->sort}}"
                           id="local" class="form-control" required>
                </div>
                <div class="col-sm-2">
                    <img class="local-img" src="{{asset('/assets/img/local')}}/{{$item->local}}.png" alt="">
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
                <label for="status" class="form-check-label">Опубликованно</label>
            </div>
            <input type="hidden" name="id" value="{{$item->id}}">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>


    </section>
@endsection
