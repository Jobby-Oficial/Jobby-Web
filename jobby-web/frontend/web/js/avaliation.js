/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

function createAvaliationServiceView(avaliation, serviceId, userId){
    $.ajax({
        url: "http://localhost/jobby-web/frontend/web/avaliation",
        data: {"avaliation": avaliation, "service_id": serviceId, "user_id": userId},
        type: 'POST',
        success: function(result) {
            console.log("Success");
            $.pjax.reload({container: '#avaliation-service-view-id-wrap', async: true});
            $.pjax.reload({container: '#avaliation-rating-average', async: true});
            $.pjax.reload({container: '#avaliation-count', async: true});
        },
        error: function() {
            console.log("Error");
        }
    });
}

function updateAvaliationServiceView(id, avaliation, serviceId){
    $.ajax({
        url: "http://localhost/jobby-web/frontend/web/avaliation/" + id,
        data: {"id": id, "avaliation": avaliation, "service_id": serviceId,},
        type: 'PUT',
        success: function(result) {
            console.log("Success");
            $.pjax.reload({container: '#avaliation-service-view-id-wrap', async: true});
            $.pjax.reload({container: '#avaliation-rating-average', async: true});
            $.pjax.reload({container: '#avaliation-count', async: true});
        },
        error: function() {
            console.log("Error");
        }
    });
}

function deleteAvaliationServiceView(id, serviceId){
    console.log("entro")
    $.ajax({
        url: "http://localhost/jobby-web/frontend/web/avaliation/" + id,
        data: {"id": id, "service_id": serviceId,},
        type: 'DELETE',
        success: function(result) {
            console.log("Success");
            $.pjax.reload({container: '#avaliation-service-view-id-wrap', async: true});
            $.pjax.reload({container: '#avaliation-rating-average', async: true});
            $.pjax.reload({container: '#avaliation-count', async: true});
        },
        error: function() {
            console.log("Error");
        }
    });
}