import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const deleteAccount = document.getElementById('delete-account');
        deleteAccount.addEventListener('click', () => {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                window.location.href = `/delete/inventor/${deleteAccount.getAttribute('data-id')}`;
            }
        });
    }
}