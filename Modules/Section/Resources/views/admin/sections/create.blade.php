@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('admin.add')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('sections') {{__('admin.sections')}} @endslot
            @slot('active') {{__('admin.add')}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('site.admin.sections.store', $item->id)}}">
            @csrf
            <div class="row">
                <div class="col-sm-8">
                    @forelse($locales as $locale)
                        @php
                            $title = 'title_' . $locale->local;
                            $slogan = 'slogan_' . $locale->local;
                            $description = 'description_' . $locale->local;
                        @endphp
                        <div class="form-group">

                            <label for="title">{{__('admin.name')}} {{$locale->local}}</label>

                            <input type="text" name="title_{{$locale->local}}" value="{{$item->$title}}"
                                   id="title" class="form-control" required>
                        </div>
                        <div class="form-group">

                            <label for="title">{{__('admin.slogan')}} {{$locale->local}}</label>

                            <input type="text" name="{{$slogan}}" value="{{$item->$slogan}}"
                                   id="{{$slogan}}" class="form-control">
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

                    <button type="submit" class="btn btn-primary">{{__('Сохранить')}}</button>
                </div>
                <div class="col-sm-3">

                    <div class="form-group">
                        <label for="title">{{__('Сортировка')}}</label>
                        <input type="number" min="1" max="10" name="sort" value="{{$item->sort ?? 1}}"
                               id="local" class="form-control" required>
                    </div>
                    @isset($item->img)
                        <img class="responsive" style="width: 230px" src="{{$item->img}}"
                             alt="{{$item->title}}">
                    @endisset
                    <div class="form-group">
                        <label for="slug" class="mt-2">@if($item->img) <img style="width: 50px" src="{{$item->img}}"
                                                                            alt="{{$item->title}}">


                            {{__('admin.replace_img')}}
                            @else <i class="fas fa-images"></i> {{__('admin.upload_img')}}
                            @endif
                        </label>
                        <input type="text" name="img" readonly="readonly" onclick="openKCFinder(this)"
                               value="{{$item->img}}" class="form-control btn btn-outline-success" style="cursor:pointer"/>
                    </div>
                </div>

            </div>

        </form>


    </section>
@endsection