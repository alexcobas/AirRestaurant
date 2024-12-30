document.getElementById('caducidad').addEventListener('input', function (e) {
    let value = e.target.value.replace(/[^\d]/g, '');
    if (value.length >= 2) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4); 
    }
    e.target.value = value;
});