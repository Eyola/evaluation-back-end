document.querySelector('#Candidat').addEventListener(
    'click', () => {
        document.querySelector('.business').hidden = true;
        document.querySelector('.address').hidden = true;
        document.querySelector('.cv').hidden = false;
        document.querySelector('.btn-inscription').hidden = false;
    }
)

document.querySelector('#Recruteur').addEventListener(
    'click', () => {
        document.querySelector('.cv').hidden = true;
        document.querySelector('.business').hidden = false;
        document.querySelector('.address').hidden = false;
        document.querySelector('.btn-inscription').hidden = false;
    }
)