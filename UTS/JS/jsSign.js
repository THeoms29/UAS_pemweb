document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');
    const alertContainer = document.getElementById('alert-container');

    // Tandai form sebagai AJAX mode
    signupForm.dataset.ajax = 'true';

    // Fungsi untuk menampilkan alert
    function showAlert(message, type = 'danger') {
        const alertHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        `;
        alertContainer.innerHTML = alertHTML;
        
        // Auto hide alert after 5 seconds untuk error, 3 detik untuk success
        const hideTimeout = type === 'success' ? 3000 : 5000;
        setTimeout(() => {
            const alert = alertContainer.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, hideTimeout);
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
        e.preventDefault(); // Mencegah traditional form submission
        
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
        
        // Jika ada error client-side, tampilkan dan stop
        if (errors.length > 0) {
            showAlert(errors.join('<br>'), 'danger');
            return;
        }
        
        // Disable submit button untuk mencegah double submit
        const submitButton = signupForm.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.disabled = true;
        submitButton.textContent = 'Creating Account...';
        
        // Clear previous alerts
        alertContainer.innerHTML = '';
        
        // Lakukan AJAX request ke server
        fetch('SignUp.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest' // Identifier untuk AJAX request
            }
        })
        .then(response => {
            // Check if response is ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Tampilkan pesan sukses
                showAlert(data.message, 'success');
                
                // Reset form setelah berhasil
                signupForm.reset();
                
                // Redirect ke halaman login setelah 2 detik
                if (data.redirect) {
                    setTimeout(() => {
                        showAlert('Redirecting to login page...', 'success');
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1000);
                    }, 2000);
                }
            } else {
                // Tampilkan pesan error dari server
                showAlert(data.message, 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menghubungi server. Silakan coba lagi.', 'danger');
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
    
    // Real-time validation saat mengetik confirm password
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value && passwordInput.value) {
            if (this.value !== passwordInput.value) {
                this.setCustomValidity('Password tidak sama');
                this.style.borderColor = '#dc3545';
            } else {
                this.setCustomValidity('');
                this.style.borderColor = '#28a745';
            }
        } else {
            this.setCustomValidity('');
            this.style.borderColor = '';
        }
    });

    // Real-time validation saat mengubah password utama
    passwordInput.addEventListener('input', function() {
        if (confirmPasswordInput.value) {
            if (this.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('Password tidak sama');
                confirmPasswordInput.style.borderColor = '#dc3545';
            } else {
                confirmPasswordInput.setCustomValidity('');
                confirmPasswordInput.style.borderColor = '#28a745';
            }
        }
        
        // Reset border color jika field kosong
        if (!this.value) {
            this.style.borderColor = '';
            confirmPasswordInput.style.borderColor = '';
        }
    });

    // Real-time email validation
    const emailInput = signupForm.querySelector('input[name="email"]');
    emailInput.addEventListener('blur', function() {
        if (this.value) {
            const emailError = validateEmail(this.value);
            if (emailError) {
                this.setCustomValidity(emailError);
                this.style.borderColor = '#dc3545';
            } else {
                this.setCustomValidity('');
                this.style.borderColor = '#28a745';
            }
        } else {
            this.setCustomValidity('');
            this.style.borderColor = '';
        }
    });

    // Real-time name validation
    const nameInput = signupForm.querySelector('input[name="full_name"]');
    nameInput.addEventListener('input', function() {
        if (this.value.trim().length >= 2) {
            this.style.borderColor = '#28a745';
        } else if (this.value.trim().length > 0) {
            this.style.borderColor = '#ffc107';
        } else {
            this.style.borderColor = '';
        }
    });

    // Reset border colors when form is reset
    signupForm.addEventListener('reset', function() {
        const inputs = signupForm.querySelectorAll('input');
        inputs.forEach(input => {
            input.style.borderColor = '';
            input.setCustomValidity('');
        });
    });
});