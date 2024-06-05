const removeRow = (event) => {
    event.preventDefault();
    event.currentTarget.closest('tr').remove();
}

const setRemoveButtons = () => {
    const removeButtons = document.querySelectorAll('[data-remove-item]');
    for (const removeButton of removeButtons) {
        removeButton.removeEventListener('click', removeRow);
        removeButton.addEventListener('click', removeRow);
    }
}

const addItem = () => {
    let index = 0;
    const inputs = document.querySelectorAll('[data-index]');
    for (const input of inputs) {
        let inputIndex = parseInt(input.dataset.index, 10)
        if (inputIndex > index) {
            index = inputIndex;
        }
    }
    const template = document.getElementById('template').innerHTML;
    document.getElementById('tableBody').innerHTML += Mustache.render(template, {index: index + 1});
    setRemoveButtons();
}

const addButton = document.getElementById('addItem');
addButton.addEventListener('click', (event) => {
    event.preventDefault();
    addItem();
})

setRemoveButtons();
