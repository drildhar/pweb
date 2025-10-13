document.addEventListener('DOMContentLoaded', () => {
    // FAQ Toggle
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Form Submission
    const form = document.getElementById('lead-form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const nama = document.getElementById('nama').value;
        const telepon = document.getElementById('telepon').value;
        const pesan = document.getElementById('pesan').value;
        alert(`Terima kasih, ${nama}! Kami akan segera menghubungi Anda di nomor ${telepon}.`);
        form.reset();
    });
});