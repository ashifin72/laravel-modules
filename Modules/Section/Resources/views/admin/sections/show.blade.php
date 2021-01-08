@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title'){{__('admin.show')}} {{$item->title}}@endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('sections') {{__('admin.sections')}} @endslot
            @slot('active') {{__('admin.show')}} {{$item->name}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card card-body">
        <!-- Small boxes (Stat box) -->


        <div class="card-body table-responsive p-0 card">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('admin.name')}}</th>
                    <th>

                    </th>

                    <th>{{__('admin.status')}}</th>

                </tr>
                </thead>
                @forelse($sectItems as $sectItem)
                    <tr>
                        <td>{{$sectItem->id}}</td>
                        <td>{{$sectItem->title}}</td>
                        <td>@isset($sectItem->img)
                                <img style="width: 80px" src="{{$sectItem->img}}" alt="{{$sectItem->title}}">
                            @endisset
                        </td>
                        <td>
                            @if ($sectItem->status == 1)
                                <span class="">{{__('admin.active')}}</span>
                            @else <span class="">{{__('admin.disabled')}}</span>
                            @endif
                        </td>

                        <td>
                            <a class="btn btn-outline-success"
                               href="{{route('site.admin.section_items.edit', $sectItem->id)}}">{{__('admin.edit')}}</a>
                        </td>
                        <td>
                            <form method="post" onsubmit='return false'
                                  action="{{route('site.admin.section_items.destroy', $sectItem->id)}}">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-outline-danger" type="submit"
                                        onclick=' confirm("Точно удалить?") ? this.form.submit() : ""'
                                        class="btn btn-primary">{{__('Удалить запись')}}</button>

                            </form>

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="4">
                            {{__('admin.article_none')}}
                        </td>
                    </tr>

                @endforelse

            </table>
            <form action="{{route('site.admin.section_items.create')}}" method="get">
                <input type="hidden" name="section_id" value="{{$item->id}}">
                <button type="submit" class="btn btn-outline-success">{{__('admin.add')}}</button>
            </form>

        </div>


    </section>
@endsection
