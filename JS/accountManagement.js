document.querySelector('.showUsersBtn').addEventListener(
    'click', () => {
        document.querySelector('.showUsers').hidden = false;
        document.querySelector('.showUsersBtn').hidden = true;
        document.querySelector('.newConsultantBtn').hidden = false;
        document.querySelector('.createConsultant').hidden = true;
})

document.querySelector('.newConsultantBtn').addEventListener(
    'click', () => {
        document.querySelector('.showUsers').hidden = true;
        document.querySelector('.showUsersBtn').hidden = false;
        document.querySelector('.newConsultantBtn').hidden = true;
        document.querySelector('.createConsultant').hidden = false;
    })