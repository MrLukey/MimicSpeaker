
// add event listeners to ensure only one editButtons div is open at any time, and clicking away will close them all
const allWordButtons = document.querySelectorAll('.wordButton')
const editButtonsDivs = document.querySelectorAll('.editButtons')
allWordButtons.forEach(wordButton => {
    wordButton.addEventListener('click', evt => {
        let editButtonsDivs = document.querySelectorAll('.editButtons')
        if (wordButton.dataset.deleted === 'true'){
            wordButton.style.color = 'black'
            delete wordButton.dataset.deleted
        } else {
            editButtonsDivs.forEach(editButtonDiv => {
                if (editButtonDiv.dataset.id !== wordButton.dataset.id){
                    if (!editButtonDiv.classList.contains('d-none')){
                        editButtonDiv.classList.toggle('d-none')
                    }
                } else {
                    editButtonDiv.classList.toggle('d-none')
                }
            })
        }
    })
})
document.addEventListener('mouseup', evt => {
    editButtonsDivs.forEach(editButtonDiv => {
        if (!editButtonDiv.classList.contains('d-none')){
            editButtonDiv.classList.toggle('d-none')
        }
    })
})

function punctuateWord(wordButton, punctuation){
    let word = wordButton.textContent
    if (wordButton.dataset.edited === 'true'){
        word = word.substr(0, word.length - 1)
    } else {
        wordButton.dataset.edited = 'true'
    }
    wordButton.textContent = word + punctuation
}

function resetDataset(wordButton){
    delete wordButton.dataset.commaAdded
    delete wordButton.dataset.fullStopAdded
    delete wordButton.dataset.semiColonAdded
    delete wordButton.dataset.colonAdded
    delete wordButton.dataset.exclamationAdded
    delete wordButton.dataset.questionAdded
    delete wordButton.dataset.allLower
    delete wordButton.dataset.firstCaps
    delete wordButton.dataset.allCaps
    delete wordButton.dataset.deleted
}


// add event listeners to allowing editing of each word
document.querySelectorAll('.clearButton').forEach(clearButton => {
    clearButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + clearButton.dataset.id)
        punctuateWord(wordButton, ' ')
        resetDataset(wordButton)
    })
})
document.querySelectorAll('.commaButton').forEach(commaButton => {
    commaButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + commaButton.dataset.id)
        punctuateWord(wordButton, ',')
        resetDataset(wordButton)
        wordButton.dataset.commaAdded = 'true'
    })
})
document.querySelectorAll('.fullStopButton').forEach(fullStopButton => {
    fullStopButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + fullStopButton.dataset.id)
        punctuateWord(wordButton, '.')
        resetDataset(wordButton)
        wordButton.dataset.fullStopAdded = 'true'
    })
})
document.querySelectorAll('.semicolonButton').forEach(semicolonButton => {
    semicolonButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + semicolonButton.dataset.id)
        punctuateWord(wordButton, ';')
        resetDataset(wordButton)
        wordButton.dataset.semiColonAdded = 'true'
    })
})
document.querySelectorAll('.colonButton').forEach(colonButton => {
    colonButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + colonButton.dataset.id)
        punctuateWord(wordButton, ':')
        resetDataset(wordButton)
        wordButton.dataset.colonAdded = 'true'
    })
})
document.querySelectorAll('.exclamationButton').forEach(exclamationButton => {
    exclamationButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + exclamationButton.dataset.id)
        punctuateWord(wordButton, '!')
        resetDataset(wordButton)
        wordButton.dataset.exclamationAdded = 'true'
    })
})
document.querySelectorAll('.questionButton').forEach(questionButton => {
    questionButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + questionButton.dataset.id)
        punctuateWord(wordButton, '?')
        resetDataset(wordButton)
        wordButton.dataset.questionAdded = 'true'
    })
})
document.querySelectorAll('.allLowerButton').forEach(allLowerButton => {
    allLowerButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + allLowerButton.dataset.id)
        wordButton.textContent = wordButton.textContent.toLowerCase()
        resetDataset(wordButton)
        wordButton.dataset.allLower = 'true'
    })
})
document.querySelectorAll('.firstCapsButton').forEach(firstCapsButton => {
    firstCapsButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + firstCapsButton.dataset.id)
        wordButton.textContent = wordButton.textContent.toLowerCase()
        wordButton.textContent = wordButton.textContent.charAt(0).toUpperCase() + wordButton.textContent.slice(1)
        resetDataset(wordButton)
        wordButton.dataset.firstCaps = 'true'
    })
})
document.querySelectorAll('.allCapsButton').forEach(allCapsButton => {
    allCapsButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + allCapsButton.dataset.id)
        wordButton.textContent = wordButton.textContent.toUpperCase()
        resetDataset(wordButton)
        wordButton.dataset.allCaps = 'true'
    })
})
document.querySelectorAll('.deleteButton').forEach(deleteButton => {
    deleteButton.addEventListener('click', ext => {
        const wordButton = document.querySelector('#wordButton' + deleteButton.dataset.id)
        wordButton.style.color = 'white'
        wordButton.dataset.deleted = 'true';
    })
})