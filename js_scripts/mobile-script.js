// MOBILE SIDE NAV
    function openSideNav() {
        document.getElementById("mobile-sidenav").style.width = "250px";
    }

    function closeSideNav() {
        document.getElementById("mobile-sidenav").style.width = "0";
    }

    // MOBILE USER PANEL AND CART
    function toggleUserPanel() {
        document.getElementById("userPanelDropdown").classList.toggle("show");
    }

    function toggleCart() {
        document.getElementById("cartDropdown").classList.toggle("show");
    }

    window.onclick = function (event) {
        var dropdown;
        if (!event.target.matches("#user-panel-dropdown .dropdown-btn")) {
            dropdown = document.getElementById("userPanelDropdown");
            if (dropdown.classList.contains("show"))
                dropdown.classList.remove("show");
        }
        if (!event.target.matches("#cart-dropdown .dropdown-btn")) {
            dropdown = document.getElementById("cartDropdown");
            if (dropdown.classList.contains("show"))
                dropdown.classList.remove("show");
        }
    }