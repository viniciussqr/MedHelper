document.getElementById('toggleNewPassword').addEventListener('click', function () {
    var newPasswordInput = document.getElementById('newPassword');
    var icon = this.querySelector('i');
    if (newPasswordInput.type === 'password') {
        newPasswordInput.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        newPasswordInput.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});

document.getElementById('toggleConfirmNewPassword').addEventListener('click', function () {
    var confirmNewPasswordInput = document.getElementById('confirmNewPassword');
    var icon = this.querySelector('i');
    if (confirmNewPasswordInput.type === 'password') {
        confirmNewPasswordInput.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        confirmNewPasswordInput.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});
