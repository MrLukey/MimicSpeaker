// main function, runs entire file
function addAllPageEventListeners()
{
    const editButtonsDivs = document.querySelectorAll('.editButtons')
    addAutoCloseEventListeners(editButtonsDivs)
}


// add event listeners to ensure only one editButtons div is open at any time, and clicking away will close them all
function addAutoCloseEventListeners(editButtonsDivs)
{
    document.addEventListener('mouseup', evt => {
        editButtonsDivs.forEach(editButtonDiv => {
            if (!editButtonDiv.classList.contains('d-none')) {
                editButtonDiv.classList.toggle('d-none')
            }
        })
    })
}