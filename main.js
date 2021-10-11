document.addEventListener('DOMContentLoaded', function () {

    var header = document.getElementById("header-container");
    var logo = document.getElementById("logo");

    // Navigation links that contain dropdown menus
    var listMenus = [document.getElementById("services-list-drop"), document.getElementById("brands-list-drop")];

    // Dropdown menus
    var listMenuContainers = [document.getElementById("services-list-container"), document.getElementById("brands-list-container"), document.getElementById("edit-profile")];

    var sticky = header.offsetTop + 80;

    // Function turns regular nav menu into the sticky one on scroll trigger
    const addSticky = function () {
        if (window.scrollY >= sticky && window.outerWidth >= 800) {
            header.style.height = "60px";
            header.classList.add("header-bg");
            // Removing logo in navbar on specific width
            if (window.outerWidth <= 1105) {
                logo.style.display = "none";
            }
            // Padding is set to fit the header height
            listMenus.forEach(menu => {
                menu.style.padding = "20px 10px";
            });
            listMenuContainers.forEach(container => {
                container.style.top = "60px";
            });
        } else {
            logo.style.display = "initial";
            header.classList.remove("header-bg");
            header.style.height = "80px";
            // Padding is set to fit the header height
            listMenus.forEach(menu => {
                menu.style.padding = "30px 10px";
            });
            if (window.outerWidth <= 1105) {
                listMenuContainers.forEach(container => {
                    container.style.top = "130px";
                });
            } else {
                listMenuContainers.forEach(container => {
                    container.style.top = "80px";
                });
            }
        }
    };

    window.addEventListener("scroll", addSticky);
});
