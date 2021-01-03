@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('Добавить язык')}} @endslot
            @slot('parent') {{__('Главная')}} @endslot
            @slot('local') {{__('Локализации сайта')}} @endslot
            @slot('active') {{__('Добавить язык')}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card card-body">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.locales.store')}}">

            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="title">{{__('Название')}}</label>
                    <input type="text" name="name" value="{{$item->name}}"
                           id="name" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="title">{{__('Кодировка')}}</label>
                    <input type="text" name="local" value="{{$item->local}}"
                           id="local" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="title">{{__('Сортировка')}}</label>
                    <input type="number" min="1" max="10" name="sort" value="{{$item->sort}}"
                           id="local" class="form-control" required>
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

            <button type="submit" class="btn btn-outline-primary btn-add">{{__('Сохранить')}}</button>
        </form>


    </section>
@endsection
