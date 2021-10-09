// main function, runs entire file
function addEventListenersForMimicCreator()
{
    addEventListenersToMimicSpeakerBuilder()
    addEventListenersToMimicButton().catch()
    addEventListenerToPreviewToggle().catch()
}

// helper function to read file as text (used to bring in Handlebars templates)
async function getTextViaAJAX(path)
{
    return await fetch(path, {method: 'get'}).then(data => data.text())
}

// add event listeners to title and genre select inputs, and build button
function addEventListenersToMimicSpeakerBuilder()
{
    const titleSelector = document.querySelector('#titleSelector')
    const genreSelector = document.querySelector('#genreSelector')
    const buildMimicButton = document.querySelector('#buildMimicSpeaker')
    const mimicSpeakerBuild = document.querySelector('#mimicSpeakerBuild')
    const mimicAuthor = document.querySelector('#mimicAuthor')

    titleSelector.addEventListener('change', evt => {
        genreSelector.disabled = titleSelector.options.selectedIndex !== 0;
        genreSelector.value = titleSelector.options[titleSelector.options.selectedIndex].dataset.genre
    })

    genreSelector.addEventListener('change', evt => {
        titleSelector.disabled = genreSelector.options.selectedIndex !== 0;
        titleSelector.value = ''
    })

    buildMimicButton.addEventListener('click', evt => {
        titleSelector.classList.toggle('d-none')
        genreSelector.classList.toggle('d-none')
        mimicSpeakerBuild.classList.toggle('d-none')
        if (titleSelector.classList.contains('d-none')){
            buildMimicButton.textContent = 'Change Mimic Speaker'
            document.querySelector('#wordsContainer').innerHTML = ''
            mimicSpeakerBuild.innerHTML = ''
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
                mimicSpeakerBuild.innerHTML = '<h4 class="">' + data['longTitle'] + '</h4>'
                mimicAuthor.textContent = data['author']
            }).catch(error => {
                console.error('Error:', error)
            })
        } else {
            buildMimicButton.textContent = 'Build Mimic Speaker'
            titleSelector.disabled = false
            genreSelector.disabled = false
        }
    })
}


async function addEventListenersToMimicButton()
{
    const lengthSelector = document.querySelector('#sentenceLengthSelector')
    const mimicButton = document.querySelector('#mimicButton')
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
            addAutoCloseEventListeners()
            addEventListenersToEditButtons()
        }).catch((error) => {
            console.error('Error:', error);
        });
    })
}

async function addEventListenerToPreviewToggle()
{
    const previewHBTemplate = await getTextViaAJAX('templates/mimicPreviewTemplate.hbs')
    const previewButton = document.querySelector('#previewButton')
    const mimicPreviewTemplate = Handlebars.compile(previewHBTemplate)
    previewButton.addEventListener('click', evt => {
        const mimicPreview = document.querySelector('#mimicPreview')
        const wordEditor = document.querySelector('#wordEditor')
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
            title: 'test',
            author: 'testAuthor',
            mimic: editedMimicString
        }
        mimicPreview.innerHTML = mimicPreviewTemplate(data)
        wordEditor.classList.toggle('d-none')
        mimicPreview.classList.toggle('d-none')
        if (mimicPreview.classList.contains('d-none')){
            previewButton.textContent = 'Preview'
        } else {
            previewButton.textContent = 'Editor'
        }
    })
}


