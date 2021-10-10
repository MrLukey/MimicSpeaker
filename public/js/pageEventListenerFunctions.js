// add event listeners to ensure only one editButtons div is open at any time, and clicking away will close them all
function addAutoCloseEventListeners()
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
    })
    document.addEventListener('mouseup', evt => {
        editButtonsDivs.forEach(editButtonDiv => {
            if (!editButtonDiv.classList.contains('d-none')) {
                editButtonDiv.classList.toggle('d-none')
            }
        })
    })
}