@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{$item->name}}@endslot

                @slot('parent') {{__('admin.home')}} @endslot
                @slot('category') {{__('admin.categories_blog')}} @endslot
                @slot('active') {{__('admin.add_category')}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('site.admin.category.update', $item->id)}}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-sm-8">

                    @forelse($locales as $locale)
                        <div class="form-group">


                            <label for="title">{{__('admin.name')}} {{$locale->local}}</label>
                            @php
                                $title = 'title_' . $locale->local;
                                $description = 'description_' . $locale->local;
                            @endphp
                            <input type="text" name="title_{{$locale->local}}" value="{{$item->$title}}"
                                   id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('admin.text')}} {{$locale->local}}</label>
                            <textarea class="form-control" id="editor{{$loop->iteration}}" rows="9" name="description_{{$locale->local}}">
                                {{ $item->$description}}
                                    </textarea>
                        </div>

                    @empty
                        <h4>{{__('admin.none')}}</h4>
                    @endforelse
                </div>

                <div class=" col-sm-4">

                    <div class="parent_id form-group">
                        <label for="title">{{__('admin.parent')}}</label>
                        <select type="text" name="parent_id" value="{{$item->parent_id}}"
                                id="parent_id" class="form-control" required>
                            @foreach($categoryList as $categoryOption)

                                <option value="{{$categoryOption->id}}"
                                        @if($categoryOption->id == $item->id || $categoryOption->parent_id == $item->id ) disabled="disabled" @endif
                                        @if($categoryOption->id == $item->parent_id) selected @endif>
                                    {{--                                        {{$categoryOption->id}}. {{$categoryOption->title}}--}}
                                    {{$categoryOption->id_title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slug">URL {{__('admin.slug_generate')}}</label>
                        <input type="text" name="slug" value="{{$item->slug}}"
                               id="slug" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">{{__('Сортировка')}}</label>
                        <input type="number" min="1" max="10" name="sort" value="{{$item->sort ?? 1}}"
                               id="local" class="form-control" required>
                    </div>
                    <div class="form-group">

                            @if($item->icon) {{__('admin.icon_cod')}} <a href="https://fontawesome.com/icons?d=gallery" target="_blank">fontawesome</a>
                        <label for="slug"> {!! $item->icon !!}
                            @else {{__('admin.replace')}} {{__('admin.icon_cod')}}
                            <label for="slug"> <i class="fas fa-images"></i>
                                <a href="https://fontawesome.com/icons?d=gallery" target="_blank">fontawesome</a>
                            @endif
                        </label>

                        <input type="text" name="icon" value="{{$item->icon}}"
                               id="icon" class="form-control">

                    </div>


                </div>


            </div>

            <input type="hidden" name="id" value="{{$item->id}}">
            <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>



        </form>

            <form method="post" onsubmit='return false' action="{{route('site.admin.category.destroy', $item->id)}}">
                @method('DELETE')
                @csrf
                <div class="row justify-content-start" style="margin-top: 25px">
                        <button type="submit" onclick=' confirm("Точно видалити?") ? this.form.submit() : ""' class="btn btn-outline-danger">{{__('Удалить запись')}}</button>
                </div>
            </form>



    </section>
@endsection
