import { Controller } from '@hotwired/stimulus';

// This controller handles the sorting, editing, deletion, and downloading of patents, dates, and files on the ViewPatentController page

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

        // Event listener allows for deletion of patent dates
        dateRows.forEach(row => {
            row.addEventListener('contextmenu', (event) => {
                // prevent default right click behaviour
                event.preventDefault();
                // determine which date was right clicked
                const dateId = row.getAttribute('data-id');
                // show an alert to confirm deletion
                const confirmDelete = confirm('Are you sure you want to delete this date?');
                // if confirmed, redirect to delete action
                if (confirmDelete) {
                    // Redirect to the delete action with the date ID
                    window.location.href = `/delete/date/${dateId}`;
                }
            })
        });

        // Event listener that downloads the files when clicked
        const fileRows = document.querySelectorAll('.file-row');
        fileRows.forEach(row => {
            row.addEventListener('click', () => {
                // grab the file id from the data-id attribute
                const fileId = row.getAttribute('data-id');
                // Redirect to download the file
                window.location.href = `/download/file/${fileId}`;
            })
        });

        // Event listener that allow for files to be deleted from patent
        fileRows.forEach(row => {
            row.addEventListener('contextmenu', (event) => {
                // prevent default right click behaviour
                event.preventDefault();
                // determine which file was right clicked
                const fileId = row.getAttribute('data-id');
                // show an alert to confirm deletion
                const confirmDelete = confirm('Are you sure you want to delete this file?');
                // if confirmed, redirect to delete action
                if (confirmDelete) {
                    // Redirect to the delete action with the file ID
                    window.location.href = `/delete/file/${fileId}`;
                }
            })
        });


        // Event listener that allows for whole patent to be deleted
        const deleteButton = document.getElementById('delete-patent');
        deleteButton.addEventListener('click', () => {
            // show an alert to confirm deletion
            const confirmDelete = confirm('Are you sure you want to delete this patent?');
            // grab the current patent id from the URL
            const baseURL = window.location.pathname.split('/').pop();
            // if confirmed, redirect to delete action
            if (confirmDelete) {
                // Redirect to the delete action with the patent ID
                window.location.href = `/delete/patent/${baseURL}`;
            }
        });
    }
}