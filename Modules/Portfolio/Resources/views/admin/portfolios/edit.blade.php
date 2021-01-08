@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{$item->title}}@endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('portfolios') {{__('admin.portfolio')}} @endslot
            @slot('active') {{$item->title}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('site.admin.portfolios.update', $item->id)}}" enctype="multipart/form-data">
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

                                            <label for="title">{{__('admin.customer')}} {{$locale->local}}</label>

                                            <input type="text" name="{{$customer}}" value="{{$item->$customer}}"
                                                   id="title" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">{{__('admin.text')}} {{$locale->local}}</label>
                                            <textarea class="form-control" id="editor{{$loop->iteration}}" rows="10"
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
                        <div class="alert alert-success" role="alert">
                            {{__('admin.is_published')}}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            {{__('admin.disabled')}}
                        </div>

                    @endif
                        <div class="alert alert-default-dark" role="alert">
                            <a href="{{route('portfolio.show', $item->slug)}}">{{__('admin.look_article')}}</a>
                        </div>

                    <div class="form-group">
                        <label for="title">URL</label>
                        <input type="text" name="slug" value="{{$item->slug}}"
                               id="title" class="form-control">


                    </div>

                        <div class="parent_id form-group">
                            <label for="title">{{__('admin.portfolio_filter')}}</label>
                            <select type="text" name="filter_id" value="{{$item->filter_id}}"
                                    id="filter_id" class="form-control" placeholder="Выберите категорию" required>
                                @foreach($filterList as $filterOption)
                                    <option value="{{$filterOption->id}}"
                                            @if($filterOption->id == $item->filter_id) selected @endif>
                                        {{--                                        {{$categoryOption->id}}. {{$categoryOption->title}}--}}
                                        {{$filterOption->id_title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <div class="form-group">
                        <label for="title">{{__('admin.sort')}}</label>
                        <input type="number" min="1" max="10" name="sort" value="{{$item->sort}}"
                               id="local" class="form-control" required>
                    </div>
                    <div class="form-group">

                        <label for="slug">@if($item->img) <img class="admin__img-head" src="{{asset($item->img)}}"
                                                               alt="{{$item->title}}">


                            {{__('admin.replace_photo')}}
                            @else <i class="fas fa-images"></i> {{__('admin.download')}}
                            @endif
                        </label>
                        <input type="text" name="img" readonly="readonly" onclick="openKCFinder(this)"
                               value="{{$item->img}}" class="form-control btn btn-outline-success"/>

                    </div>
                        <div class="form-group">
                            <label for="title">URL {{__('admin.project_s')}}</label>
                            <input type="text" name="url_site" value="{{$item->url_site}}"
                                   id="url_site" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="title">CMS {{__('admin.project_s')}}</label>
                            <input type="text" name="cms_site" value="{{$item->cms_site}}"
                                   id="cms_site" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="title">{{__('admin.time_site')}} {{__('admin.project_s')}}</label>
                            <input type="int" name="time_site" value="{{$item->time_site}}"
                                   id="cms_site" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="title">{{__('admin.created_at')}} {{$item->created_at}}</label>
                            <input type="date" name="created_at" class="form-control mydate" value="{{$item->created_at}}" >
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('admin.update_at')}} {{$item->updated_at}}</label>
                            <input type="date" name="updated_at" class="form-control mydate" value="{{$item->updated_at}}" >
                        </div>

                </div>
            </div>

        </form>

        <form method="post" onsubmit='return false' action="{{route('site.admin.portfolios.destroy', $item->id)}}">
            @method('DELETE')
            @csrf
            <div class="row justify-content-start ml-1" style="margin-top: 25px">
                <button type="submit" onclick=' confirm("to precisely remove?") ? this.form.submit() : ""'
                        class="btn btn-outline-danger">{{__('admin.remove')}}</button>
            </div>
        </form>


    </section>
@endsection
