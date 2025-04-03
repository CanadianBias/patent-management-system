import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        console.log('This log comes from assets/controllers/patent_controller.js');

        const tableHeaders = document.querySelectorAll('.table-header');
        tableHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const column = header.getAttribute('data-field');
                const order = header.getAttribute('data-order') || 'ASC';
                const newOrder = order === 'ASC' ? 'DESC' : 'ASC';
                const baseURL = window.location.pathname.split('/').pop();
                console.log(baseURL);
                window.location.href = `/view/patent/${baseURL}?sort=${column}&order=${newOrder}`;
            })
        });

        const tableRow = document.querySelector('.single-patent');
        tableRow.addEventListener('click', () => {
            console.log('clicked');
            const baseURL = window.location.pathname.split('/').pop();
            window.location.href = `/view/patent/${baseURL}/edit`;
        });

        const dateRows = document.querySelectorAll('.date-row');
        dateRows.forEach(row => {
            row.addEventListener('click', () => {
                console.log('clicked');
                const dateId = row.getAttribute('data-id');
                window.location.href = `/view/date/${dateId}/edit`;
            })
        });
    }
}