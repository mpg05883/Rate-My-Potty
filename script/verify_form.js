// get form
const form = document.querySelector('#add-review-form');

// get input nodes
const firstName = document.querySelector('#first-name');
const lastName = document.querySelector('#last-name');
const building_id = document.querySelector('#building-id');
const rating = document.querySelector('#rating');

// create array of input nodes
const nodeList = [firstName, lastName, building_id, rating];

removeError = (node) => {
    // get node's id
    const nodeID = node.id
    
    // get corresponding small's id
    const smallID = '#' + nodeID + '-error';

    console.log(smallID);

    // get corresponding small element
    const small = document.querySelector(smallID)

    // remove textContent
    small.textContent = '';
}

// return true if input is not null and not an empty string
validInput = (text) => {
    console.log("test " + text);
    return (text !== null && text.trim() !== 0);
}

displayError = (node) => {
    // get node's id
    const nodeID = node.id
    
    // get corresponding small's id
    const smallID = '#' + nodeID + '-error';

    // get corresponding small element
    const small = document.querySelector(smallID)

    // display appropriate error message
    if (nodeID === 'first-name' || nodeID === 'last-name') {
        small.textContent = 'Cannot be empty';
    }
    else if (nodeID === 'building-id') {
        small.textContent = 'Building must be selected';
    }
    else {
        small.textContent = 'Rating must be between 0 and 5';
    }
}

// handle submit
const handleSubmit = (event) => {
    // prevent default behavior
    event.preventDefault()

    // clear text for all small elements
    for (let i = 0; i < nodeList.length; i++) {
        console.log(nodeList[i].textContent);
        removeError(nodeList[i]);
    }

    /*
    make sure each required input is valid
    - if any required input is invalid, display error message and return false
    */
    for (let i = 0; i < nodeList.length; i++) {
        if(!validInput(nodeList[i].textContent)) {
            displayError(nodeList[i]);
            return false;
        }
    }

    return true;
}

// add event handler to submit btn
form.onsubmit = handleSubmit;

