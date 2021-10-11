// helper function to read file as text (used to bring in Handlebars templates)
async function getTextViaAJAX(path)
{
    return await fetch(path, {method: 'get'}).then(data => data.text())
}

// helper function to simplify toggling classes on multiple buttons
function toggleButtonsClasses(buttons, toggleClasses)
{
    buttons.forEach(button => {
        toggleClasses.forEach(classToToggle => {
            button.classList.toggle(classToToggle)
        })
    })
}

// helper function to populate the preview div with edited mimic string
async function populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild, mimicPreviewTemplate)
{
    let allWordButtons = document.querySelectorAll('.wordButton')
    let editedMimicString = ''
    let wordsAdded = 0;
    if (allWordButtons.length > 0){
        editedMimicString += ''
        allWordButtons.forEach(wordButton => {
            if (wordButton.dataset.deleted !== 'true'){
                editedMimicString += wordButton.textContent + ' '
                wordsAdded++
            }
        })
        editedMimicString = editedMimicString.substr(0, editedMimicString.length - 1)
    }
    const data = {
        title: 'Mimic of ' + mimicSpeakerBuild.dataset.title + ' by ' + mimicAuthor.dataset.author,
        author: mimicEditor.dataset.username,
        mimic: editedMimicString
    }
    mimicPreview.innerHTML = mimicPreviewTemplate(data)
}

// main function, runs entire file
async function addEventListenersForMimicCreator()
{
    const openButton = document.querySelector('#openCreatorButton') // the button to open the mimic creator
    const closeButton = document.querySelector('#closeCreatorButton') // the button to close the mimic creator
    const mimicEditor = document.querySelector('#mimicEditor') // the div that holds the entire editor
    const titleSelector = document.querySelector('#titleSelector') // the selector input for titles
    const genreSelector = document.querySelector('#genreSelector') // the selector input for genre
    const buildMimicSpeakerButton = document.querySelector('#buildMimicSpeaker') // the button to build a mimic speaker
    const mimicSpeakerBuild = document.querySelector('#mimicSpeakerBuild') // the div that contains build info
    const lengthSelector = document.querySelector('#sentenceLengthSelector') // the number input for sentence length
    const mimicButton = document.querySelector('#mimicButton') // the button to generate mimic text
    const mimicAuthor = document.querySelector('#mimicAuthor') // the div that contains author info
    const confirmPublishButton = document.querySelector('#confirmPublishButton') // the button that opens the modal to confirm publication
    const publishButton = document.querySelector('#publishButton') // the button that publishes the mimic to the site
    const previewButton = document.querySelector('#previewButton') // the button that toggles preview / editor mode
    const mimicPreview = document.querySelector('#mimicPreview') // the div that contains the preview
    const wordEditor = document.querySelector('#wordEditor') // the div that contains the interactive words

    const previewHBTemplate = await getTextViaAJAX('templates/mimicPreviewTemplate.hbs').catch()
    const mimicPreviewTemplate = Handlebars.compile(previewHBTemplate)

    addEventListenersToOpenAndCloseButtons(openButton, closeButton, mimicEditor)
    addEventListenersToMimicSpeakerBuilder(mimicEditor, titleSelector, genreSelector, buildMimicSpeakerButton,
        mimicSpeakerBuild, mimicButton, mimicAuthor, confirmPublishButton, previewButton)
    addEventListenersToMimicButton(titleSelector, genreSelector, buildMimicSpeakerButton, mimicSpeakerBuild,
        lengthSelector, mimicButton, confirmPublishButton, previewButton, mimicEditor, mimicPreview, mimicAuthor, mimicPreviewTemplate).catch()
    addEventListenerToPreviewToggle(previewButton, mimicPreview, wordEditor, mimicAuthor, mimicEditor, mimicSpeakerBuild, mimicPreviewTemplate).catch()
    addEventListenersToPublishButton().catch()
}

function addEventListenersToOpenAndCloseButtons(openButton, closeButton, mimicEditor)
{
    [openButton, closeButton].forEach(button => {
        button.addEventListener('click', evt => {
            mimicEditor.classList.toggle('d-none')
        })
    })
}

// add event listeners to title and genre select inputs, and build button
function addEventListenersToMimicSpeakerBuilder(mimicEditor, titleSelector, genreSelector, buildMimicSpeakerButton, mimicSpeakerBuild,
                                                mimicButton, mimicAuthor, confirmPublishButton, previewButton)
{
    titleSelector.addEventListener('change', evt => {
        genreSelector.disabled = titleSelector.options.selectedIndex !== 0;
        genreSelector.value = titleSelector.options[titleSelector.options.selectedIndex].dataset.genre
    })

    genreSelector.addEventListener('change', evt => {
        titleSelector.disabled = genreSelector.options.selectedIndex !== 0;
        titleSelector.value = ''
    })

    buildMimicSpeakerButton.addEventListener('click', evt => {
        let mimicPreview = document.querySelector('#mimicPreview')
        toggleButtonsClasses([buildMimicSpeakerButton], ['btn-outline-primary', 'btn-primary'])
        toggleButtonsClasses([titleSelector, genreSelector, mimicSpeakerBuild], ['d-none'])
        if (titleSelector.classList.contains('d-none')){
            mimicPreview.innerHTML = ''
            document.querySelector('#wordsContainer').innerHTML = ''
            document.querySelector('#wordEditor').classList.remove('d-none')
            const buildData = {
                shortTitle: titleSelector.options[titleSelector.selectedIndex].value,
                genre: genreSelector.options[genreSelector.selectedIndex].value
            }
            fetch('/buildMimicSpeaker', {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(buildData)
            }).then(response => response.json()
            ).then(data => {
                mimicSpeakerBuild.textContent =  data['longTitle']
                mimicSpeakerBuild.dataset.title = data['longTitle']
                mimicAuthor.textContent = data['author']
                mimicAuthor.dataset.author = data['author']
            }).catch(error => {
                console.error('Error:', error)
            })
            mimicButton.classList.remove('btn-outline-primary')
            mimicButton.classList.add('btn-primary')
            confirmPublishButton.classList.add('btn-outline-success')
            confirmPublishButton.classList.remove('btn-success')
            previewButton.classList.add('btn-outline-primary')
            previewButton.classList.remove('btn-primary')
            previewButton.textContent = 'Preview'
            buildMimicSpeakerButton.textContent = 'Change Mimic Speaker'
            mimicPreview.classList.add('d-none')
        } else {
            buildMimicSpeakerButton.textContent = 'Build Mimic Speaker'
            titleSelector.disabled = false
            genreSelector.disabled = false
        }
    })
}


async function addEventListenersToMimicButton(titleSelector, genreSelector, buildMimicSpeakerButton, mimicSpeakerBuild, lengthSelector,
                                              mimicButton, confirmPublishButton, previewButton, mimicEditor, mimicPreview, mimicAuthor, mimicPreviewTemplate)
{
    const editWordButtonHBTemplate = await getTextViaAJAX('templates/editWordButtonsTemplate.hbs')
    const editWordButtonTemplate = Handlebars.compile(editWordButtonHBTemplate)
    mimicButton.addEventListener('click', evt => {
        const mimicData = {
            sentenceLength: lengthSelector.value,
        }
        fetch('/mimic', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(mimicData),
        }).then(response => response.json()
        ).then(words => {
            document.querySelector('#wordEditor').innerHTML = editWordButtonTemplate({words:words})
            if (!confirmPublishButton.classList.contains('btn-success')){
                confirmPublishButton.classList.add('btn-success')
                confirmPublishButton.classList.remove('btn-outline-success')
                previewButton.classList.add('btn-primary')
                previewButton.classList.remove('btn-outline-primary')
            }
            if (!titleSelector.classList.contains('d-none')){
                toggleButtonsClasses([titleSelector, genreSelector, mimicSpeakerBuild], ['d-none'])
                buildMimicSpeakerButton.textContent = 'Change Mimic Speaker'
                buildMimicSpeakerButton.classList.add('btn-outline-primary')
                buildMimicSpeakerButton.classList.remove('btn-primary')
            }
            populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild, mimicPreviewTemplate)
            addAutoCloseEventListeners()
            addEventListenersToEditButtons()
        }).catch(error => {
            document.querySelector('#wordsContainer').innerHTML = '<h3 class="text-center">Please build a mimic speaker.</h3>'
            console.error('Error:', error)
        });
    })
}

async function addEventListenerToPreviewToggle(previewButton, mimicPreview, wordEditor, mimicAuthor, mimicEditor, mimicSpeakerBuild, mimicPreviewTemplate)
{
    previewButton.addEventListener('click', evt => {
        populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild, mimicPreviewTemplate)
        wordEditor.classList.toggle('d-none')
        mimicPreview.classList.toggle('d-none')
        if (mimicPreview.classList.contains('d-none')){
            previewButton.textContent = 'Preview'
        } else {
            previewButton.textContent = 'Editor'
        }
    })
}

async function addEventListenersToPublishButton()
{
    const publishButton = document.querySelector('#publishButton')
    publishButton.addEventListener('click', evt => {
        const allWords = document.querySelectorAll('.wordButton')
        let mimicData = []
        allWords.forEach(word => {
            let wordData = {
                id: word.dataset.id,
                deleted: word.dataset.deleted,
                punctuated: word.dataset.punctuated,
                punctuation: word.dataset.punctuation,
                capitalised: word.dataset.capitalised,
                capitalisation: word.dataset.capitalisation
            }
            mimicData.push(wordData)
        })
        fetch('/publishMimic', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(mimicData),
        }).then(response => response.json()
        ).then(data => console.log(data)
        ).catch(error => {
            console.error('Error:', error)
        })
    })
}


