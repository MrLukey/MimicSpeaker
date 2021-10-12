// main function, runs entire file
function addAllValidationEventListeners(){
    addValidationEventListenerToSentenceLengthInput()
}

function addValidationEventListenerToSentenceLengthInput()
{
    const sentenceLengthSelector = document.querySelector('#sentenceLengthSelector')
    sentenceLengthSelector.addEventListener('change', evt => {
        if (sentenceLengthSelector.value > 1000){
            sentenceLengthSelector.value = 1000
        }
    })
}
