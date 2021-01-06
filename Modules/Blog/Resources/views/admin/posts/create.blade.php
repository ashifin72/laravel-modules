@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.add_article')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('posts') {{__('admin.blog_articles')}} @endslot
            @slot('active') {{__('admin.add_article')}} @endslot
        @endcomponent


    </div>

    <section class="content card-body card">

        <form method="POST" action="{{route('admin.posts.store', $item->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8 ">
                    @include('blog::admin.posts.includes.item_edit_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog::admin.posts.includes.item_edit_add_col')
                </div>

            </div>
        </form>
    </section>
@endsection
