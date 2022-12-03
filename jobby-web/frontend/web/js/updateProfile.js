/*
 *   Copyright (c) 2022 Guilherme Cruz
 *   All rights reserved.
 */

$(document).ready(function() {
    $.ajax({
        url: "https://countriesnow.space/api/v0.1/countries",
        type: 'GET',
        success: function(result) {
            $(result.data).each(function( index, item ) {
                $(item).each(function( indice, value ) {
                    $("#user-country").append("<option value='" + value.country + "'>" + value.country + "</option>");
                });
            });
        },
        error: function() {
            console.log("error");
        }
    });
});

$("#user-country").change(function() {
    $('#user-city').empty();
    $.ajax({
        url: "https://countriesnow.space/api/v0.1/countries/cities",
        type: 'POST',
        data: {country: $("#user-country").val()},
        success: function(result) {
            $(result.data).each(function( index, item ) {
                $("#user-city").append("<option value='" + item + "'>" + item + "</option>");
            });
        },
        error: function() {
            console.log("error");
        }
    });
});