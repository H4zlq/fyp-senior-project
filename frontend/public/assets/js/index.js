const btnLogin = $('.btn-login');
const btnSignup = $('.btn-signup');
const btnSubscribe = $('.btn-subscribe');
const LOGIN_URL = './login';
const SIGNUP_URL = './signup';
const SUBSCRIBE_URL = './checkout';
const GET_STARTED_URL = './signup';

function handleLogin() {
  window.location.href = LOGIN_URL;
}

function handleSignup() {
  window.location.href = SIGNUP_URL;
}

function handleSubscribe(productName, productPrice) {
  localStorage.setItem('product_name', productName);
  localStorage.setItem('product_price', productPrice);

  window.location.href = `${SUBSCRIBE_URL}/${productName}/${productPrice}`;
}

function handleGetStarted(path) {
  window.location.href = path;
}

function toggleMenu() {
  const navLinks = document.querySelector('.nav-links');
  navLinks.classList.toggle('nav-active');
}



