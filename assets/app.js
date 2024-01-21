// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

document.getElementById('movieForm').addEventListener('submit', function(event) {
    let isValid = true;
    const fields = ['title', 'director_name', 'director_surname'];

    fields.forEach(function(field) {
        const input = document.getElementById(field);
    if (!input.value.trim()) {
        input.classList.add('invalid-input')
        isValid = false;
    } else {
        input.classList.remove('invalid-input')
    }
    });

    if (!isValid) {
        event.preventDefault()
    }
});