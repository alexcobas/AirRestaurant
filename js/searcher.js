document.getElementById('searchButton').addEventListener('click', function() {
    const searchInput = document.getElementById('searchInput').value.trim();
    if (searchInput) {
        const baseUrl = 'http://localhost/AirRestaurant/product/index?filterName=';
        window.location.href = baseUrl + encodeURIComponent(searchInput);
    }
});

document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('searchButton').click();
    }
});

