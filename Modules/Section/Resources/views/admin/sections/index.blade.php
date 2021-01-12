@extends('admin.index')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    @component('admin.components.breadcrumb')
      @slot('title') {{__('admin.sections')}} @endslot
      @slot('parent') {{__('admin.home')}} @endslot
      @slot('active') {{__('admin.sections')}} @endslot
    @endcomponent


  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{__('admin.sections')}}</h3>

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
        <table class="table table-hover text-nowrap">
          <thead>
          <tr>
            <th>ID</th>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.mini_img')}}</th>
            <th>{{__('admin.sort')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>
              <a class="btn btn-outline-success btn-create-header mr-2"
                 href="{{route('admin.sections.create')}}">{{__('admin.add')}}</a>
            </th>

          </tr>
          </thead>
          @forelse($items as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->title}}</td>
              <td>
                @if($item->img)
                <img style="width: 50px" src="{{asset($item->img)}}" alt="{{$item->title}}">
                  @else
                  <i class="far fa-times-circle ml-4"></i>
                  @endif
              </td>
              <td><span class="tag tag-success ml-4">{{$item->sort}}</span></td>
              <td>
                @if ($item->status == 1)
                  <span class="badge badge-success">{{__('admin.active')}}</span>
                @else <span class="badge badge-danger">{{__('admin.disabled')}}</span>
                @endif
              </td>

              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="{{route('admin.sections.show', $item->id )}}">
                  <i class="fas fa-folder">
                  </i>
                  View
                </a>
                <a class="btn btn-info btn-sm" href="{{route('admin.sections.edit', $item->id )}}">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
                </a>
                <form
                  action="{{ route('admin.sections.destroy', $item->id) }}"
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

          @empty

          @endforelse

        </table>
      </div>
    </div>
    <!-- Small boxes (Stat box) -->

    <div class="card card-footer clearfix admin-paginate">
      {{ $items->links() }}
    </div>

  </section>
@endsection
