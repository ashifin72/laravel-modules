@extends('admin.index')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    @component('admin.components.breadcrumb')
      @slot('title') {{__('portfolio::admin.feedback')}} @endslot
      @slot('parent') {{__('admin.home')}} @endslot
      @slot('active') {{__('portfolio::admin.feedback')}} @endslot
    @endcomponent


  </div>
  <!-- /.content-header -->

  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{__('portfolio::admin.portfolio_article')}}</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                  title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>

      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
          <tr>
            <th>ID</th>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.name_feedback')}}</th>
            <th>{{__('admin.site')}}</th>
            <th>{{__('admin.sort')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>
              <a class="btn btn-outline-success btn-add" href="{{route('admin.portfolio_feedback.create')}}">
                {{__('admin.add')}} {{__('portfolio::admin.feedback')}}
              </a>
            </th>

          </tr>
          </thead>
          <tbody>
          @forelse($items as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->title}}</td>
              <td><img style="width: 50px" src="{{asset($item->img)}}" alt="{{$item->title}}"></td>
              <td><img style="width: 50px" src="{{asset($item->parentPortfolios->img)}}" alt="{{$item->title}}"></td>


              <td><span class="tag tag-success">{{$item->sort}}</span></td>
              <td>
                @if ($item->status == 1)
                  <span class="">{{__('admin.active')}}</span>
                @else <span class="">{{__('admin.disabled')}}</span>
                @endif
              </td>

              <td>
                <a class="btn btn-info btn-sm" href="{{route('admin.portfolio_feedback.edit', $item->id)}}">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
                </a>
                <form
                  action="{{ route('admin.portfolio_feedback.destroy', $item->id) }}"
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
            <tr>
              <th colspan="5">{{__('admin.article_none')}}</th>
            </tr>

          @endforelse


          </tbody>
        </table>
      </div>
    </div>

      <div class="card card-footer clearfix admin-paginate">
          {{ $items->links() }}
      </div>
  </section>

@endsection
