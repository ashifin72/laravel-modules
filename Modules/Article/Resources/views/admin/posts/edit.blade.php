@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('admin.edit') . ' ' . $item->title}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('posts') {{__('admin.blog_articles')}} @endslot
            @slot('active') {{__('admin.edit')}} @endslot
        @endcomponent


    </div>
<section class="content card card-body">
    <form method="POST" action="{{route('site.admin.post.update', $item->id)}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('site.admin.blog.posts.includes.item_edit_main_col')
            </div>
            <div class="col-md-3">
                @include('site.admin.blog.posts.includes.item_edit_add_col')
            </div>

        </div>
    </form>
    <br>
    <form class="admin__btn-destroy" method="post" action="{{route('site.admin.post.destroy', $item->id)}}">
        @method('DELETE')
        @csrf
        <div class="row justify-content-start" style="margin-top: 25px">
            <button type="submit" onclick=' confirm("Точно видалити?") ? this.form.submit() : ""' class="btn btn-outline-danger">{{__('admin.remove')}}</button>
        </div>

    </form>
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="card-body table-responsive p-0 card">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('admin.author')}}</th>
                    <th>{{__('admin.status')}}</th>

                </tr>
                </thead>
                <tbody>


                @forelse($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->name}}</td>

                        <td>
                            @if ($comment->status == 1)
                                <span class="">{{__('admin.active')}}</span>
                            @else <span class="">{{__('admin.disabled')}}</span>
                            @endif
                        </td>


                        <td >
                            <a href="{{route('site.admin.comments.edit', $comment->id )}}">{{__('admin.edit')}}</a>
                        </td>
                        <td >
                            <a href="{{route('site.admin.comments.edit', $comment->id )}}">{{__('admin.reply')}}</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">{{$comment->text}}</td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6">{{__('admin.article_none')}}</td>
                    </tr>
                @endforelse


                </tbody>
            </table>
        </div>


    </section>

</section>
@endsection
