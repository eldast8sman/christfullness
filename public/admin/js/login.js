var BASE_URL = "https://www.cfcing.org/";
// var BASE_URL = "http://127.0.0.1:8000/";
var ADMIN_URL = BASE_URL + "dashboard/";
if (sessionStorage.getItem('token') == null || sessionStorage.getItem('token') == '') {
    window.location = ADMIN_URL + 'login'
}