@extends('admin.index')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.title')}} @endslot
            @slot('parent') {{__('admin.home')}}@endslot
            @slot('active')  @endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content">
        <!-- Small boxes (Stat box) -->
      <div class="card-body card">

      </div><div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$countPost}}</h3>
              <p>{{__('admin.blog_articles')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-language" aria-hidden="true"></i>
            </div>
            <a href="{{ route('admin.posts.index') }}" class="small-box-footer">{{__('admin.more')}} <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$countPortfolio}}</h3>
              <p>{{__('admin.portfolio_article')}}</p>
            </div>
            <div class="icon">
              <i class="far fa-address-card"></i>
            </div>
            <a href="{{ route('admin.portfolios.index') }}" class="small-box-footer">{{__('admin.more')}}
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$countUsers}}</h3>
              <p>{{__('admin.users')}}</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="{{route('admin.users.index')}}" class="small-box-footer">{{__('admin.more')}} <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$countSection}}</h3>
              <p>{{__('admin.sections')}}</p>
            </div>
            <div class="icon">
              <i class="fas fa-images"></i>
            </div>
            <a href="{{route('admin.sections.index')}}" class="small-box-footer">{{__('admin.more')}} <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

        <div class="card-body card">
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> {{$item->title}}

                        <small class="float-right"><a class="btn btn-outline-success"
                                                      href="{{route('admin.info.edit', 1)}}">{{__('admin.edit')}}</a></small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                    <address>
                        <strong>{{__('admin.info')}}</strong><br>
                        {!! $item->data_site !!}<br>
                        {{$item->data_email}}<br>
                        {{$item->data_phone1}}<br>
                        {{$item->data_phone2}}<br>
                        @if($item->data_phone3)
                            {{$item->data_phone3}}
                        @endif
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">


                        <strong>{{__('admin.operating_time')}}</strong><br>
                        {!! $item->operating_time !!}

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>{{__('admin.logo')}}</b><br>
                    <br>
                    <img src="{{asset($item->img)}}" alt="{{$item->title}}">
                </div>

                <!-- /.col -->
            </div>

        </div>


    </section>
@endsection
