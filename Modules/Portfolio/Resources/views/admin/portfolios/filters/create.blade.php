@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('admin.add')}} {{__('admin.portfolio_filter')}}@endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('filters') {{__('admin.portfolio_filter')}} @endslot
            @slot('active') {{__('admin.add')}} {{__('admin.portfolio_filter')}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('site.admin.filters.store', $item->id)}}" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <div class="col-sm-8">
                    @forelse($locales as $locale)
                        <div class="form-group">


                            <label for="title">{{__('admin.name')}} {{$locale->local}}</label>
                            @php
                                $title = 'title_' . $locale->local;
                                $description = 'description_' . $locale->local;
                                $content = 'content_' . $locale->local;
                            @endphp
                            <input type="text" name="title_{{$locale->local}}" value="{{$item->$title}}"
                                   id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('admin.description')}} {{$locale->local}}</label>
                            <textarea class="form-control" id="description{{$loop->iteration}}" rows="3" name="description_{{$locale->local}}">
                                {{ $item->$description}}
                                    </textarea>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('admin.text')}} {{$locale->local}}</label>
                            <textarea class="form-control" id="editor{{$loop->iteration}}" rows="9" name="{{$content}}">
                                {{ $item->$content}}
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

                    <div class="form-group">
                        <label for="title">{{__('admin.sort')}}</label>
                        <input type="number" min="1" max="10" name="sort" value="{{$item->sort}}"
                               id="local" class="form-control" required>
                    </div>
                    <div class="form-group">

                        <label for="slug">@if($item->img) <img class="admin__img-head" src="{{$item->img}}" alt="{{$item->img_alt}}">


                            {{__('admin.replace_photo')}}
                            @else <i class="fas fa-images"></i> {{__('Загрузить фото')}}
                            @endif
                        </label>
                        <input type="text" name="img" readonly="readonly" onclick="openKCFinder(this)"
                               value="{{$item->img}}" class="form-control btn btn-outline-success" />

                    </div>
                </div>
            </div>

        </form>
    </section>
@endsection
