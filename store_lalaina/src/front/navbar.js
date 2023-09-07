window.addEventListener('load',() => {

    var header = document.getElementById("header");

    if (window.scrollY !== 0) {
        //header.classList.add("sticky");
        header.style.height = '60px';
        header.style.position = 'sticky';
        header.style.top = "Opx";
        console.log("Ok");
        header.style.left = "Opx";
    } else {
        //header.classList.remove("sticky");
        header.style.height = '100px';
        header.style.position = 'relative';
    }

    var a_sidebar = document.getElementById("a_sidebar");
    var img_close = document.getElementById("img_close");

    var sidebar_show = function () {

        var nav_sidebar = document.getElementById("navbar");
        var class_sidebar = nav_sidebar.classList;
        console.log(class_sidebar[0]);

        nav_sidebar.classList.remove("navbar_hide");
        nav_sidebar.classList.add("navbar_show");

        /*
        if (class_sidebar == "navbar_hamburger_hide") {
            nav_sidebar.classList.remove("navbar_hamburger_hide");
            nav_sidebar.classList.add("navbar_hamburger_show");
        } else if (class_sidebar == "navbar_hamburger_show") {
            nav_sidebar.classList.remove("navbar_hamburger_show");
            nav_sidebar.classList.add("navbar_hamburger_hide");
        }*/

    }

    var sidebar_hide = function () {

        var nav_sidebar = document.getElementById("navbar");
        var class_sidebar = nav_sidebar.classList;
        console.log(class_sidebar[0]);

        nav_sidebar.classList.remove("navbar_show");
        nav_sidebar.classList.add("navbar_hide");

        /*
        if (class_sidebar == "navbar_hamburger_hide") {
            nav_sidebar.classList.remove("navbar_hamburger_hide");
            nav_sidebar.classList.add("navbar_hamburger_show");
        } else if (class_sidebar == "navbar_hamburger_show") {
            nav_sidebar.classList.remove("navbar_hamburger_show");
            nav_sidebar.classList.add("navbar_hamburger_hide");
        }*/

    }

    a_sidebar.addEventListener('click', sidebar_show);
    img_close.addEventListener('click', sidebar_hide);


    /*window.onscroll = function() {

        // Get the header
        var header_ = document.getElementsByTagName("header")[0];
        console.log(header_);
        console.log(header_.offsetHeight);

        // Get the offset position of the navbar
        var sticky = header_.offsetTop;
        //console.log(header.offsetTop);
        //console.log(header.style.backgroundColor);
        //console.log(window.scrollY);


        if (window.scrollY !== 0 && header.offsetHeight !== 70) {
            //header.classList.add("sticky");
            header.style.height = '70px';
            header.style.position = 'sticky';
            header.style.top = "Opx";
            console.log("Ok");
            header.style.left = "Opx";
        } else {
            //header.classList.remove("sticky");
            header.style.height = '100px';
            header.style.position = 'relative';
        }



    };*/

    var header_change = function () {

        var header = document.getElementById("header");
        console.log(header);
        console.log(header.style.height);

        if (window.scrollY !== 0) {
            //header.classList.add("sticky");
            header.style.height = '60px';
            header.style.position = 'sticky';
            header.style.top = "Opx";
            console.log("Ok");
            header.style.left = "Opx";
        } else {
            //header.classList.remove("sticky");
            header.style.height = '100px';
            header.style.position = 'relative';
        }

    }

    window.addEventListener('scroll', header_change);

});