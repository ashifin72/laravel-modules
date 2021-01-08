
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#description">{{__('admin.master_data')}}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#multimedia">{{__('admin.additional_data')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#seo_sahre">SEO</a>
            </li>
            <li class="nav-item">
                @if($item->status == 1)
                    <div class="alert alert-success" role="alert">
                        {{__('admin.is_published')}}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{__('admin.disabled')}}
                    </div>

                @endif
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="description">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="form-group">
                            <label for="slug">{{__('admin.url_data')}}</label>
                            <input type="text" name="slug" value="{{$item->slug}}"
                                   id="slug" class="form-control">
                        </div>
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
                                <label for="content">{{__('admin.text')}} {{$locale->local}}</label>
                                <textarea class="form-control content-editor_{{$locale->local}}" id="editor{{$loop->iteration}}" rows="10" name="{{$content}}">
                                {{ $item->$content}}
                                    </textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('admin.description')}} {{$locale->local}}</label>
                                <textarea class="form-control description-editor" id="editor{{$loop->iteration + 10}}" rows="1" name="description_{{$locale->local}}">
                                {{ $item->$description}}
                                    </textarea>
                            </div>


                        @empty
                            <h4>{{__('admin.none')}}</h4>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="multimedia">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title"><i class="fab fa-youtube-square"></i> URL
                                YouTube</label>
                            <input type="text" name="youtube" value="{{$item->youtube}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="description"><i class="fas fa-code"></i> {{__('admin.video_code')}}</label>
                        <textarea class="form-control" id="video" rows="2" name="video">
                                {!! old('description', $item->video)!!}
                                    </textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title"><i class="fab fa-github"></i> GitHub</label>
                        <input type="text" name="github" value="{{$item->github}}"
                               class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title"><i class="fas fa-download"></i>{{__('admin.sharing_service')}}</label>
                        <input type="text" name="file_sharing" value="{{$item->file_sharing}}"
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="seo_sahre">
                <div class="form-group">
                    <label for="keywords">{{__('admin.keywords')}}</label>
                    <input type="text" name="keywords" value="{{$item->keywords}}"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="slug">{{__('admin.name')}} {{__('admin.for_social')}}</label>
                    <input type="text" name="title_soc" value="{{$item->title_soc}}"
                           class="form-control">
                </div>


                <div class="form-group">
                    <label for="description">{{__('admin.description')}} {{__('admin.for_social')}}</label>
                    <textarea class="form-control" id="description_soc" rows="2" name="description_soc">
                                {!! old('soc_description', $item->description_soc) !!}
                                    </textarea>
                </div>
            </div>
        </div>

        <div class="form_check" style="margin-left: 25px">
            <input type="hidden" name="status" value="0">

            <input type="checkbox"
                   name="status"
                   class="form-check-input"
                   value="1"
                   @if ($item->status == 1)
                   checked="checked"
                @endif
            >
            <label for="is_published" class="form-check-label">{{__('admin.is_published')}}</label>

        </div>
        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="cardrd">
            <div class="card-body">
                <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
            </div>
        </div>









