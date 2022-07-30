var elementCross = $('.update');

elementCross.click(function() {
    var planningId = $(this).parents('.dropdown').children('span').attr('id');

    if (planningId !== undefined) {
        $('#dishToUpdate').text($(this).parents('.dropdown').children('span').text())
        $('#idPlanning').val($(this).parents('.dropdown').children('span').attr('id'))
    }
});

