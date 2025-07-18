function showSection(sectionId) {
    document.querySelectorAll('.categories').forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');
}
