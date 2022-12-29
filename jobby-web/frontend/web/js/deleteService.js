/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

$(document).ready(function() {
  $('.profile-delete-service').click(function() {
    var id = $(this).data('id');
    console.log(id);
    $('.profile-service-data').attr('href', 'http://localhost/jobby-web/frontend/web/service/delete?id=' + id);
  });
});