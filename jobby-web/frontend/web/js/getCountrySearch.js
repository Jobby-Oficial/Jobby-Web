/*
 *   Copyright (c) 2021 Leonardo Ferreira
 *   All rights reserved.
 */

$(document).ready(function() {
    $.ajax({
        url: "https://countriesnow.space/api/v0.1/countries",
        type: 'GET',
        success: function(result) {
            $(result.data).each(function( index, item ) {
                $(item).each(function( indice, value ) {
                    $("#usersearch-country").append("<option value='" + value.country + "'>" + value.country + "</option>");
                });
            });
        },
        error: function() {
            console.log("error");
        }
    });
});

$("#usersearch-country").change(function() {
    $('#usersearch-city').empty();
    $.ajax({
        url: "https://countriesnow.space/api/v0.1/countries/cities",
        type: 'POST',
        data: {country: $("#usersearch-country").val()},
        success: function(result) {
            $(result.data).each(function( index, item ) {
                $("#usersearch-city").append("<option value='" + item + "'>" + item + "</option>");
            });
        },
        error: function() {
            console.log("error");
        }
    });
});