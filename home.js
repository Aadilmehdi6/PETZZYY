document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const sideMenu = document.getElementById('sideMenu');
    const mainContainer = document.getElementById('mainContainer');
    const bannerWrapper = document.getElementById('bannerWrapper');
    const searchToggle = document.getElementById('searchToggle');
    const searchContainer = document.getElementById('searchContainer');
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    const pages = [
        { name: 'Adopt pet', url: '../adopt.html', keywords: ['adopt', 'adoption', 'pets'] },
        { name: 'Donate pet', url: '../donate.html', keywords: ['donate', 'donation', 'pet'] },
        { name: 'Pet items', url: '../purchase.html', keywords: ['items', 'purchase', 'food', 'pet food'] },
        { name: 'Dog food', url: '../Items/pag2.html', keywords: ['dog', 'dog food'] },
        { name: 'Cat food', url: '../Items/pag2.html#cat', keywords: ['cat', 'cat food'] },
        { name: 'Pet purchase', url: '../adopt.html', keywords: ['purchase', 'buy', 'pet'] }
    ];

    // Toggle side menu
    menuToggle.addEventListener('click', () => {
        sideMenu.classList.toggle('active');
        if (sideMenu.classList.contains('active')) {
            mainContainer.style.transform = 'translateX(250px)';
            bannerWrapper.style.transform = 'translateX(250px)';
        } else {
            mainContainer.style.transform = 'translateX(0)';
            bannerWrapper.style.transform = 'translateX(0)';
        }
    });

    // Function to close the side menu
    function closeMenu() {
        sideMenu.classList.remove('active');
        mainContainer.style.transform = 'translateX(0)';
        bannerWrapper.style.transform = 'translateX(0)';
    }

    // Close the side menu when clicking outside of it
    document.addEventListener('click', (event) => {
        if (!sideMenu.contains(event.target) && !menuToggle.contains(event.target)) {
            closeMenu();
        }
    });

    // Slider functionality
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide(index) {
        const offset = -index * 100; // Calculate the offset
        slides.forEach((slide) => {
            slide.style.transform = `translateX(${offset}%)`;
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    }

    setInterval(nextSlide, 5000); // Change slide every 5 seconds

    showSlide(currentIndex);

    // Search functionality
    searchToggle.addEventListener('click', (event) => {
        event.stopPropagation();
        searchContainer.style.display = searchContainer.style.display === 'block' ? 'none' : 'block';
        searchInput.focus();
    });

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        searchResults.innerHTML = '';
        if (query) {
            const filteredPages = pages.filter(page =>
                page.name.toLowerCase().includes(query) ||
                page.keywords.some(keyword => keyword.includes(query))
            );

            if (filteredPages.length > 0) {
                filteredPages.forEach(page => {
                    const resultItem = document.createElement('a');
                    resultItem.href = page.url;
                    resultItem.textContent = page.name;
                    resultItem.addEventListener('click', () => {
                        window.location.href = page.url;
                    });
                    searchResults.appendChild(resultItem);
                });
            } else {
                searchResults.innerHTML = '<p>The link was not thair</p>';
            }
        }
    });

    document.addEventListener('click', (event) => {
        if (!searchContainer.contains(event.target) && event.target !== searchToggle) {
            searchContainer.style.display = 'none';
        }
    });
});
