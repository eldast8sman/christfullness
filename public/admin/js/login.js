BASE_URL = "http://127.0.0.1:8000/";
ADMIN_URL = BASE_URL + "dashboard/";
if (sessionStorage.getItem('token') == null || sessionStorage.getItem('token') == '') {
    window.location = ADMIN_URL + 'login'
}