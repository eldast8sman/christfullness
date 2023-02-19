var BASE_URL = "https://www.cfcing.org/";
// var BASE_URL = "http://127.0.0.1:8000/";
var ADMIN_URL = BASE_URL + "dashboard/";
if (localStorage.getItem('token') == null || localStorage.getItem('token') == '') {
    window.location = ADMIN_URL + 'login'
}