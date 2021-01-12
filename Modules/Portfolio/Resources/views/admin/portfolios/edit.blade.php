@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{$item->title}}@endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('portfolios') {{__('portfolio::admin.portfolio')}} @endslot
            @slot('active') {{$item->title}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.portfolios.update', $item->id)}}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <div class="row">
                <div class="col-sm-8">

                    <ul class="nav nav-tabs" id="nav-tab" role="tablist">

                        @php $i=1   @endphp
                        @forelse($locales as $locale)
                            <li class="nav-item">
                                <a class="nav-link @if($i==1) active @endif" data-toggle="tab"
                                   href="#{{$locale->local}}">{{__('admin.version')}} {{$locale->local}}</a>
                            </li>
                            @php $i++   @endphp
                        @empty
                            <h4>{{__('admin.none')}}</h4>
                        @endforelse

                    </ul>
                    <div class="tab-content">
                        @php $i=1   @endphp
                        @forelse($locales as $locale)

                            <div class="tab-pane fade @if($i==1) show active @endif" id="{{$locale->local}}">
                                @php
                                    $title = 'title_' . $locale->local;
                                    $description = 'description_' . $locale->local;
                                    $customer = 'customer_' . $locale->local;
                                    $content = 'content_' . $locale->local;
                                @endphp
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="form-group">

                                            <label for="title">{{__('admin.name')}} {{$locale->local}}</label>

                                            <input type="text" name="{{$title}}" value="{{$item->$title}}"
                                                   id="title" class="form-control" required>
                                        </div>
                                        <div class="form-group">

                                            <label for="title">{{__('portfolio::admin.customer')}} {{$locale->local}}</label>

                                            <input type="text" name="{{$customer}}" value="{{$item->$customer}}"
                                                   id="title" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">{{__('admin.text')}} {{$locale->local}}</label>
                                            <textarea class="form-control content-editor_{{$locale->local}}"
                                                      id="editor{{$loop->iteration}}" rows="10"
                                                      name="{{$content}}">
                                {{ $item->$content}}
                                    </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">{{__('admin.description')}} {{$locale->local}}</label>
                                            <textarea class="form-control" id="description{{$loop->iteration}}" rows="3"
                                                      name="{{$description}}">
                                {{ $item->$description}}
                                    </textarea>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            @php $i++   @endphp
                        @empty
                            <h4>{{__('admin.none')}}</h4>
                        @endforelse
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
                    <div class="alert alert-default-dark" role="alert">
                        <a href="">{{__('admin.look_article')}}</a>
                    </div>

                    <div class="form-group">
                        <label for="title">URL</label>
                        <input type="text" name="slug" value="{{$item->slug}}"
                               id="title" class="form-control">


                    </div>

                    <div class="parent_id form-group">
                        <label for="title">{{__('portfolio::admin.portfolio_category')}}</label>
                        <select type="text" name="portfolio_categories_id" value="{{$item->filter_id}}"
                                id="portfolio_categories_id" class="form-control" placeholder="Выберите категорию"
                                required>
                            @foreach($categoryList as $categoryOption)
                                <option value="{{$categoryOption->id}}"
                                        @if($categoryOption->id == $item->filter_id) selected @endif>

                                    {{$categoryOption->id_title}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">{{__('admin.sort')}}</label>
                        <input type="number" min="1" max="10" name="sort" value="{{$item->sort ?? 1}}"
                               id="local" class="form-control" required>
                    </div>
                    <div class="form-group">

                        <label for="slug">@if($item->img) <img class="admin__img-head" src="{{asset($item->img)}}"
                                                               alt="{{$item->title}}">


                            {{__('portfolio::admin.replace_photo')}}
                            @else <i class="fas fa-images"></i> {{__('admin.download')}}
                            @endif
                        </label>
                        <input type="text" name="img" readonly="readonly"
                               id="ckfinder-input-1"
                               value="{{$item->img}}" class="form-control btn btn-outline-success"/>

                    </div>
                    <div class="form-group">
                        <label for="title">URL {{__('portfolio::admin.project_s')}}</label>
                        <input type="text" name="url_site" value="{{$item->url_site}}"
                               id="url_site" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="title">CMS {{__('portfolio::admin.project_s')}}</label>
                        <input type="text" name="cms_site" value="{{$item->cms_site}}"
                               id="cms_site" class="form-control">

                    </div>
                    <div class="form-group">
                        <label
                            for="title">{{__('portfolio::admin.time_site')}} {{__('portfolio::admin.project_s')}}</label>
                        <input type="int" name="time_site" value="{{$item->time_site}}"
                               id="cms_site" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="title">{{__('admin.created_at')}} {{$item->created_at}}</label>
                        <input type="date" name="created_at" class="form-control mydate" value="{{$item->created_at}}">
                    </div>
                    <div class="form-group">
                        <label for="title">{{__('admin.update_at')}} {{$item->updated_at}}</label>
                        <input type="date" name="updated_at" class="form-control mydate" value="{{$item->updated_at}}">
                    </div>

                </div>
            </div>

        </form>

        <form method="post" onsubmit='return false' action="{{route('admin.portfolios.destroy', $item->id)}}">
            @method('DELETE')
            @csrf
            <div class="row justify-content-start ml-1" style="margin-top: 25px">
                <button type="submit" onclick=' confirm("to precisely remove?") ? this.form.submit() : ""'
                        class="btn btn-outline-danger">{{__('admin.remove')}}</button>
            </div>
        </form>


    </section>
@endsection
