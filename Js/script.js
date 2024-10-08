document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('fade-in');
});

const loginForm = document.getElementById('login-form');
const signupForm = document.getElementById('signup-form');
const switchToSignup = document.getElementById('switch-to-signup');
const switchToLogin = document.getElementById('switch-to-login');

switchToSignup.addEventListener('click', (e) => {
    e.preventDefault();
    signupForm.classList.remove('d-none');
    loginForm.classList.add('d-none');
    document.getElementById('form-title').innerText = "สมัครสมาชิก";
});

switchToLogin.addEventListener('click', (e) => {
    e.preventDefault();
    signupForm.classList.add('d-none');
    loginForm.classList.remove('d-none');
    document.getElementById('form-title').innerText = "เข้าสู่ระบบ";
});

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    Swal.fire({
        title: 'เข้าสู่ระบบสำเร็จ!',
        text: 'คุณได้เข้าสู่ระบบแล้ว',
        icon: 'success',
        confirmButtonText: 'ตกลง'
    });
});

signupForm.addEventListener('submit', (e) => {
    e.preventDefault();
    Swal.fire({
        title: 'สมัครสมาชิกสำเร็จ!',
        text: 'คุณได้สมัครสมาชิกแล้ว',
        icon: 'success',
        confirmButtonText: 'ตกลง'
    });
});