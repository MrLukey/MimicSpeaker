

async function getTextViaAJAX(path)
{
    return await fetch(path, {method: 'get'}).then(data => data.text());
}

const titleSelector = document.querySelector('#titleSelector')
const genreSelector = document.querySelector('#genreSelector')
const buildMimicButton = document.querySelector('#buildMimicSpeaker')

buildMimicButton.addEventListener('click', evt => {
    const buildData = {
        shortTitle: titleSelector.options[titleSelector.selectedIndex].value,
        genre: genreSelector.options[genreSelector.selectedIndex].value
    }
    fetch('/buildMimicSpeaker', {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(buildData),})
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);})
        .catch((error) => {
            console.error('Error:', error);});
})


async function getNewMimic(){
    const lengthSelector = document.querySelector('#sentenceLengthSelector')
    const mimicButton = document.querySelector('#mimicButton')
    const mimicEditorHBTemplate = await getTextViaAJAX('templates/mimicEditor.hbs');
    const mimicEditorTemplate = Handlebars.compile(mimicEditorHBTemplate);
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
            console.log(words)
            document.querySelector('#mimicSpeech').innerHTML = mimicEditorTemplate({data:words})
            addAutoCloseEventListeners()
            addEventListenersToEditButtons()
        }).catch((error) => {
            console.error('Error:', error);
        });
    })
}

getNewMimic().catch()


