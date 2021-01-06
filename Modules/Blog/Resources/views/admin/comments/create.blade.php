@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

        @component('admin.components.breadcrumb')
            @if(isset($parent_comment))
            @slot('title') {{__('admin.answer') . ' ' . $parent_comment->name}} @endslot
            @else
                @slot('title') {{__('admin.create_comment')}} @endslot
            @endif
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('comments') {{__('admin.title_comments')}} @endslot
            @slot('active') {{__('admin.edit')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.comments.store')}}">

            @csrf
            <div class="row">
                <div class="col-sm-8">
                    <div class="alert alert-secondary" role="alert">
                        <h4>{{__('admin.text_comment')}}</h4>
                        {!! $parent_comment->text !!}
                    </div>

                    <div class="form-group">
                        <label for="title">{{__('admin.answer')}}</label>
                        <textarea class="form-control" id="editor1" rows="9" name="text">
                                {{old('text', $item->text)}}
                                    </textarea>
                    </div>
                </div>

                <div class=" col-sm-4">
                    <div class="form-group">
                        <label for="title">{{__('admin.author')}}</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                               id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title">E-MAIL</label>
                        <input type="text" name="email" value="{{ Auth::user()->email }}"
                               id="email" class="form-control" required>
                    </div>
                        <input type="hidden" name="parent_id" value="{{$parent_comment->id}}">
                    <div class="form-group">
                        <label for="title">{{__('admin.post_comment')}}</label>
                        <input type="hidden" name="blog_post_id" value="{{$parent_comment->blog_post_id}}">
                        <div class="alert alert-secondary" role="alert">
                            {{mb_substr($parent_comment->parentPost->title ?? '?', 0, 25, 'utf-8')}}
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="status" value="1">

            <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
        </form>
    </section>
@endsection
