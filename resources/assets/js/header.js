$('#h-btn').on('touchend',function () {
    $(this).toggleClass('show');
    $('#header .nav-bar').toggleClass('show')
});
$('.rely').on('click',function () {
   var name=$(this).parent().find('.name').find('p em').html();
   $('.comment-textarea').val('@'+name+' ');
})