document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('edit-btn');
    const editContainer = document.getElementById('edit-container');
    const editForm = document.getElementById('edit-form');

    // Carregar dados salvos no localStorage
    if (localStorage.getItem('profile-name')) {
        document.getElementById('profile-name').textContent = localStorage.getItem('profile-name');
    }
    if (localStorage.getItem('profile-email')) {
        document.getElementById('profile-email').textContent = localStorage.getItem('profile-email');
    }
    if (localStorage.getItem('profile-phone')) {
        document.getElementById('profile-phone').textContent = localStorage.getItem('profile-phone');
    }
    if (localStorage.getItem('profile-img')) {
        document.querySelector('.profile-img').src = localStorage.getItem('profile-img');
    }

    editBtn.addEventListener('click', function() {
        editContainer.style.display = 'block';
        document.getElementById('name').value = document.getElementById('profile-name').textContent;
        document.getElementById('email').value = document.getElementById('profile-email').textContent;
        document.getElementById('phone').value = document.getElementById('profile-phone').textContent;
    });

    editForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const fileInput = document.getElementById('profile-pic');
        const reader = new FileReader();
        
        reader.onload = function() {
            document.querySelector('.profile-img').src = reader.result;
            localStorage.setItem('profile-img', reader.result);
        };

        if (fileInput.files[0]) {
            reader.readAsDataURL(fileInput.files[0]);
        }

        const name = editForm.name.value;
        const email = editForm.email.value;
        const phone = editForm.phone.value;

        document.getElementById('profile-name').textContent = name;
        document.getElementById('profile-email').textContent = email;
        document.getElementById('profile-phone').textContent = phone;

        // Salvar dados no localStorage
        localStorage.setItem('profile-name', name);
        localStorage.setItem('profile-email', email);
        localStorage.setItem('profile-phone', phone);

        editContainer.style.display = 'none';
    });
});