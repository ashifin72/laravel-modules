<div class="admin__post-colum">
    @isset($item->slug)
        <a class="btn btn-outline-primary" href="{{route('site.front.blog.show', $item->slug )}}"
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
        <label for="title">{{__('admin.created_at')}}</label>
        <input type="text" class="form-control" value="{{$item->created_at}}">
    </div>
    <div class="form-group">
        <label for="title">{{__('admin.update_at')}}</label>
        <input type="text" class="form-control" value="{{$item->updated_at}}">
    </div>

</div>
