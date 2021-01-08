@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('admin.edit')}} {{__('admin.item_menu')}} {{$item->title}}@endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('menu') {{__('admin.menus_site')}} @endslot
            @slot('active') {{__('admin.add')}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->

        <form method="POST" action="{{route('site.admin.menu_items.update', $item->id)}}">
            @method('PATCH')
            @csrf
            <div class="row">
                @forelse($locales as $locale)
                    @php
                        $title = 'title_' . $locale->local;

                    @endphp
                    <div class="form-group col-sm-6">

                        <label for="title">{{__('admin.name')}} {{$locale->local}}</label>

                        <input type="text" name="{{$title}}" value="{{$item->$title}}"
                               id="title" class="form-control">
                    </div>


                @empty
                    <h4>{{__('admin.none')}}</h4>
                @endforelse
                    <div class="form-group col-sm-4">

                        <label for="title">URL</label>

                        <input type="text" name="path" value="{{$item->path}}"
                               id="path" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">

                        <label for="title">{{__('admin.icon_cod')}}</label>

                        <input type="text" name="icon" value="{{$item->icon}}"
                               id="icon" class="form-control">
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="title">{{__('admin.sort')}}</label>
                        <input type="number" min="1" max="10" name="sort" value="{{$item->sort ?? 1}}"
                               id="local" class="form-control" required>
                    </div>
                    <div class="parent_id form-group col-sm-3">
                        <label for="title">{{__('admin.parent')}}</label>
                        <select type="text" name="1" value="{{$item->parent_id}}"
                                id="filter_id" class="form-control" placeholder="Выберите категорию" required>
                            <option value="null">{{__('admin.no_parent')}}</option>
                            @foreach($parentList as $parentOption)
                                <option value="{{$parentOption->id}}"
                                        @if($parentOption->id == $item->id) disabled="disabled" @endif
                                        @if($parentOption->id == $item->parent_id && $parentOption->id != 1) selected @endif>

                                    {{$parentOption->id_title}}
                                </option>
                            @endforeach
                        </select>
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
            <input type="hidden" name="menu_id" value="{{$item->menu_id}}">
            <button type="submit" class="btn btn-outline-success">{{__('Сохранить')}}</button>
        </form>


    </section>
@endsection
