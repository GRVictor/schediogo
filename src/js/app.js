let step = 1;
const firstStep = 1;
const lastStep = 3;

const appoinment = {
    name: '',
    date: '',
    time: '',
    services: []
}

document.addEventListener('DOMContentLoaded', function() {
    startApp();
});

function startApp() {
    showSection(); // Show section with a specific step
    tabs(); // Change between tabs
    buttonsPager(); // Add or remove buttons to the pager
    nextPage(); // Go to the next page
    previousPage(); // Go to the previous page

    consultAPI(); // Consult API in PHP backend
}

function showSection() {
    // Hide section with class show
    const previousSection = document.querySelector('.show');
    if (previousSection) {
        previousSection.classList.remove('show');
    }

    // Select section with a specific step
    const stepSelector = `#step-${step}`;
    const section = document.querySelector(stepSelector);	
    section.classList.add('show');

    // Remove active button
    const previousButton = document.querySelector('.current');
    if (previousButton) {
        previousButton.classList.remove('current');
    }

    // Change active button
    const tab = document.querySelector(`[data-step="${step}"]`);
    tab.classList.add('current');
}

function tabs() {
    const buttons = document.querySelectorAll('.tabs button');

    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            step = parseInt(e.target.dataset.step);
            showSection();
            buttonsPager();
        });
    });
}

function buttonsPager() {
    const nextPage = document.querySelector('#next');
    const previousPage = document.querySelector('#prev');

    if(step === firstStep) {
        previousPage.classList.add('hidden');
        nextPage.classList.remove('hidden');
    } else if (step === lastStep) {
        previousPage.classList.remove('hidden');
        nextPage.classList.add('hidden');
    } else {
        previousPage.classList.remove('hidden');
        nextPage.classList.remove('hidden');
    }

}

function previousPage() {
    const previousPage = document.querySelector('#prev');
    previousPage.addEventListener('click', function() {
        if (step <= firstStep) return;
        step--;
        buttonsPager();
        showSection();
    });
}

function nextPage() {
    const nextPage = document.querySelector('#next');
    nextPage.addEventListener('click', function() {
        if (step >= lastStep) return;
        step++;
        buttonsPager();
        showSection();
    });
}

async function consultAPI() {
    try {
        const url = 'http://localhost:3000/api/services';
        const result = await fetch(url);
        const services = await result.json();
        showServices(services);
        
    } catch (error) {
        console.log(error);
    }
}

function showServices(services) {
    services.forEach(service => {
        const { id, service_name, price } = service;

        const serviceName = document.createElement('P');
        serviceName.classList.add('service-name');
        serviceName.textContent = service_name;

        const servicePrice = document.createElement('P');
        servicePrice.classList.add('service-price');
        servicePrice.textContent = `$ ${price}`;

        const serviceDiv = document.createElement('DIV');
        serviceDiv.classList.add('service');
        serviceDiv.dataset.idService = id;
        serviceDiv.onclick = function() {
            selectService(service);
        }

        serviceDiv.appendChild(serviceName);
        serviceDiv.appendChild(servicePrice);

        document.querySelector('#service').appendChild(serviceDiv);

    });
}

function selectService(service) {
    const { id } = service;
    const { services } = appoinment;

    // Verificar si el servicio ya está seleccionado
    const selectedService = document.querySelector(`[data-id-service="${id}"]`);
    if (selectedService.classList.contains('selected')) {
        // Si ya está seleccionado, eliminarlo de la lista de servicios
        appoinment.services = services.filter(s => s.id !== id);
        selectedService.classList.remove('selected');
    } else {
        // Si no está seleccionado, agregarlo a la lista de servicios
        appoinment.services = [...services, service];
        selectedService.classList.add('selected');
    }

    console.log(appoinment);
}