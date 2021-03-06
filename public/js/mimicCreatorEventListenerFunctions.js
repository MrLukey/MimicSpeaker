// main function, runs entire file
async function addAllMimicCreatorEventListeners()
{
    const openButton = document.querySelector('#openCreatorButton') // the button to open/close the mimic creator
    const closeButton = document.querySelector('#closeCreatorButton') // the button to close the mimic creator
    const mimicEditor = document.querySelector('#mimicEditor') // the div that holds the editor
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
    const reportMessage = document.querySelector('#reportMessage') // div that is used to report results to user

    const previewHBTemplate = await getTextViaAJAX('templates/mimicPreviewTemplate.hbs').catch()
    const mimicPreviewTemplate = Handlebars.compile(previewHBTemplate)

    const editWordButtonHBTemplate = await getTextViaAJAX('templates/editWordButtonsTemplate.hbs')
    const editWordButtonTemplate = Handlebars.compile(editWordButtonHBTemplate)

    addEventListenersToOpenButton(openButton, mimicEditor)
    addEventListenersToCloseButton(closeButton, mimicEditor)
    addEventListenersToTitleSelector(titleSelector, genreSelector)
    addEventListenersToGenreSelector(genreSelector, titleSelector)

    addEventListenersToBuildMimicSpeakerButton(mimicEditor, titleSelector, genreSelector, buildMimicSpeakerButton,
        mimicSpeakerBuild, wordEditor, mimicButton, mimicAuthor, confirmPublishButton, previewButton, mimicPreview, reportMessage)

    addEventListenersToMimicButton(titleSelector, genreSelector, buildMimicSpeakerButton, mimicSpeakerBuild, lengthSelector, mimicButton,
        confirmPublishButton, previewButton, mimicEditor, mimicPreview, mimicAuthor, mimicPreviewTemplate, editWordButtonTemplate, reportMessage)

    addEventListenerToPreviewToggle(previewButton, mimicPreview, wordEditor, mimicAuthor,
        mimicEditor, mimicSpeakerBuild, mimicPreviewTemplate, reportMessage)

    await addEventListenersToPublishButton(publishButton, wordEditor, mimicPreview, reportMessage).catch()
}

// helper function to read file as text (used to bring in Handlebars templates)
async function getTextViaAJAX(path)
{
    return await fetch(path, {method: 'get'}).then(data => data.text())
}

// helper function to simplify toggling classes on multiple buttons (may be pointless)
function toggleButtonsClasses(buttons, toggleClasses)
{
    buttons.forEach(button => {
        toggleClasses.forEach(classToToggle => {
            button.classList.toggle(classToToggle)
        })
    })
}

// helper function to populate the preview div with edited mimic string
function populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild, mimicPreviewTemplate)
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


function addEventListenersToOpenButton(openButton, mimicEditor)
{
    openButton.addEventListener('click', evt => {
        mimicEditor.classList.toggle('d-none')
    })
}

function addEventListenersToCloseButton(closeButton, mimicEditor)
{
    closeButton.addEventListener('click', evt => {
        mimicEditor.classList.toggle('d-none')
    })
}

function addEventListenersToTitleSelector(titleSelector, genreSelector)
{
    titleSelector.addEventListener('change', evt => {
        genreSelector.disabled = titleSelector.options.selectedIndex !== 0;
        genreSelector.value = titleSelector.options[titleSelector.options.selectedIndex].dataset.genre
    })
}

function addEventListenersToGenreSelector(genreSelector, titleSelector)
{
    genreSelector.addEventListener('change', evt => {
        titleSelector.disabled = genreSelector.options.selectedIndex !== 0;
        titleSelector.value = ''
    })
}

function addEventListenersToBuildMimicSpeakerButton(
    mimicEditor, titleSelector, genreSelector, buildMimicSpeakerButton, mimicSpeakerBuild, wordEditor, mimicButton,
    mimicAuthor, confirmPublishButton, previewButton, mimicPreview, reportMessage)
{
    buildMimicSpeakerButton.addEventListener('click', evt => {
        toggleButtonsClasses([buildMimicSpeakerButton], ['btn-outline-primary', 'btn-primary'])
        toggleButtonsClasses([titleSelector, genreSelector, mimicSpeakerBuild], ['d-none'])
        if (titleSelector.classList.contains('d-none')){
            mimicPreview.innerHTML = ''
            reportMessage.innerHTML = ''
            wordEditor.innerHTML = ''
            wordEditor.classList.remove('d-none')
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

function addEventListenersToMimicButton(
    titleSelector, genreSelector, buildMimicSpeakerButton, mimicSpeakerBuild, lengthSelector, mimicButton, confirmPublishButton,
    previewButton, mimicEditor, mimicPreview, mimicAuthor, mimicPreviewTemplate, editWordButtonTemplate, reportMessage)
{
    mimicButton.addEventListener('click', evt => {
        reportMessage.classList.add('d-none')
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
            addAllEditButtonEventListeners()
            addAllPageEventListeners()
        }).catch(error => {
            document.querySelector('#wordsContainer').innerHTML = '<h3 class="text-center">Please build a mimic speaker.</h3>'
            console.error('Error:', error)
        });
    })
}

function addEventListenerToPreviewToggle(previewButton, mimicPreview, wordEditor, mimicAuthor,
                                               mimicEditor, mimicSpeakerBuild, mimicPreviewTemplate, reportMessage)
{
    previewButton.addEventListener('click', evt => {
        populatePreview(mimicEditor, mimicPreview, mimicAuthor, mimicSpeakerBuild, mimicPreviewTemplate)
        if (mimicPreview.classList.contains('d-none')){
            mimicPreview.classList.remove('d-none')
            wordEditor.classList.add('d-none')
            reportMessage.classList.add('d-none')
            previewButton.textContent = 'Editor'
        } else {
            mimicPreview.classList.add('d-none')
            wordEditor.classList.remove('d-none')
            reportMessage.classList.add('d-none')
            previewButton.textContent = 'Preview'
        }
    })
}

async function addEventListenersToPublishButton(publishButton, wordEditor, mimicPreview, reportMessage)
{
    publishButton.addEventListener('click', evt => {
        let allWords = document.querySelectorAll('.wordButton')
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
        ).then(data => {
            if (data.success){
                reportMessage.innerHTML = '<h4 class="">' + data.success + '</h4>'
            } else {
                reportMessage.innerHTML = '<h4 class="">' + data.error + '</h4>'
            }
            reportMessage.classList.remove('d-none')
            wordEditor.innerHTML = ''
            mimicPreview.innerHTML = ''
        }).catch()
    })
}


