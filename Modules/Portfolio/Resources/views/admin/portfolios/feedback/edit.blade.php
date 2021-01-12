@extends('admin.index')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    @component('admin.components.breadcrumb')
      @slot('title') {{$item->title}}@endslot
      @slot('parent') {{__('admin.home')}} @endslot
      @slot('feedback') {{__('admin.feedback')}} @endslot
      @slot('active') {{$item->title}}@endslot
    @endcomponent


  </div>
  <!-- /.content-header -->

  <section class="content card-body card">
    <!-- Small boxes (Stat box) -->


    <form method="POST" action="{{route('admin.portfolio_feedback.update', $item->id)}}" enctype="multipart/form-data">
      @method('PATCH')
      @csrf
      <div class="row">
        <div class="col-sm-8">
          @forelse($locales as $locale)
            @php
              $title = 'title_' . $locale->local;
              $description = 'description_' . $locale->local;
              $name = 'name_' . $locale->local;
            @endphp
            <div class="form-group">

              <label for="title">{{__('admin.name')}} {{$locale->local}}</label>
              <input type="text" name="title_{{$locale->local}}" value="{{$item->$title}}"
                     id="title" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="name">{{__('admin.name_feedback')}} {{$locale->local}}</label>
              <input type="text" name="name_{{$locale->local}}" value="{{$item->$name}}"
                     id="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="title">{{__('admin.text')}} {{$locale->local}}</label>
              <textarea class="form-control content-editor_{{$locale->local}}"
                        id="editor_{{$locale->local}}" rows="9"
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
            <label for="status" class="form-check-label">{{__('admin.is_published')}}</label>
          </div>
          <input type="hidden" name=id value="{{$item->id}}">

          <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
        </div>
        <div class="col-sm-4">
          @if($item->status == 1)
            <div class="alert alert-default-success" role="alert">
              {{__('admin.is_published')}}
            </div>
          @else
            <div class="alert alert-default-danger" role="alert">
              {{__('admin.disabled')}}
            </div>

          @endif

          <div class="form-group">
            <label for="title">{{__('admin.sort')}}</label>
            @php $sort =  $item->sort ?? 1 @endphp
            <input type="number" min="1" max="10" name="sort" value="{{$sort}}"
                   id="local" class="form-control" required>
          </div>
          <div class="parent_id form-group">
            <label for="portfolio_id">{{__('admin.portfolio_filter')}}</label>

            <select type="text" name="portfolio_id" value="{{$item->portfolio_id}}"
                    id="portfolio_id" class="form-control" placeholder="Выберите">
              @foreach($feedbackList as $feedbackOption)
                <option value="{{$feedbackOption->id}}"
                        @if($feedbackOption->id == $item->portfolio_id) selected @endif>
                  {{$feedbackOption->id_title}}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">

            <label for="slug">@if($item->img) <img class="admin__img-head" src="{{$item->img}}"
                                                   alt="{{$item->title}}">


              {{__('admin.replace_photo')}}
              @else <i class="fas fa-images"></i> {{__('Загрузить фото')}}
              @endif
            </label>
              <input type="text" name="img" readonly="readonly"
                     id="ckfinder-input-1"
                     placeholder="{{__('portfolio::admin.click-img')}}"
                     value="{{$item->img}}" class="form-control btn btn-outline-success" />

          </div>
          <div class="form-group">

            <label for="slug">@if($item->sreen) <img class="admin__img-head" src="{{$item->sreen}}"
                                                     alt="{{$item->img_alt}}">


              {{__('admin.sreen')}}
              @else <i class="fas fa-images"></i> {{__('Загрузить фото')}}
              @endif
            </label>
            <input type="text" name="screen" readonly="readonly"
                   id="ckfinder-input-2"
                   placeholder="{{__('portfolio::admin.click-img')}}"
                   value="{{$item->sreen}}" class="form-control btn btn-outline-success"/>

          </div>
          <div class="form-group">
            <label for="title">{{__('admin.created_at')}}</label>
            <input type="text" class="form-control" value="{{$item->created_at}}" disabled>
          </div>
          <div class="form-group">
            <label for="title">{{__('admin.update_at')}}</label>
            <input type="text" class="form-control" value="{{$item->updated_at}}" disabled>
          </div>
        </div>
      </div>

    </form>

    <form method="post" onsubmit='return false' action="{{route('admin.portfolio_feedback.destroy', $item->id)}}">
      @method('DELETE')
      @csrf
      <div class="row justify-content-start ml-1" style="margin-top: 25px">
        <button type="submit" onclick=' confirm("to precisely remove?") ? this.form.submit() : ""'
                class="btn btn-outline-danger">{{__('admin.remove')}}</button>
      </div>
    </form>


  </section>
@endsection
