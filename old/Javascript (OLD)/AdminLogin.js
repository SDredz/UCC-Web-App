document.addEventListener('DOMContentLoaded', () => {
    const adminLoginForm = document.getElementById('admin-login-form');

    // Handle admin login form submission
    adminLoginForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const adminNameInput = document.getElementById('admin-name');
        const adminPasswordInput = document.getElementById('admin-password');

        if (adminNameInput.value === 'Admin' && adminPasswordInput.value === 'Admin') {
            // Redirect to the admin dashboard
            window.location.href = 'AdminDashboard.html';
        } else {
            alert('Invalid admin name or password.');
            adminNameInput.value = '';
            adminPasswordInput.value = '';
            adminNameInput.focus();
        }
    });
});