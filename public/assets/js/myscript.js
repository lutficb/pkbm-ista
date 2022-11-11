"use strict";

let path = location.pathname.split('/');
let url = location.origin + '/' + path[1];

$('ul.navbar-menu li a').each(function() {
    if(path[1] == '') {
        $('#home').addClass('active');
    } else {
        if($(this).attr('href').indexOf(url) !== -1) {
            $(this).addClass('active');
        }
    }
});