// main function, runs entire file
function addAllEditButtonEventListeners()
{
    addEventListenersToWordButtons()
    addEventListenersToEditButtons()
}

// helper function to punctuate a wordButton
function punctuateWord(wordButton, punctuation)
{
    let word = wordButton.textContent
    if (wordButton.dataset.punctuated === 'true'){
        word = word.substr(0, word.length - 1)
    } else {
        wordButton.dataset.punctuated = 'true'
    }
    wordButton.textContent = word + punctuation
}

function addEventListenersToWordButtons()
{
    const allWordButtons = document.querySelectorAll('.wordButton')
    const editButtonsDivs = document.querySelectorAll('.editButtons')
    allWordButtons.forEach(wordButton => {
        wordButton.addEventListener('click', evt => {
            if (wordButton.dataset.deleted === 'true') {
                wordButton.style.color = 'black'
                wordButton.dataset.deleted = 'false'
            } else {
                editButtonsDivs.forEach(editButtonDiv => {
                    if (editButtonDiv.dataset.id !== wordButton.dataset.id) {
                        if (!editButtonDiv.classList.contains('d-none')) {
                            editButtonDiv.classList.toggle('d-none')
                        }
                    } else {
                        editButtonDiv.classList.toggle('d-none')
                    }
                })
            }
        })
        wordButton.addEventListener('dblclick', evt => {
            if (wordButton.dataset.deleted !== 'true') {
                document.querySelector('#editButtons' + wordButton.dataset.id).classList.add('d-none')
                wordButton.style.color = 'white'
                wordButton.dataset.deleted = 'true'
            }
        })
    })
}

// add event listeners to allowing editing of each word
function addEventListenersToEditButtons()
{
    document.querySelectorAll('.clearButton').forEach(clearButton => {
        clearButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + clearButton.dataset.id)
            punctuateWord(wordButton, ' ')
            wordButton.dataset.punctuation = 'space'
        })
    })
    document.querySelectorAll('.commaButton').forEach(commaButton => {
        commaButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + commaButton.dataset.id)
            punctuateWord(wordButton, ',')
            wordButton.dataset.punctuation = 'comma'
        })
    })
    document.querySelectorAll('.fullStopButton').forEach(fullStopButton => {
        fullStopButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + fullStopButton.dataset.id)
            punctuateWord(wordButton, '.')
            wordButton.dataset.punctuation = 'fullStop'
        })
    })
    document.querySelectorAll('.semicolonButton').forEach(semicolonButton => {
        semicolonButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + semicolonButton.dataset.id)
            punctuateWord(wordButton, ';')
            wordButton.dataset.punctuation = 'semiColon'
        })
    })
    document.querySelectorAll('.colonButton').forEach(colonButton => {
        colonButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + colonButton.dataset.id)
            punctuateWord(wordButton, ':')
            wordButton.dataset.punctuation = 'colon'
        })
    })
    document.querySelectorAll('.exclamationButton').forEach(exclamationButton => {
        exclamationButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + exclamationButton.dataset.id)
            punctuateWord(wordButton, '!')
            wordButton.dataset.punctuation = 'exclamation'
        })
    })
    document.querySelectorAll('.questionButton').forEach(questionButton => {
        questionButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + questionButton.dataset.id)
            punctuateWord(wordButton, '?')
            wordButton.dataset.punctuation = 'question'
        })
    })
    document.querySelectorAll('.allLowerButton').forEach(allLowerButton => {
        allLowerButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + allLowerButton.dataset.id)
            wordButton.textContent = wordButton.textContent.toLowerCase()
            wordButton.dataset.capitalised = 'false'
            wordButton.dataset.capitalisation = 'lower'
        })
    })
    document.querySelectorAll('.firstCapsButton').forEach(firstCapsButton => {
        firstCapsButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + firstCapsButton.dataset.id)
            wordButton.textContent = wordButton.textContent.toLowerCase()
            wordButton.textContent = wordButton.textContent.charAt(0).toUpperCase() + wordButton.textContent.slice(1)
            wordButton.dataset.capitalised = 'true'
            wordButton.dataset.capitalisation = 'firstCaps'
        })
    })
    document.querySelectorAll('.allCapsButton').forEach(allCapsButton => {
        allCapsButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + allCapsButton.dataset.id)
            wordButton.textContent = wordButton.textContent.toUpperCase()
            wordButton.dataset.capitalised = 'true'
            wordButton.dataset.capitalisation = 'allCaps'
        })
    })
    document.querySelectorAll('.deleteButton').forEach(deleteButton => {
        deleteButton.addEventListener('click', ext => {
            const wordButton = document.querySelector('#wordButton' + deleteButton.dataset.id)
            wordButton.style.color = 'white'
            wordButton.dataset.deleted = 'true';
        })
    })
}