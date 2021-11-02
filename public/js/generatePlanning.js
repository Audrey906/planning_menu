var generateButton = document.getElementById('generateButton');
var selectElement = document.querySelectorAll('select')

generateButton.addEventListener('click', function() {
    for (element of selectElement) {
        var randomNumber =  Math.floor(Math.random() * 101);
        var percentDishCat = document.getElementById('percentDishCat');
        elementParentDiv = element.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode
        
        if (elementParentDiv.style.display === 'block') {
            var arrayValues = [];
            element.childNodes.forEach(function(optionChild)
            {
                if (optionChild !== undefined && optionChild.value !== undefined && parseInt(optionChild.value) == optionChild.value) {
                    arrayValues.push(optionChild.value); 
                }

            });
            var randomNumber = Math.floor(Math.random() * arrayValues.length);
            var randomValueOption = arrayValues[randomNumber]
            element.childNodes.forEach(function(optionChild)
            {
                if (optionChild !== undefined && optionChild.value !== undefined && parseInt(optionChild.value) == optionChild.value) {
                    optionChild.setAttribute('selected', false)
                }
            });
        }
    } 
})


