/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

function responseSchedule(id, response){
  var reason = $('#schedule-schedule_status_note').val();
  var price = $('#schedule-price-disp').val();
  if(price != undefined){
    price = price.slice(price.indexOf('€') + 1);
  }
  $.ajax({
    url: "http://localhost/jobby-web/frontend/web/schedule/update?id=" + id,
    type: 'POST',
    data: {'response': response, 'reason': reason, 'price': price},
    success: function(result) {
      console.log("Success");
      $("#modal-refuse-schedule").modal('hide');
      $("#modal-accept-schedule").modal('hide');
      $("#modal-cancel-schedule").modal('hide');
      
      $.pjax.reload({container: '#schedule-schedule_status-wrap', async: true}).done(function () {
        $.pjax.reload({container: '#schedule-status_job-wrap', async: true}).done(function () {
          $.pjax.reload({container: '#schedule-schedule_status-buttons-wrap', async: true});
        });
      });
    },
    error: function() {
      console.log("Error");
    }
  });
}

$('#schedule-job_status_id').change(function(){
  var id = $('#schedule-id').val();
  var job_status = $(this).val();

  $.ajax({
    url: "http://localhost/jobby-web/frontend/web/schedule/update?id=" + id,
    type: 'POST',
    data: {'job_status': job_status},
    success: function(result) {
      console.log("Success");
      $.pjax.reload({container: '#schedule-status_job-wrap', async: true}).done(function () {
        $.pjax.reload({container: '#schedule-schedule_status-buttons-wrap', async: true}).done(function () {
          $.pjax.reload({container: '#schedule-schedule_status-wrap', async: true});
        });
      });
    },
    error: function() {
      console.log("Error");
    }
  });
});