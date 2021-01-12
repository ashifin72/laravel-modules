@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

            @component('admin.components.breadcrumb')
                @slot('title') {{__('admin.edit') . ' ' . $item->name}} @endslot
                @slot('parent') {{__('admin.home')}} @endslot
                @slot('comments') {{__('admin.title_comments')}} @endslot
                @slot('active') {{__('admin.edit')}} @endslot
            @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.comments.update', $item->id)}}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-sm-8">

                    <div class="form-group">
                        <label for="title">{{__('admin.text_comment')}}</label>
                        <textarea class="form-control" id="editor1" rows="9" name="text">
                                {{old('text', $item->text)}}
                                    </textarea>
                    </div>
                </div>

                <div class=" col-sm-4">
                    @if($item->status == 0)
                        <div class="alert alert-default-danger">
                            {{__('admin.disabled')}}
                        </div>
                    @else
                        <div class="alert alert-primary">
                            {{__('admin.active')}}
                        </div>
                    @endif
                        <div class="form-group">
                            <label for="title">{{__('admin.author')}}</label>
                            <input type="text" name="name" value="{{$item->name}}"
                                   id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="title">E-MAIL</label>
                            <input type="text" name="email" value="{{$item->email}}"
                                   id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('admin.post_comment')}}</label>
                            <input type="hidden" name="blog_post_id" value="{{$item->blog_post_id}}">
                            <div class="alert alert-secondary" role="alert">
                                {{mb_substr($item->parentPost->title ?? '?', 0, 25, 'utf-8')}}
                            </div>

                        </div>




                </div>


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
                <label for="status" class="form-check-label">{{__('admin.publish')}}</label>
            </div>

            <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
        </form>

        <form method="post" onsubmit='return false' action="{{route('admin.comments.destroy', $item->id)}}">
            @method('DELETE')
            @csrf
            <div class="row justify-content-start" style="margin-top: 25px">
                <button type="submit" onclick=' confirm("Точно видалити?") ? this.form.submit() : ""'
                        class="btn btn-outline-danger">{{__('Удалить запись')}}</button>
            </div>
        </form>


    </section>
@endsection
