var elementRadio = document.getElementsByName('radioPlanning');
var formOneDay = document.getElementById('formOneDay');
var formOneWeek = document.getElementById('formOneWeek');
var formOneMonth = document.getElementById('formOneMonth');

var divGenerateButton = document.getElementById('divGenerateButton');

elementRadio.forEach(element =>
    element.addEventListener('change', function(){
        divGenerateButton.style.display = 'block';
        let elementChecked = element.getAttribute('id');
        if (elementChecked === 'oneDay') {
            formOneDay.classList.replace('d-none', 'd-block')
            formOneWeek.classList.replace('d-block', 'd-none')
            formOneMonth.classList.replace('d-block', 'd-none')

        } else if (elementChecked === 'oneWeek') {
            formOneDay.classList.replace('d-block', 'd-none')
            formOneWeek.classList.replace('d-none', 'd-block')
            formOneMonth.classList.replace('d-block', 'd-none')
        } else {
            formOneDay.classList.replace('d-block', 'd-none')
            formOneWeek.classList.replace('d-block', 'd-none')
            formOneMonth.classList.replace('d-none', 'd-block')
        }
    })
)    