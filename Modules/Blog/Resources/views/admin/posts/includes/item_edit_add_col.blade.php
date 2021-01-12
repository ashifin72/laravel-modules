<div class="admin__post-colum">
    @isset($item->slug)
        <a class="btn btn-outline-primary" href=""
           role="button">{{__('admin.more')}} »</a>
    @endisset

    <div class="parent_id form-group">
        <label for="title">{{__('admin.categories_blog')}}</label>
        <select type="text" name="category_id" value="{{$item->category_id}}"
                id="category_id" class="form-control" placeholder="Выберите категорию" required>
            @foreach($categoryList as $categoryOption)
                <option value="{{$categoryOption->id}}"
                        @if($categoryOption->id == $item->category_id) selected @endif>
                    {{--                                        {{$categoryOption->id}}. {{$categoryOption->title}}--}}
                    {{$categoryOption->id_title}}
                </option>
            @endforeach
        </select>
    </div>
    @isset($item->img)
        <img class="responsive" style="width: 230px" src="/uploads/{{$item->img}}"
             alt="{{$item->title}}">
    @endisset

    <div class="form-group">

        <div for="slug" class="mt-2">
            @if($item->img) <img style="width: 50px" src="/uploads/{{$item->img}}"
                                 alt="{{$item->title}}">
            {{__('admin.replace_img')}}
            @else <i class="fas fa-images"></i> {{__('admin.upload_img')}}
            @endif
        </div>

        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="img" id="img"
                       class="custom-file-input">
                <label class="custom-file-label" for="img">{{__('admin.mini_img')}}</label>
            </div>
        </div>
    </div>
    <div class="form_check">
        <input type="hidden" name="status_img" value="0">
        <div class="row p-1 pl-3 mb-4">
            <div class="col-1"><input type="checkbox"
                                      name="status_img"
                                      class="form-check-input"
                                      value="1"
                                      @if ($item->status_img == 1)
                                      checked="checked"
                    @endif
                ></div>
            <div class="col-11 ml-2">
                <label for="is_published" class="form-check-label">{{__('admin.no use an image in an article')}}</label>
            </div>
        </div>


    </div>
    <div class="form-group">
        <label for="tags">{{__('blog.tags')}}</label>
        <select name="tags[]" id="tags" class="select2" multiple="multiple"
                data-placeholder="Выбор тегов" style="width: 100%;">

            @php($title = 'title_' . app()->getLocale())

            @foreach($tagsList as $tag)
                <option value="{{ $tag->id}}"
                        @if(in_array($tag->id, $item->tags->pluck('id')->all())) selected @endif>
                    {{ $tag->$title }}
                </option>
            @endforeach
        </select>
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
