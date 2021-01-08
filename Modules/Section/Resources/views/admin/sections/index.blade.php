@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('admin.sections')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.sections')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="card-body table-responsive p-0 card">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('admin.name')}}</th>

                    <th>{{__('admin.status')}}</th>

                </tr>
                </thead>
                @forelse($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="">{{__('admin.active')}}</span>
                            @else <span class="">{{__('admin.disabled')}}</span>
                            @endif
                        </td>

                        <td>
                            <a class="btn btn-outline-success" href="{{route('site.admin.sections.edit', $item->id)}}">{{__('admin.edit')}}</a>
                        </td>
                        <td>
                            <a class="btn btn-outline-success" href="{{route('site.admin.sections.show', $item->id)}}">{{__('admin.show')}}</a>
                        </td>

                    </tr>

                @empty

                @endforelse

            </table>
        </div>

        <a class="btn btn-outline-success btn-add"
           href="{{route('site.admin.sections.create')}}">{{__('admin.add')}}</a>
    </section>
@endsection
