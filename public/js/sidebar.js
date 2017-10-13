var sidebar_open = document.getElementById("nav-open");

sidebar_open.addEventListener('click', function(event){
    var _sidebar = document.getElementById("sidebar-main");
    console.log("fom");
    _sidebar.classList.add("sb-active");
});

sidebar_close = document.getElementById("nav-close");
sidebar_close.addEventListener('click', function(event){
    var _sidebar = document.getElementById("sidebar-main");
    console.log("nao-fom");
    _sidebar.classList.remove("sb-active");
});

// function sidebar_toggle() {
//     var _sidebar = document.getElementById("sidebar-main");
//     _sidebar.classList.toggle('sb-active');
// }