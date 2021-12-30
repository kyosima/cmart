function startAjax(element){
    element = element.find('button[type="submit"]');
    element.addClass('disabled');
    element.html('<span class="spinner-grow spinner-grow-sm"></span> Đang xử lý..');
}

function endAjax(element, text){

    element = element.find('button[type="submit"]');
    element.removeClass('disabled');
    element.html(text);
    
    // $('.select2-selection__rendered').empty();
}

function selectFileWithCKFinder( preview) {
    var url_home = $('meta[name="url-home"]').attr('content').replace('/admin', '');
  CKFinder.popup( {
    chooseFiles: true,
    width: 800,
    height: 600,
    onInit: function( finder ) {

      finder.on( 'files:choose', function( evt ) {

          var files = evt.data.files;

            var html = '', url_file;
            files.forEach( function( file, i ) {
              url_file = file.getUrl().replace(url_home, '');

              html += `<div class="col-xs-12 col-md-12 ui-sortable-handle mt-4">
                        <div style="float:none;position: relative;" class="image_link">
                            <div class="form-group mb-3">
                                <label for="">Liên kết</label>
                                <input type="text" name="link[]" class="form-control" placeholder="Liên hết">
                            </div>
                            <img class="img-thumbnail show_img" src="${file.getUrl()}" alt="">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                        <input type="hidden" name="image[]" value="${url_file}">
                        <input type="hidden" name="id[]" value="0">
                    </div>`;
            } );
            $(preview).append(html);
      } );
    }
    
  } );
}
$(document).ready(function(){
  $("div.reorder-photos-list").sortable({ tolerance: 'pointer' });
});

$(document).on('click', '.add_picture', function(event) {
  /* Act on the event */
  var preview = $(this).data('preview');
  selectFileWithCKFinder( preview );
});

$(document).on('submit', '#formBanner', function(event) {
  /* Act on the event */
  event.preventDefault();
  var that = $(this), url = that.attr('action');
  if(that.find('input[name="id[]"]').length == 0){
    $.toast({
        heading: 'Thất bại',
        text: 'Vui lòng chọn ảnh',
        position: 'top-right',
        icon: 'error', 
        hideAfter: 10000
    });
    return;
  }
  startAjax(that);
  $.ajax( {
        url: url,
        type: 'PUT',
        dataType: 'html',
        data: that.serialize()
    } )
    .done(function(data) {
      $("div.reorder-photos-list").html(data);
        $.toast({
            heading: 'Thành công',
            text: 'Thực hiện thành công',
            position: 'top-right',
            icon: 'success'
        });
      })
      .fail(function(data) {
        $.toast({
            heading: 'Thất bại',
            text: 'Có 1 lỗi ngoài ý muốn, vui lòng tải lại trang.',
            position: 'top-right',
            icon: 'error', 
            hideAfter: 10000
        });
      })
    .always(function() {
        endAjax(that, 'Lưu lại');
      });
});

$(document).on('click', '.image_link i', function(event){
  if(!confirm('Bạn có chắc muốn thực hiện ?')){
    return;
  }
  $(this).parents("div.ui-sortable-handle").remove();
});
