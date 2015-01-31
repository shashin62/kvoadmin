$('.search').click(function () {
    var $this = $(this);
    var fromdate = $('.fromdate').val();
    var todate = $('.todate').val();

    doFormPost(baseUrl + "/report/completedrecords", '{ "fromdate":"' + fromdate + '","todate":"' + todate + '"}');

});
$('.clear').click(function () {
window.location.href = baseUrl + "/report/completedrecords";
});
