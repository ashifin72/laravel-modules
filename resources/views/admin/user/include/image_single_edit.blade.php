<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-users-cog"></i> {{__('admin.photo_users')}}</h3>
    </div>
    <div class="card-body" id="image" style=" border: 1px solid whitesmoke ; text-align: center; position: relative" >
        @if ($item->img == null)
            <img width="50%" height="50%" src='{{asset("/assets/img/no_image.jpg")}}' id="preview_image"/>
        @else
            <img width="50%" height="50%" src='{{asset("/upload/users/$item->img")}}' id="preview_image"/>
        @endif

        <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
    </div>
    <p style="text-align: center">
        <a href="javascript:changeProfile()" style="text-decoration: none;" data-name="single">
            <i class="glyphicon glyphicon-edit"></i><i class="fas fa-download"></i> {{__('admin.download')}}
        </a>&nbsp;&nbsp;
        @if ($item->img == null)
            <a href="javascript:removeFile()" style="color: red;text-decoration: none;" class="nothing">
                <i class="glyphicon glyphicon-trash"></i><i class="far fa-trash-alt"></i> {{__('admin.remove')}}
            </a>
        @else
            <a href="javascript:removeFileImg()" style="color: red;text-decoration: none;" class="myimg" data-name="{{$item->img}}">
                <i class="glyphicon glyphicon-trash"></i><i class="far fa-trash-alt"></i> {{__('admin.remove')}}
            </a>
        @endif

    </p>
    <input type="file" id="img" style="display: none"/>
    <input type="hidden" id="file_name"/>

    <p style="text-align: center"><small>{{__('admin.recommended_dimensions')}}: 150px.х 150px.</small></p>

</div>



