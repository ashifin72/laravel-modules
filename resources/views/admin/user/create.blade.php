@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{__('admin.create_user')}} @endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('users') {{__('admin.users')}} @endslot
            @slot('active') {{__('admin.create_user')}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card card-body">
        <!-- Small boxes (Stat box) -->


        <form method="POST" action="{{route('admin.users.store')}}" enctype="multipart/form-data" data-toggle="validator">
            @csrf
            <div class="box-body row">
                <div class="form-group has-feedback col-sm-6">
                    <label for="name">{{__('admin.ferstname')}}</label>
                    <input type="text" class="form-control" name="name" id="name" value="@if(old('name')){{old('name')}} @else @endif" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback col-sm-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="@if(old('email')){{old('email')}}@else @endif" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{__('admin.password')}}</label>
                    <input type="text" class="form-control" name="password" value="@if(old('password')){{old('password')}} @else @endif" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{__('admin.password_confirmation')}}</label>
                    <input type="text" class="form-control" name="password_confirmation" value="@if(old('password_confirmation')){{old('password_confirmation')}} @else @endif" required>
                </div>

                <div class="form-group has-feedback col-sm-6">
                    <label for="address">{{__('admin.status')}}</label>
                    <select name="role"
                            id="role" class="form-control" required>
                        @foreach($listRole as $roleOption)
                            <option value="{{$roleOption->id}}"
                                    @if($roleOption->name == 'User') selected @endif>
                                {{$roleOption->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="img">{{__('admin.photo_users')}}</label>
                    <input type="file" name="img" class="form-control-file">
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="box-footer">
                <input type="hidden" name="id" value="">
                <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
            </div>
        </form>
    </section>
@endsection
