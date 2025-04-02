import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        console.log('This log comes from assets/controllers/table_controller.js');
        const tableRows = document.querySelectorAll('.patent-row');
        // console.log(tableRows);
        tableRows.forEach(row => {
            row.addEventListener('click', () => {
                const patentId = row.getAttribute('data-patent-id');
                window.location.href = `/view/patent/${patentId}`;
            });
        });
        const tableHeaders = document.querySelectorAll('.table-header');
        tableHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const column = header.getAttribute('data-field');
                const order = header.getAttribute('data-order') || 'ASC';
                const newOrder = order === 'ASC' ? 'DESC' : 'ASC';
                window.location.href = `/view/table?sort=${column}&order=${newOrder}`;
            });
        });
    }
}