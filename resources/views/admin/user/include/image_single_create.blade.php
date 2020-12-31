<div class="card card-danger box-solid">
    <div class="card-header">
        <h3 class="card-title">Аватар пользователя</h3>
    </div>

    <div class="card-body" id="image" style="text-align: center; position: relative" >
            <img width="50%" height="50%"  id="preview_image"/>

        <i id="loading" class="fas fa-2x fa-sync-alt fa-spin" style="position: absolute;left: 40%;top: 40%;display: none"></i>
    </div>
    <p style="text-align: center">
        <a href="javascript:changeProfile()" style="text-decoration: none;" data-name="single">
            <i class="glyphicon glyphicon-edit"></i> Загрузить
        </a>&nbsp;&nbsp;

                <a href="javascript:removeFile()" style="color: red;text-decoration: none;">
                    <i class="glyphicon glyphicon-trash"></i> Удалить
                </a>
    </p>
    <input type="file" id="img" name="img" style="display: none"/>
    <input type="hidden" id="file_name"/>
    <p style="text-align: center"><small>Рекомендуемые размеры: 200ш.х 200в.</small></p>

</div>


