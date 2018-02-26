$(function() {
    var windowWidth = $(window).width();
    if(windowWidth <= 991){
        $('.hr').show();
    }
    else {
        $('.hr').hide();
    }
});

function redimension() {
    var windowWidth = $(window).width();
    if(windowWidth <= 991){
        $('.hr').show();
    }
    else {
        $('.hr').hide();
    }
};
window.addEventListener('resize', redimension, false);