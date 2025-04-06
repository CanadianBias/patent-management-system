import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        console.log('This log comes from assets/controllers/patent_controller.js');

        // The below event listeners is for the date table in a patent view

        // Grab all elements with table-header class
        const tableHeaders = document.querySelectorAll('.table-header');
        // Add click event listener to each
        tableHeaders.forEach(header => {
            header.addEventListener('click', () => {
                // grab which field was clicked and current order
                const column = header.getAttribute('data-field');
                const order = header.getAttribute('data-order') || 'ASC';
                // toggle the order
                const newOrder = order === 'ASC' ? 'DESC' : 'ASC';
                // grab what patent is being sorted
                const baseURL = window.location.pathname.split('/').pop();
                // console.log(baseURL);
                // Redirect to the same page with the new order
                window.location.href = `/view/patent/${baseURL}?sort=${column}&order=${newOrder}`;
            })
        });

        // Event listener below allows for editing of patent
        const tableRow = document.querySelector('.single-patent');
        // When patent is clicked in patent view
        tableRow.addEventListener('click', () => {
            // console.log('clicked');
            // Grab the current patent id from the URL
            const baseURL = window.location.pathname.split('/').pop();
            // Redirect to edit page (form)
            window.location.href = `/view/patent/${baseURL}/edit`;
        });

        // Event listener below allows for editing of patent dates
        const dateRows = document.querySelectorAll('.date-row');
        dateRows.forEach(row => {
            row.addEventListener('click', () => {
                // console.log('clicked');
                // Grab date id from the data-id attribute
                const dateId = row.getAttribute('data-id');
                // Redirect to edit page (form)
                window.location.href = `/view/date/${dateId}/edit`;
            })
        });
    }
}