var elementCross = $('.update');

elementCross.click(function() {
    var planningIdMobile = $(this).parents('.dropdown').children('p').attr('id');

    if (planningIdMobile !== undefined) {
        console.log('coucou mobile'+planningIdMobile)
        $('#dishToUpdate').text($(this).parents('.dropdown').children('p').text())
        $('#idPlanning').val($(this).parents('.dropdown').children('p').attr('id'))
    }
})

