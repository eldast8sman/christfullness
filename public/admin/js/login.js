var BASE_URL = "https://cfcing.org/";
var ADMIN_URL = BASE_URL + "dashboard/";
if (sessionStorage.getItem('token') == null || sessionStorage.getItem('token') == '') {
    window.location = ADMIN_URL + 'login'
}