document.querySelectorAll('.onlyNumbers').forEach(function(input) {
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9/]/g, ''); // Elimina cualquier carácter que no sea un número
    });
});