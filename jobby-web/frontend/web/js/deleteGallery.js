/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

function deleteServiceGallery(id, galleryId){
  $.ajax({
    url: "http://localhost:20080/service/delete-gallery?id=" + id,
    data: {"galleryId": galleryId},
    type: 'DELETE',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#service-gallery-id-wrap', async: true}).done(function () {
        $.pjax.reload({container: '#service-gallery-form-id-wrap', async: true});
      });
    },
    error: function() {
      console.log("Error");
    }
  });
}