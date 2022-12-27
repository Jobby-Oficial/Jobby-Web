/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

//Doker: url: "http://localhost:20080/favorite",

function createFavorite(serviceId, userId){
  $.ajax({
    url: "favorite",
    data: {"service_id": serviceId, "user_id": userId},
    type: 'POST',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#service-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function deleteFavorite(id){
  $.ajax({
    url: "favorite/" + id,
    data: {"id": id},
    type: 'DELETE',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#service-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function createFavoriteServiceView(serviceId, userId){
  $.ajax({
    url: "favorite",
    data: {"service_id": serviceId, "user_id": userId},
    type: 'POST',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#favorite-service-view-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function deleteFavoriteServiceView(id){
  $.ajax({
    url: "favorite/" + id,
    data: {"id": id},
    type: 'DELETE',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#favorite-service-view-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function createFavoriteProfileView(serviceId, userId){
  $.ajax({
    url: "favorite",
    data: {"service_id": serviceId, "user_id": userId},
    type: 'POST',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#favorite-profile-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function deleteFavoriteProfileView(id){
  $.ajax({
    url: "http://localhost/jobby-web/frontend/web/favorite/" + id,
    data: {"id": id},
    type: 'DELETE',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#favorite-profile-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function createFavoriteProfileViewMyService(serviceId, userId){
  $.ajax({
    url: "favorite",
    data: {"service_id": serviceId, "user_id": userId},
    type: 'POST',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#favorite-profile-my-service-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function deleteFavoriteProfileViewMyService(id){
  $.ajax({
    url: "favorite/" + id,
    data: {"id": id},
    type: 'DELETE',
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#favorite-profile-my-service-id-wrap', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}