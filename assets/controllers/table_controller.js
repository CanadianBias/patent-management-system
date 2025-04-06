import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        console.log('This log comes from assets/controllers/table_controller.js');

        // Event listener below redirects click events to navigate to page containing detailed patent information

        const tableRows = document.querySelectorAll('.patent-row');
        // console.log(tableRows);
        tableRows.forEach(row => {
            row.addEventListener('click', () => {
                // Grab patent id from attribute
                const patentId = row.getAttribute('data-patent-id');
                // Navigate to patent view based off of patent id
                window.location.href = `/view/patent/${patentId}`;
            });
        });

        // Event listener allows for sorting of patent table

        // Add click event listener to all table headers
        const tableHeaders = document.querySelectorAll('.table-header');
        tableHeaders.forEach(header => {
            header.addEventListener('click', () => {
                // get current field and order of header clicked
                const column = header.getAttribute('data-field');
                const order = header.getAttribute('data-order') || 'ASC';
                // toggle order
                const newOrder = order === 'ASC' ? 'DESC' : 'ASC';
                // Redirect to same page with sorting criteria
                // Actual order is handled in PHP controller and Repository
                window.location.href = `/view/table?sort=${column}&order=${newOrder}`;
            });
        });
    }
}