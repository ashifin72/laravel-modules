@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.locales')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.locales')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content">
        <!-- Small boxes (Stat box) -->


            <form class="row  main_localization" action="{{route('main_localization')}}" method="post">
                @csrf
                <div class="form-group col-6">

                    <label for="title">{{__('admin.main_localization')}}</label>
                    <select type="text" name="id"

                            id="local_id" class="form-control" required>
                        @foreach($items as $item)
                            @if($item->status == 1)
                            <option value="{{$item->id}}"
                            @if($item->favorite == 1)selected @endif >
                                {{$item->name}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
                </div>
            </form>

        <div class="card-body table-responsive p-0 card">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('admin.name')}}</th>
                    <th class="text-center">{{__('admin.locale')}}</th>
                    <th class="text-center">{{__('admin.sort')}}</th>
                    <th>{{__('admin.status')}}</th>
                    <th class="text-center">{{__('admin.favorite')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr @if($item->status == 0) style="background: #e0e0e0"   @endif>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td class="text-center">{{$item->local}}</td>
                        <td class="text-center"><span class="tag tag-success">{{$item->sort}}</span></td>
                        <td class="text-center">
                            @if ($item->status == 1)
                                <span class="">{{__('admin.active')}}</span>
                            @else <span class="">{{__('admin.disabled')}}</span>
                            @endif
                        </td>
                        <td class="text-center">

                            @if($item->favorite == 1)
                                <i class="far fa-star"></i>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{route('admin.locales.edit', $item->id )}}">{{__('Изменить')}}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center"><h2>{{__('admin.none')}}</h2></td>
                    </tr>


                @endforelse


                </tbody>
            </table>
        </div>


    </section>
@endsection
