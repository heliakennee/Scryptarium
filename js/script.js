function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Animation douce
    });
}   

// Afficher ou masquer le bouton lorsque l'utilisateur fait défiler la page
window.onscroll = function() {
    const btn = document.getElementById("scrollToTopBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        btn.style.display = "block"; // Afficher le bouton
    } else {
        btn.style.display = "none"; // Masquer le bouton
    }
};

function showError() {
    alert("Cette page n'est pas encore disponible");
}

document.addEventListener("DOMContentLoaded", function () {
    // Vérifier s'il y a une position de scroll enregistrée
    if (sessionStorage.getItem("scrollPosition")) {
        window.scrollTo(0, sessionStorage.getItem("scrollPosition"));
        sessionStorage.removeItem("scrollPosition"); // Supprimer après usage
    }

    // Sélectionner tous les formulaires
    document.querySelectorAll("form").forEach(function (form) {
        form.addEventListener("submit", function () {
            // Sauvegarder la position actuelle
            sessionStorage.setItem("scrollPosition", window.scrollY);
        });
    });
});
