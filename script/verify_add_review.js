// return true if input is no null and is not empty
isValidTextInput = (input) => {
    return (input == null || input.trim().length === 0);
}

// display error message:
displayErrorMessage = (node, message) => {
    isValid = false;

    // get node's id
    const nodeID = node.id
    
    // get corresponding small's id
    const smallID = '#' + nodeID + '-error';

    // get corresponding small element
    const small = document.querySelector(smallID)

    // fill in small's innerHTML
    small.innerHTML = message;
}

// if first name is invalid, display error message
    if (!isValidTextInput(firstName)) {
        displayErrorMessage(firstName, "First name cannot be empty.");
    }
    // else, remove error message
    else {

    }

// handle submit
const handleSubmit = (event) => {
    // prevent default behavior
    event.preventDefault()

    
}

// get form
const form = document.querySelector('form');

// get input nodes
const firstName = document.querySelector('#first-name');
const lastName = document.querySelector('#last-name');
const building = document.querySelector('#building');
const rating = document.querySelector('#rating');

// add event handler to submit btn
form.onsubmit = handleSubmit;



