/*
 *   Copyright (c) 2021 Leonardo Ferreira
 *   All rights reserved.
 */
$(document).ready(function() {
    $.ajax({
        url: "https://619787935953f10017d23dce.mockapi.io/api/v1/categories",
        type: 'GET',
        success: function(result) {
            $(result).each(function( index, item ) {
                $("#servicesearch-category").append("<option value='" + item.name + "'>" + item.name + "</option>");
            });
        },
        error: function() {
            console.log("error");
        }
    });
});

$(".service-form-search").submit(function() {
    $.ajax({
        url: "https://619787935953f10017d23dce.mockapi.io/api/v1/categories",
        type: 'GET',
        success: function(result) {
            $(result).each(function( index, item ) {
                $("#servicesearch-category").append("<option value='" + item.name + "'>" + item.name + "</option>");
            });
        },
        error: function() {
            console.log("error");
        }
    });
});