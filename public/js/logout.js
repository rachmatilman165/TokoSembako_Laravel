function logout() {
    // Clear session or local storage if any
    localStorage.clear();
    sessionStorage.clear();
    // Redirect to login page
    window.location.href = 'login.html';
}
