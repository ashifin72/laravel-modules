@extends('admin..index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

        @component('admin.components.breadcrumb')
            @slot('title') {{__('blog.tags')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('tags') {{__('blog.tags')}} @endslot
            @slot('active') {{__('admin.add_tag')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.tags.store')}}" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <div class="col-sm-8">
                    @forelse($locales as $locale)
                        <div class="form-group">
                            <label for="title">{{__('admin.name')}} {{$locale->local}}</label>
                            @php
                                $title = 'title_' . $locale->local;
                            @endphp
                            <input type="text" name="title_{{$locale->local}}" value="{{$item->$title}}"
                                   id="title" class="form-control" required>
                        </div>

                    @empty
                        <h4>{{__('admin.none')}}</h4>
                    @endforelse
                </div>




            </div>

            <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
        </form>




    </section>
@endsection
