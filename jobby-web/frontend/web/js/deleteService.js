/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

$(document).ready(function() {
  $('.profile-delete-service').click(function() {
    var id = $(this).data('id');
    $('.profile-service-data').attr('href', '/service/delete?id=' + id);
  });
});