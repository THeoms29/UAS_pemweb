document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');
    const alertContainer = document.getElementById('alert-container');

    // Fungsi untuk menampilkan alert
    function showAlert(message, type = 'danger') {
        const alertHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        alertContainer.innerHTML = alertHTML;
        
        // Auto hide alert after 5 seconds
        setTimeout(() => {
            const alert = alertContainer.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }

    // Fungsi untuk validasi password
    function validatePassword(password) {
        const minLength = 6;
        if (password.length < minLength) {
            return `Password minimal ${minLength} karakter`;
        }
        return null;
    }

    // Fungsi untuk validasi email
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            return 'Format email tidak valid';
        }
        return null;
    }

    // Event listener untuk form submit
    signupForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Ambil data dari form
        const formData = new FormData(signupForm);
        const fullName = formData.get('full_name').trim();
        const email = formData.get('email').trim();
        const password = formData.get('password');
        const confirmPassword = formData.get('confirm_password');
        const termsAccepted = formData.get('terms');
        
        // Array untuk menyimpan error
        let errors = [];
        
        // Validasi client-side
        if (!fullName) {
            errors.push('Nama lengkap harus diisi');
        }
        
        if (!email) {
            errors.push('Email harus diisi');
        } else {
            const emailError = validateEmail(email);
            if (emailError) {
                errors.push(emailError);
            }
        }
        
        if (!password) {
            errors.push('Password harus diisi');
        } else {
            const passwordError = validatePassword(password);
            if (passwordError) {
                errors.push(passwordError);
            }
        }
        
        if (!confirmPassword) {
            errors.push('Konfirmasi password harus diisi');
        } else if (password !== confirmPassword) {
            errors.push('Password dan konfirmasi password tidak sama');
        }
        
        if (!termsAccepted) {
            errors.push('Anda harus menyetujui Syarat & Ketentuan');
        }
        
        // Jika ada error, tampilkan dan stop
        if (errors.length > 0) {
            showAlert(errors.join('<br>'), 'danger');
            return;
        }
        
        // Disable submit button untuk mencegah double submit
        const submitButton = signupForm.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.disabled = true;
        submitButton.textContent = 'Processing...';
        
        // Kirim data dengan AJAX
        fetch('process_signup.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                
                // Reset form
                signupForm.reset();
                
                // Redirect after 2 seconds
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 2000);
                }
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan pada server. Silakan coba lagi.', 'danger');
        })
        .finally(() => {
            // Re-enable submit button
            submitButton.disabled = false;
            submitButton.textContent = originalText;
        });
    });

    // Real-time validation untuk password confirmation
    const passwordInput = signupForm.querySelector('input[name="password"]');
    const confirmPasswordInput = signupForm.querySelector('input[name="confirm_password"]');
    
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value && passwordInput.value) {
            if (this.value !== passwordInput.value) {
                this.setCustomValidity('Password tidak sama');
            } else {
                this.setCustomValidity('');
            }
        }
    });

    passwordInput.addEventListener('input', function() {
        if (confirmPasswordInput.value) {
            if (this.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('Password tidak sama');
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        }
    });
});