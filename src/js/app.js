let step = 1;
const firstStep = 1;
const lastStep = 3;

document.addEventListener('DOMContentLoaded', function() {
    startApp();
});

function startApp() {
    showSection(); // Show section with a specific step
    tabs(); // Change between tabs
    buttonsPager(); // Add or remove buttons to the pager
    nextPage(); // Go to the next page
    previousPage(); // Go to the previous page
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