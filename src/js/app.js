let step = 1;

document.addEventListener('DOMContentLoaded', function() {
    startApp();
});

function startApp() {
    showSection(); // Show section with a specific step
    tabs(); // Change between tabs
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
        });
    });
}