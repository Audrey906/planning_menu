var generateButton = document.getElementById('generateButton');

generateButton.addEventListener('click', function() {
    var formDiv = document.getElementsByClassName('formPlanning d-block')
    var selectElement = formDiv[0].querySelectorAll('select')
    console.log(selectElement)

    for (element of selectElement) {
        elementParentDiv = element.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.classList.contains('d-block')
            var arrayValues = [];
            element.childNodes.forEach(function(optionChild)
            {
                if (optionChild !== undefined && optionChild.value !== undefined && parseInt(optionChild.value) == optionChild.value) {
                    arrayValues.push(optionChild.value); 
                }
            });
            var randomNumber = Math.floor(Math.random() * arrayValues.length);
            var randomValueOption = arrayValues[randomNumber]
            element.value = randomValueOption;           
        }
})


