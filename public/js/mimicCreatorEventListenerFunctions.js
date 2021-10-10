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
async function populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild)
{
    const previewHBTemplate = await getTextViaAJAX('templates/mimicPreviewTemplate.hbs').catch()
    const mimicPreviewTemplate = Handlebars.compile(previewHBTemplate)
    let allWordButtons = document.querySelectorAll('.wordButton')
    let editedMimicString = ''
    let wordsAdded = 0;
    if (allWordButtons.length > 0){
        editedMimicString += '"'
        allWordButtons.forEach(wordButton => {
            if (!wordButton.dataset.deleted){
                editedMimicString += wordButton.textContent + ' '
                wordsAdded++
            }
        })
        editedMimicString = editedMimicString.substr(0, editedMimicString.length - 1)
        if (wordsAdded > 0){
            editedMimicString += '"'
        }
    }
    const data = {
        title: 'Mimic of ' + mimicSpeakerBuild.dataset.title + ' by ' + mimicAuthor.dataset.author,
        author: mimicEditor.dataset.username,
        mimic: editedMimicString
    }
    mimicPreview.innerHTML = mimicPreviewTemplate(data)
}

// main function, runs entire file
function addEventListenersForMimicCreator()
{
    const openButton = document.querySelector('#openCreatorButton')
    const closeButton = document.querySelector('#closeCreatorButton')
    const mimicEditor = document.querySelector('#mimicEditor')
    const titleSelector = document.querySelector('#titleSelector')
    const genreSelector = document.querySelector('#genreSelector')
    const buildMimicSpeakerButton = document.querySelector('#buildMimicSpeaker')
    const mimicSpeakerBuild = document.querySelector('#mimicSpeakerBuild')
    const lengthSelector = document.querySelector('#sentenceLengthSelector')
    const mimicButton = document.querySelector('#mimicButton')
    const mimicAuthor = document.querySelector('#mimicAuthor')
    const publishButton = document.querySelector('#publishButton')
    const previewButton = document.querySelector('#previewButton')
    const mimicPreview = document.querySelector('#mimicPreview')
    const wordEditor = document.querySelector('#wordEditor')

    addEventListenersToOpenAndCloseButtons(openButton, closeButton, mimicEditor)
    addEventListenersToMimicSpeakerBuilder(mimicEditor, titleSelector, genreSelector, buildMimicSpeakerButton,
        mimicSpeakerBuild, mimicButton, mimicAuthor, publishButton, previewButton)
    addEventListenersToMimicButton(titleSelector, genreSelector, buildMimicSpeakerButton, mimicSpeakerBuild,
        lengthSelector, mimicButton, publishButton, previewButton, mimicEditor, mimicPreview, mimicAuthor).catch()
    addEventListenerToPreviewToggle(previewButton, mimicPreview, wordEditor, mimicAuthor, mimicEditor, mimicSpeakerBuild).catch()
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
                                                mimicButton, mimicAuthor, publishButton, previewButton, mimicPreview)
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
            publishButton.classList.add('btn-outline-success')
            publishButton.classList.remove('btn-success')
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
                                              mimicButton, publishButton, previewButton, mimicEditor, mimicPreview, mimicAuthor)
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
            if (!publishButton.classList.contains('btn-success')){
                publishButton.classList.add('btn-success')
                publishButton.classList.remove('btn-outline-success')
                previewButton.classList.add('btn-primary')
                previewButton.classList.remove('btn-outline-primary')
            }
            if (!titleSelector.classList.contains('d-none')){
                toggleButtonsClasses([titleSelector, genreSelector, mimicSpeakerBuild], ['d-none'])
                buildMimicSpeakerButton.textContent = 'Change Mimic Speaker'
                buildMimicSpeakerButton.classList.add('btn-outline-primary')
                buildMimicSpeakerButton.classList.remove('btn-primary')
            }
            populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild)
            addAutoCloseEventListeners()
            addEventListenersToEditButtons()
        }).catch(error => {
            document.querySelector('#wordsContainer').innerHTML = '<h3 class="text-center">Please build a mimic speaker.</h3>'
            console.error('Error:', error)
        });
    })
}

async function addEventListenerToPreviewToggle(previewButton, mimicPreview, wordEditor, mimicAuthor, mimicEditor, mimicSpeakerBuild)
{
    previewButton.addEventListener('click', evt => {
        populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild)
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


