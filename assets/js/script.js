function adjustMobileView() {
    var myNavbar = document.getElementById('myNavbar');
    var dropdownMenu = document.getElementById('dropdown-menu-theme');
    if (window.innerWidth >= 992) {
        dropdownMenu.classList.add('dropdown-menu-end');
        dropdownMenu.classList.remove('w-100');
        myNavbar.classList.add('rounded-bottom-3');
    } else {
        dropdownMenu.classList.remove('dropdown-menu-end');
        dropdownMenu.classList.add('w-100');
        myNavbar.classList.remove('rounded-bottom-3');
    }
}

adjustMobileView();

window.addEventListener('resize', adjustMobileView);