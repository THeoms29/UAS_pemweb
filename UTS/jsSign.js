    signupForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const fullName = signupForm.querySelector('input[placeholder="Full Name"]').value.trim();
      const email = signupForm.querySelector('input[placeholder="Email"]').value.trim();
      const password = signupForm.querySelectorAll('input[placeholder="Password"]')[0].value;
      const confirmPassword = signupForm.querySelector('input[placeholder="Confirm Password"]').value;
      const termsChecked = signupForm.querySelector('input[type="checkbox"]').checked;
    
    });

