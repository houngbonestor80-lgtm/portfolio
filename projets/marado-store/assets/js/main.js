document.addEventListener('DOMContentLoaded', function () {
    var navToggle = document.getElementById('navToggle');
    var mainNav = document.getElementById('mainNav');
    var navOverlay = document.getElementById('navOverlay');

    function closeNav() {
        mainNav.classList.remove('open');
        navOverlay.classList.remove('open');
    }

    if (navToggle && mainNav && navOverlay) {
        navToggle.addEventListener('click', function () {
            mainNav.classList.toggle('open');
            navOverlay.classList.toggle('open');
        });
        navOverlay.addEventListener('click', closeNav);
        mainNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeNav);
        });
    }

    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alertBox) {
        setTimeout(function () {
            alertBox.style.transition = 'opacity .4s ease';
            alertBox.style.opacity = '0';
            setTimeout(function () { alertBox.remove(); }, 400);
        }, 4000);
    });
});
