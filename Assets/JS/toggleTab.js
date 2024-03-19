function toggleTab(tabId) {
    var tabs = document.querySelectorAll('.content');
    tabs.forEach(function(tab) {
        tab.style.display = 'none';
    });
    document.getElementById(tabId).style.display = 'block';
    // Remove 'active' class from all navigation links
    var navLinks = document.querySelectorAll('.navbar .nav-link');
    navLinks.forEach(function(link) {
        link.classList.remove('active');
    });
    // Add 'active' class to the clicked navigation link
    event.target.classList.add('active');
}
