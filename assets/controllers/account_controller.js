import { Controller } from '@hotwired/stimulus';
// This controller is associated with the AccountController page
// It handles the delete-account button and the download-account buttons which
// redirect to the DeleteController and DownloadController respectively. 
export default class extends Controller {
    connect() {
        const deleteAccount = document.getElementById('delete-account');
        deleteAccount.addEventListener('click', () => {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                window.location.href = `/delete/inventor/${deleteAccount.getAttribute('data-id')}`;
            }
        });
        const downloadAccount = document.getElementById('download-account');
        downloadAccount.addEventListener('click', () => {
            window.location.href = `/download/user/${downloadAccount.getAttribute('data-id')}`;
        });
    }   
}