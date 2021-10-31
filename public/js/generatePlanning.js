var generateButton = document.getElementById('generateButton');
var selectElement = document.querySelectorAll('select')

generateButton.addEventListener('click',function(){
    console.log(selectElement)
    selectElement.forEach(function(element){
        elementParentDiv = element.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode
        
        if (element.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.style.display === 'block') {
            elementName = element.getAttribute('name');
            elementCat = elementName.split('_');
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
                if (optionChild.value !== undefined && optionChild.value == randomValueOption) {
                    optionChild.setAttribute('selected', true)
                }

            });
            // call route to get a random dish and hydrate option value
            // or get option and select random value
        }
        
    
    } 
       
    )
})