<script>

  function changeProfile() {
    $('#img').click();
  }
  $('#img').change(function () {
    if ($(this).val() != '') {
      upload(this);

    }
  });
  function upload(img){
    var form_data = new FormData();
    form_data.append('img', img.files[0]);
    form_data.append('_token', '{{csrf_token()}}');
    $('#loading').css('display', 'block');
    $.ajax({
      url: "{{url('/admin/user/ajax-image-upload')}}",
      data: form_data,
      type: 'POST',
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.fail) {
          $('#preview_image').attr('src', '{{asset('assets/img/no_image.jpg')}}');
          alert(data.errors['img']);
        }
        else {
          $('#file_name').val(data);
          $('#preview_image').attr('src', '{{asset('upload/users')}}/' + data);

        }
        $('#loading').css('display', 'none');
      },
      error: function (xhr, status, error) {
        alert(xhr.responseText);
        $('#preview_image').attr('src', '{{asset('assets/img/no_image.jpg')}}');
      }
    });
  }

  function removeFile() {
    if ($('#file_name').val() != '')
      if (confirm('Вы точно хотите удалить эту картинку?')) {
        $('#loading').css('display', 'block');
        var form_data = new FormData();
        form_data.append('_method', 'DELETE');
        form_data.append('_token', '{{csrf_token()}}');
        $.ajax({
          url: '{{url('/admin/user/ajax-remove-image')}}'+ '/' + $('#file_name').val(),
          data: form_data,
          type: 'POST',
          contentType: false,
          processData: false,
          success: function (data) {
            $('#preview_image').attr('src', '{{asset('assets/img/no_image.jpg')}}');
            $('#file_name').val('');
            $('#loading').css('display', 'none');
          },
          error: function (xhr, status, error) {
            alert(xhr.responseText);
          }
        });
      }
  }

  function removeFileImg() {
    if ($('a.myimg').data('name') != '')
      if (confirm('Вы точно хотите удалить эту картинку?')) {
        $('#loading').css('display', 'block');
        var form_data = new FormData();
        form_data.append('_method', 'DELETE');
        form_data.append('_token', '{{csrf_token()}}');
        $.ajax({
          url: '{{url('/admin/user/ajax-remove-image')}}'+ '/' + $('a.myimg').data('name'),
          data: form_data,
          type: 'POST',
          contentType: false,
          processData: false,
          success: function (data) {
            $('#preview_image').attr('src', '{{asset('assets/img/no_image.jpg')}}');
            $('#file_name').val('');
            $('#loading').css('display', 'none');
          },
          error: function (xhr, status, error) {
            alert(xhr.responseText);
          }
        });
      }
  }

  function removeFileG() {
    if (confirm('Вы точно хотите удалить эту картинку?')) {
      $('#loading').css('display', 'block');
      var form_data = new FormData();
      form_data.append('_method', 'DELETE');
      form_data.append('_token', '{{csrf_token()}}');
      $.ajax({
        url: '{{url('/admin/user/ajax-remove-image')}}'+ '/' + $('#file_name').val(),
        data: form_data,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
          $('#preview_image').attr('src', '{{asset('images/no_image.jpg')}}');
          $('#file_name').val('');
          $('#loading').css('display', 'none');
        },
        error: function (xhr, status, error) {
          alert(xhr.responseText);
        }
      });
    }
  }


</script>

