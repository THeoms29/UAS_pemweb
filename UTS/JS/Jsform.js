document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const alertContainer = document.getElementById('alert-container');
    const loginButton = document.getElementById('login-btn');

    // Fungsi untuk menampilkan alert
    function showAlert(message, type = 'danger') {
        const alertHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        alertContainer.innerHTML = alertHTML;
    }

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form submit secara default

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        if (!email || !password) {
            showAlert('Email dan Password harus diisi.');
            return;
        }

        loginButton.disabled = true;
        loginButton.textContent = 'Logging in...';

        const formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);

        // Kirim data ke Login.php itu sendiri
        fetch('Login.php', { // URL diubah ke Login.php
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menghubungi server.', 'danger');
        })
        .finally(() => {
            loginButton.disabled = false;
            loginButton.textContent = 'LOGIN';
        });
    });
});