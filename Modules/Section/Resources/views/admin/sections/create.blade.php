@extends('admin.index')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    @component('admin.components.breadcrumb')
      @slot('title') {{__('admin.add')}} @endslot
      @slot('parent') {{__('admin.home')}} @endslot
      @slot('sections') {{__('admin.sections')}} @endslot
      @slot('active') {{__('admin.add')}}@endslot
    @endcomponent
  </div>
  <!-- /.content-header -->
  <section class="content card-body card">
    <div class="card-header">
      <h3 class="card-title">{{__('admin.sections')}} {{__('admin.add')}}</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body p-0">
      <form method="POST" action="{{route('admin.sections.store', $item->id)}}">
        @csrf
        <div class="row">
          <div class="col-sm-9">
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
                <textarea
                  class="form-control content-editor_{{$locale->local}}"
                  id="editor{{$loop->iteration}}" rows="9"
                  name="description_{{$locale->local}}">
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
            <input type="hidden" name="{{$item->id}}">
            <button type="submit" class="btn btn-primary">{{__('Сохранить')}}</button>
          </div>
          <div class="col-sm-3">

            <div class="form-group">
              <label for="title">{{__('Сортировка')}}</label>
              <input type="number" min="1" max="10" name="sort"
                     value="{{$item->sort ?? 1}}"
                     id="local" class="form-control" required>
            </div>
            @isset($item->img)
              <img class="responsive" style="width: 230px" src="{{$item->img}}"
                   alt="{{$item->title}}">
            @endisset
            <div class="form-group">
              <label for="slug" class="mt-2">@if($item->img)
                  <img style="width: 50px" src="{{$item->img}}" alt="{{$item->title}}">
                  {{__('admin.replace_img')}}
                @else <i class="fas fa-images"></i> {{__('admin.upload_img')}}
                @endif
              </label>
              <input type="text" name="img" readonly="readonly"
                     placeholder="{{__('portfolio::admin.click-img')}}"
                     value="{{$item->img}}"
                     id="ckfinder-input-1"
                     class="form-control btn btn-outline-success ckfinder-input-1" style="cursor:pointer"/>
            </div>
          </div>

        </div>

      </form>
    </div>

  </section>
@endsection
