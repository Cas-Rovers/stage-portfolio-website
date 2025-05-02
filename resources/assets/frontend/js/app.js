import './bootstrap';

import.meta.glob([
    '../media/**'
]);

document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', (event) => {
        const submitButton = event.submitter;

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            submitButton.innerHTML = `<i class="fa-solid fa-spinner fa-spin-pulse"></i>`;
        }
    });
});

// document.addEventListener('DOMContentLoaded', () => {
//     const observer = new IntersectionObserver((entries, observer) => {
//         entries.forEach((entry) => {
//             if (entry.isIntersecting) {
//                 entry.target.classList.remove('opacity-0');
//                 entry.target.classList.add('animate-fade-in');
//                 observer.unobserve(entry.target);
//             }
//         });
//     }, {
//         threshold: 0.1
//     });

//     const sections = document.querySelectorAll('section');

//     sections.forEach((section) => {
//         section.classList.add('opacity-0');
//         observer.observe(section);
//     });
// });
