window.addEventListener('load',() => {

    var img_show = document.getElementsByClassName('show_img');

    var img_close_zoom = document.getElementById("img_close_zoom");

    var zoom_img = function () {

        var zoom_img_product = document.getElementById("zoom_img_product");

        zoom_img_product.classList.remove("zoom_img_hide");
        zoom_img_product.classList.add("zoom_img_show");

        var show_img_zoom = document.createElement("img");
        show_img_zoom.setAttribute("id", "img_zoom");
        var src = img_show[0].getAttribute("src");
        show_img_zoom.setAttribute("src", src);
        show_img_zoom.setAttribute("class", "show_img");

        var div_zoom = document.getElementById("div_zoom");
        div_zoom.appendChild(show_img_zoom);

        var header = document.getElementById("header");
        header.style.display = 'none';


    }

    var dezoom_img = function () {

        var img_zoom = document.getElementById("img_zoom");
        img_zoom.remove();

        var zoom_img_product = document.getElementById("zoom_img_product");

        zoom_img_product.classList.remove("zoom_img_show");
        zoom_img_product.classList.add("zoom_img_hide");

        var header = document.getElementById("header");
        header.style.display = 'flex';

    }


    for (let i = 0; i < img_show.length; i++) {
        img_show[i].addEventListener('click', zoom_img);
    }

    img_close_zoom.addEventListener('click', dezoom_img);

});