

async function getTextViaAJAX(path)
{
    return await fetch(path, {method: 'get'}).then(data => data.text())
}

function addEventListenersToMimicSpeakerBuilder()
{
    const titleSelector = document.querySelector('#titleSelector')
    const genreSelector = document.querySelector('#genreSelector')
    const buildMimicButton = document.querySelector('#buildMimicSpeaker')
    const mimicSpeakerBuild = document.querySelector('#mimicSpeakerBuild')

    titleSelector.addEventListener('change', evt => {
        genreSelector.disabled = titleSelector.options.selectedIndex !== 0;
        switch (titleSelector.value){
            case 'trump':
                genreSelector.value = 'Politics'
                break
            case 'dont-panic':
                genreSelector.value = 'Sci-fi'
                break
            case 'hitchers':
                genreSelector.value = 'Sci-fi'
                break
            case 'corsair':
                genreSelector.value = 'Poetry'
                break
            case 'churchill':
                genreSelector.value = 'Politics'
                break
            case 'bible':
                genreSelector.value = 'Religion'
                break
            case 'luther-king':
                genreSelector.value = 'Politics'
                break
            default:
                genreSelector.value = ''
        }
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
                console.log(data)
                mimicSpeakerBuild.innerHTML = '<h4 class="">' + data['longTitle'] + '</h4>'
            }).catch(error => {
                console.error('Error:', error)
            })
        } else {
            buildMimicButton.textContent = 'Build Mimic Speaker'
        }
    })
}


async function addEventListenersToMimicSpeaker()
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
        let editedMimicString = '"'
        document.querySelectorAll('.wordButton').forEach(wordButton => {
            if (!wordButton.dataset.deleted){
                editedMimicString += wordButton.textContent + ' '
            }
        })
        editedMimicString = editedMimicString.substr(0, editedMimicString.length - 1)
        editedMimicString += '"'

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


