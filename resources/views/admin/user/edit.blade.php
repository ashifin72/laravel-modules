@extends('admin.index')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') {{$item->name}}@endslot
            @slot('parent') {{__('admin.home')}} @endslot
            @slot('users') {{__('admin.users')}} @endslot
            @slot('active') {{__('admin.edit')}} {{$item->name}}@endslot
        @endcomponent


    </div>
    <!-- /.content-header -->

    <section class="content card card-body">

        <!-- Small boxes (Stat box) -->
        <!-- Small boxes (Stat box) -->
        <form method="POST" action="{{route('admin.users.update', $item->id)}}"
              enctype="multipart/form-data"
              data-toggle="validator">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">

            <div class="box-body row">
                <div class="col-sm-4">
                    <div class="form-group has-feedback">
                        <label for="name"><i class="fas fa-user"></i> {{__('admin.name')}}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$item->name}}" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="email"><i class="far fa-envelope-open"></i> Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$item->email}}" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="phone"><i class="fas fa-phone"></i> {{__('admin.phone')}}</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{$item->phone}}">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="skype"><i class="fas fa-laptop-house"></i> {{__('admin.site')}}</label>
                        <input type="text" class="form-control" name="site" id="site" value="{{$item->site}}">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group">
                        <label for=""><i class="fas fa-key"></i> {{__('admin.password')}}</label>
                        <input type="text" class="form-control" name="password" placeholder="Введите пароль, если хотите его изменить">
                    </div>
                    <div class="form-group">
                        <label for=""><i class="fas fa-unlock-alt"></i> {{__('admin.password_confirmation')}}</label>
                        <input type="text" class="form-control" name="password_confirmation" placeholder="Подтверждение пароля">
                    </div>
                </div>
                <div class="col-sm-4">

                    <div class="form-group has-feedback">
                        <label for="facebook"><i class="fab fa-facebook-f"></i> Facebook</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{$item->facebook}}">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="viber"><i class="fab fa-viber"></i> Viber</label>
                        <input type="text" class="form-control" name="viber" id="viber" value="{{$item->viber}}">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="telegram"><i class="fab fa-telegram"></i> Telegram</label>
                        <input type="text" class="form-control" name="telegram" id="telegram" value="{{$item->telegram}}">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="whatsapp"><i class="fab fa-whatsapp"></i> Whatsapp</label>
                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{$item->whatsapp}}">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="skype"><i class="fab fa-skype"></i> Skype</label>
                        <input type="text" class="form-control" name="skype" id="skype" value="{{$item->skype}}">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group has-feedback">
                        <label for="address"><i class="fas fa-users-cog"></i> {{__('admin.status')}}</label>
                        <select name="role"

                                id="role" class="form-control" value="{{$item->role}}" required>

                            @foreach($listRole as $roleOption)
                                <option value="{{$roleOption->id}}"
                                        @if($roleOption->name == $role) selected @endif>
                                    {{$roleOption->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @if($item->img == null)
                            <img style="width: 50px" src="{{asset('/assets/admin/img/logo-mini.png')}}"
                                 alt="{{$item->name}}">
                        @else <img style="width: 50px" src="{{asset('uploads/' . $item->img)}}" alt="{{$item->name}}">
                        @endif
                        <label for="img">{{__('admin.photo_users')}}</label>
                        <input type="file" name="img" class="form-control-file">
                    </div>
                </div>

                <div class="clesr"></div>
                <button type="submit" class="btn btn-outline-success">{{__('admin.save')}}</button>
            </div>
        </form>

        @if($item->id > 1)
            <form method="post" onsubmit='return false' action="{{route('admin.users.destroy', $item->id)}}">
                @method('DELETE')
                @csrf
                <div class="row justify-content-start" style="margin-top: 25px">
                    <button type="submit" onclick=' confirm("Точно видалити?") ? this.form.submit() : ""'
                            class="btn-outline-danger">{{__('admin.remove')}}</button>
                </div>
            </form>
        @endif


    </section>
@endsection
