/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

$(document).ready(function() {
  $.ajax({
      url: "https://619787935953f10017d23dce.mockapi.io/api/v1/categories",
      type: 'GET',
      success: function(result) {
          $(result.reverse()).each(function(index, item) {
            if(index < 4){
              $('.home-categories').append("<section class='home-categories-item-wrap mr-5'><div><img class='home-categories-image' src='" + item.image + "' alt='Category Image'></div><div><div class='home-categories-name text-center'>" + item.name + "</div></div></section>");
            }
            else if(index == 4){
              $('.home-categories').append("<section class='home-categories-item-wrap'><div><img class='home-categories-image' src='" + item.image + "' alt='Category Image'></div><div><div class='home-categories-name text-center'>" + item.name + "</div></div></section>");
            }
          });
      },
      error: function() {
          console.log("error");
      }
  });
});