/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

function responseScheduleProfessional(id, response){
  var reason = $('#schedule-schedule_status_note').val();
  var price = $('#schedule-price-disp').val();
  if(price != undefined){
    price = price.slice(price.indexOf('€') + 1);
  }
  $.ajax({
    url: "http://localhost:20080/schedule/update?id=" + id,
    type: 'POST',
    data: {'response': response, 'reason': reason, 'price': price},
    success: function(result) {
      console.log("Success");
      $("#modal-refuse-schedule-prof").modal('hide');
      $("#modal-accept-schedule-prof").modal('hide');

      $.pjax.reload({container: '#schedule-schedule_status-buttons-wrap-prof', async: true});
    },
    error: function() {
      console.log("Error");
    }
  });
}

function responseScheduleClient(id, response){
  var reason = $('#schedule-schedule_status_note').val();
  var price = $('#schedule-price-disp').val();
  if(price != undefined){
    price = price.slice(price.indexOf('€') + 1);
  }
  $.ajax({
    url: "http://localhost:20080/schedule/update?id=" + id,
    type: 'POST',
    data: {'response': response, 'reason': reason, 'price': price},
    success: function(result) {
      console.log("Success");
      $("#modal-cancel-schedule").modal('hide');
      
      $.pjax.reload({container: '#job-schedule_status-wrap', async: true}).done(function () {
        $.pjax.reload({container: '#job-status_job-wrap', async: true}).done(function () {
          $.pjax.reload({container: '#job-schedule_status-buttons-wrap', async: true});
        });
      });
    },
    error: function() {
      console.log("Error");
    }
  });
}