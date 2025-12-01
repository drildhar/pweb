document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const messageBox = document.getElementById('messageBox');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Reset message box
        messageBox.style.display = 'none';
        messageBox.className = 'message-box';
        messageBox.textContent = '';

        // Get form data
        const formData = new FormData(form);
        const name = formData.get('name').trim();
        const email = formData.get('email').trim();
        const message = formData.get('message').trim();

        // Client-side validation
        if (!name) {
            showMessage('Please enter your name.', 'error');
            return;
        }

        if (!email) {
            showMessage('Please enter your email.', 'error');
            return;
        }

        if (!isValidEmail(email)) {
            showMessage('Please enter a valid email address.', 'error');
            return;
        }

        if (!message) {
            showMessage('Please enter your message.', 'error');
            return;
        }

        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.textContent = 'Sending...';
        showMessage('Sending message...', 'info');

        try {
            const response = await fetch('ajax.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.status === 'success') {
                showMessage(result.message, 'success');
                form.reset();
            } else {
                showMessage(result.message || 'An error occurred.', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showMessage('Network error. Please try again later.', 'error');
        } finally {
            // Re-enable button
            submitButton.disabled = false;
            submitButton.textContent = 'Submit';
        }
    });

    function showMessage(text, type) {
        messageBox.textContent = text;
        messageBox.className = `message-box ${type}`;
        messageBox.style.display = 'block';
    }

    function isValidEmail(email) {
        const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
});