@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.title_comments')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('active') {{__('admin.title_comments')}} @endslot
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
                    <th>{{__('admin.author')}}</th>
                    <th>{{__('admin.status')}}</th>
                    <th>{{__('admin.post_comment')}}</th>
                </tr>
                </thead>
                <tbody>


                @forelse($items as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>

                            <td>
                                @if ($item->status == 1)
                                    <span class="alert alert-primary"><i class="fab fa-creative-commons-share"></i></span>
                                @else <span class="alert alert-default-danger"><i class="far fa-bell-slash"></i></span>
                                @endif
                            </td>

                            <td>
                                {{mb_substr($item->parentPost->title ?? '?', 0, 25, 'utf-8')}}

                            </td>
                            <td >
                                <a class="btn btn-outline-success" href="{{route('admin.comments.edit', $item->id )}}">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>
                            <td >
                                <form method="get"  action="{{route('admin.comments.create')}}">
                                    <input type="hidden" name="parent_id" value="{{$item->id}}">
                                    <button class="btn btn-outline-secondary" type="submit">{{__('admin.reply')}}</button>
                                </form>

                            </td>
                            <td >
                                <form method="post" onsubmit='return false' action="{{route('admin.comments.destroy', $item->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="row justify-content-start">
                                        <button type="submit" onclick=' confirm("Точно видалити?") ? this.form.submit() : ""' class="btn btn-outline-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </form>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">{!! $item->text !!}</td>
                        </tr>

                @empty
                    <tr>
                        <td colspan="7">{{__('admin.article_none')}}</td>
                    </tr>
                    @endforelse


                    </tbody>
            </table>
        </div>

        <div class="card card-footer clearfix admin-paginate">
            {{ $items->links() }}
        </div>
    </section>

@endsection
