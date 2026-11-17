(function ($) {
    "use strict";

    var themeMode = localStorage.getItem("theme-mode") || "light";

    function setThemeMode(mode) {
        const body = document.body;
        const newTheme = mode === "dark" ? "dark" : "light";
        body.setAttribute("data-bs-theme", newTheme);
        body.setAttribute("data-topbar", newTheme);
        body.setAttribute("data-sidebar", newTheme);

        localStorage.setItem("theme-mode", mode);
    }

    function toggleLayoutMode() {
        const body = document.body;
        const currentMode = body.getAttribute("data-bs-theme") === "dark" ? "light" : "dark";
        setThemeMode(currentMode);
    }

    $(document).ready(function () {
        // Apply saved theme mode on page load
        setThemeMode(themeMode);

        // Toggle theme mode on button click
        $("#mode-setting-btn").on("click", function () {
            toggleLayoutMode();
        });
    });
    $(window).on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
})(jQuery);
