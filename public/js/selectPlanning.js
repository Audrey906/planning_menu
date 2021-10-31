var elementRadio = document.getElementsByName('radioPlanning');
var divOneDay = document.getElementById('divOneDay');
var divOneWeek = document.getElementById('divOneWeek');
var divOneMonth = document.getElementById('divOneMonth');
var divPlanning = document.getElementById('divPlanning').children;
var submitButton = document.getElementById('submitButton');
var generateButton = document.getElementById('generateButton');

elementRadio.forEach( element =>
    element.addEventListener('change', function(){
        submitButton.style.display = 'block';
        generateButton.style.display = 'block';
        let elementChecked = element.getAttribute('id');

        for (var i = 0; i < divPlanning.length; i++) {
            divPlanning[i].style.display = 'none';
        }

        if (elementChecked === 'oneDay') {
            divOneDay.style.display = 'block';
        } else if (elementChecked === 'oneWeek') {
            divOneWeek.style.display = 'block';
        } else {
            divOneMonth.style.display = 'block';
        }
    })
)    