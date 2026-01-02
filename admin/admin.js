// Простий admin helper
const AdminAPI = {
    apiBase: '/api',

    async fetchJson(path, opts = {}) {
        const token = localStorage.getItem('token');
        opts.headers = opts.headers || {};
        opts.headers['Content-Type'] = 'application/json';
        if (token) opts.headers['Authorization'] = 'Bearer ' + token;
        const res = await fetch(this.apiBase + path, opts);
        if (res.status === 401) {
            alert('Не авторизовано');
            window.location.href = '/frontend/login.html';
            throw 'unauth';
        }
        return res.json();
    }
};
