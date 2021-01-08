@extends('site.admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('site.admin.components.breadcrumb')
            @slot('title') {{__('admin.portfolio_article')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.portfolio_article')}} @endslot
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
                    <th>{{__('admin.mini_img')}}</th>
                    <th>{{__('admin.sort')}}</th>
                    <th>{{__('admin.portfolio_filter')}}</th>
                    <th>{{__('admin.status')}}</th>

                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{mb_substr($item->title, 0, 20, 'utf-8')}}</td>
                            <td><img style="width: 50px" src="{{asset($item->img)}}" alt="{{$item->img_alt}}"></td>
                            <td><span class="tag tag-success">{{$item->sort}}</span></td>
                            <td>
                                {{$item->parentFilters->title ?? '?'}}
                            </td>
                            <td>
                                @if ($item->status == 1)
                                <span class="">{{__('admin.active')}}</span>
                                @else <span class="">{{__('admin.disabled')}}</span>
                                @endif
                            </td>


                            <td>
                                <a class="btn btn-outline-success" href="{{route('site.admin.portfolios.edit', $item->id )}}">{{__('admin.edit')}}</a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <th colspan="5">{{__('admin.article_none')}}</th>
                    </tr>

                @endforelse


                </tbody>
            </table>
        </div>

        <a class="btn btn-outline-success btn-add" href="{{route('site.admin.portfolios.create')}}">{{__('admin.add')}}</a>
    </section>
    @if ($items->total() > $items->count())

        <div class="row justify-content-center">
            <div class="col-auto card">
                <div class="card-body">
                    <p>{{count($items)}} {{__('admin.entries_from')}} {{$countCallery}} </p>
                    {{$items->links()}}
                </div>
            </div>
        </div>
    @endif
@endsection
