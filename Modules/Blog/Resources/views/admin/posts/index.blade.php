@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.blog_articles')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.blog_articles')}} @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 40%">
                            {{__('admin.name')}}
                        </th>
                        <th style="width: 10%">
                            {{__('admin.mini_img')}}
                        </th>
                        <th style="width: 15%">
                            {{__('admin.category')}}
                        </th>
                        <th style="width: 5%" class="text-center">
                            {{__('admin.status')}}
                        </th>
                        <th style="width: 35%">
                            <a href="{{route('admin.posts.create')}}"
                               class="btn btn-outline-success float-right mr-2">{{__('admin.add_article')}}</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)

                        <tr @if(!$item->status == 1) style="background:#cccccc" @endif>
                            <td class="">
                                {{$item->id}}
                            </td>
                            <td><a href="{{route('admin.posts.edit', $item->id)}}">
                                    {{mb_substr($item->title, 0, 40, 'utf-8')}}
                                </a>
                                <br>
                                <small>{!! $item->created_at !!}</small>
                            </td>
                            <td class="">
                                @if($item->img)
                                    <img class="admin__thumbnail" src="/uploads/{{$item->img}}" alt="{{$item->title}}">
                                @else
                                    <img class="admin__thumbnail" src="/uploads/images/posts/logo-mini.png" alt="{{$item->title}}">
                                @endif
                            </td>

                            <td class="">
                                {{$item->category->title}}
                            </td>
                            <td class="project-state">
                                @if ($item->status == 1)
                                    <span class="badge badge-success">{{__('admin.active')}}</span>
                                @else <span class="badge badge-danger">{{__('admin.disabled')}}</span>
                                @endif
                            </td>

                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route('admin.posts.edit', $item->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form
                                    action="{{ route('admin.posts.destroy', $item->id) }}"
                                    method="post" class="float-right ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Подтвердите удаление')">
                                        <i class="fas fa-trash">
                                        </i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card card-footer clearfix admin-paginate">
            {{ $items->links() }}
        </div>

    </section>



@endsection

