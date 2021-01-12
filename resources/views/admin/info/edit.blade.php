@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title'){{__('admin.info_project')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.info_project')}}@endslot
        @endcomponent
    </div>
    <!-- /.content-header -->

    <section class="content card card-body">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.info.update', $item->id)}}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
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
                                    $operating_time = 'operating_time_' . $locale->local;
                                    $content = 'content_' . $locale->local;
                                    $slogan = 'slogan_' . $locale->local;
                                @endphp
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="form-group">

                                            <label for="title">{{__('admin.name')}} {{$locale->local}}</label>

                                            <input type="text" name="{{$title}}" value="{{$item->$title}}"
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
                                            <label for="title">{{__('admin.slogan')}} {{$locale->local}}</label>
                                            <textarea class="form-control" id="slogan_{{$locale->local}}" rows="3"
                                                      name="{{$slogan}}">
                                                {{trim($item->$slogan) }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">{{__('admin.description')}} {{$locale->local}}</label>
                                            <textarea class="form-control" id="editor{{$loop->iteration + 3}}"
                                                      rows="3"
                                                      name="{{$description}}">
                                                  {{ trim($item->$description) }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">

                                            <label
                                                for="operating_time">{{__('admin.operating_time')}} {{$locale->local}}</label>
                                            <textarea class="form-control" id="operating_time" rows="3"
                                                      name="{{$operating_time}}"> {{ $item->$operating_time}}
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">{{__('Email')}}</label>
                                <input type="email" min="1" max="10" name="data_email" value="{{$item->data_email}}"
                                       id="local" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">{{__('1 телефон обязательно')}}</label>
                                <input type="tel" name="data_phone1" value="{{$item->data_phone1}}"
                                       id="local" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">{{__('2 телефон')}}</label>
                                <input type="tel" name="data_phone2" value="{{$item->data_phone2}}"
                                       id="local" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title"><i class="fab fa-facebook-f"></i> Facebook</label>
                                <input type="tel" name="facebook" value="{{$item->facebook}}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title"><i class="fab fa-youtube"></i> YouTube</label>
                                <input type="tel" name="youtube" value="{{$item->youtube}}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title"><i class="fab fa-instagram"></i> Instagram</label>
                                <input type="instagram" name="instagram" value="{{$item->instagram}}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">{{__('admin.head_code')}}</label>
                                <textarea class="form-control" id="header_code" rows="3"
                                          name="head_code">
                                {{ $item->head_code}}
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">{{__('admin.footer_code')}}</label>
                                <textarea class="form-control" id="footer_code" rows="3"
                                          name="footer_code">
                                    {{ $item->footer_code}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
                </div>
                <div class="col-sm-4">


                    <div class="form-group  admin__img-block">
                        <h5>{{__('info.logo')}} {{__('info.header')}}</h5>
                        @if($item->img)
                            <img class="admin__img-head" src="{{$item->img}}" alt="{{$item->title}}">
                        @else
                            <label class="admin__label-img" for="title">{{__('admin.download_logo')}}</label>
                        @endif
                        <input type="text" name="img" readonly="readonly" onclick="openKCFinder(this)"
                               value="{{$item->img}}" class="form-control button-kcfinder  btn btn-outline-success"
                               style="cursor:pointer"
                               placeholder="{{__('portfolio::admin.click-img')}}"
                               id="ckfinder-input-1"/>
                    </div>
                    <div class="form-group  admin__img-block">
                        <h5>{{__('info.logo')}} {{__('info.footer')}}</h5>
                        @if($item->img_footer)
                            <img class="admin__img-head" src="{{$item->img_footer}}" alt="{{$item->title}}">
                        @else
                            <label class="admin__label-img" for="title">{{__('admin.download_logo_footer')}}</label>
                        @endif

                        <input type="text" name="img_footer" readonly="readonly"
                               value="{{$item->img_footer}}"
                               placeholder="{{__('portfolio::admin.click-img')}}"
                               class="form-control button-kcfinder  btn btn-outline-success" style="cursor:pointer"
                               id="ckfinder-input-2"/>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
