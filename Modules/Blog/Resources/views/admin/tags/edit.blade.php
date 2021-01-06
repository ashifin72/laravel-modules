@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{$item->title}}@endslot

                @slot('parent') {{__('admin.home')}} @endslot
                @slot('tags') {{__('blog.tags')}} @endslot
                @slot('active') {{__('admin.edit')}} {{$item->title}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card-body card">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.tags.update', $item->id)}}" enctype="multipart/form-data">
            @method('PATCH')
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

                <div class=" col-sm-4">

                    <div class="form-group">
                        <label for="slug">URL {{__('admin.slug_generate')}}</label>
                        <input type="text" name="slug" value="{{$item->slug}}"
                               id="slug" class="form-control">
                    </div>
                </div>


            </div>

            <input type="hidden" name="id" value="{{$item->id}}">
            <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>



        </form>

            <form method="post" onsubmit='return false' action="{{route('admin.tags.destroy', $item->id)}}">
                @method('DELETE')
                @csrf
                <div class="row justify-content-start" style="margin-top: 25px">
                        <button type="submit" onclick=' confirm("Точно видалити?") ? this.form.submit() : ""' class="btn btn-outline-danger">{{__('Удалить запись')}}</button>
                </div>
            </form>



    </section>
@endsection
