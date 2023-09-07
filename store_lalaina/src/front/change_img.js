window.addEventListener('load',() => {

    var indice_img = 0;

    var imgs = document.getElementsByClassName("all_img");
    var img_show = document.getElementsByClassName("show_img");
    //console.log(img_show.getAttribute('src'));
    console.log(imgs);

    var fleche_gauche = document.getElementsByClassName("fleche_gauche");
    console.log(fleche_gauche);
    var fleche_droite = document.getElementsByClassName("fleche_droite");

    var change_src = function () {
        var src = this.getAttribute('src');
        for (let i = 0; i < img_show.length; i++) {
            img_show[i].setAttribute('src', src);
        }
    };

    var diapo_left = function () {

        indice_img--;
        if (indice_img < 0) {
            indice_img = imgs.length-1;
        }
        var src = imgs[indice_img].getAttribute('src');
        console.log(src);
        for (let i = 0; i < img_show.length; i++) {
            img_show[i].setAttribute('src', src);
        }

    }

    var diapo_right = function () {

        indice_img++;
        if (indice_img > imgs.length-1) {
            indice_img = 0;
        }
        var src = imgs[indice_img].getAttribute('src');
        console.log(src);
        for (let i = 0; i < img_show.length; i++) {
            img_show[i].setAttribute('src', src);
        }

    }

    for (var i = 0; i < imgs.length; i++) {
        imgs[i].addEventListener('click', change_src);
    }

    for (let i = 0; i < fleche_gauche.length; i++) {
        console.log(i);
        fleche_gauche[i].addEventListener('click', diapo_left);
    }

    for (let i = 0; i < fleche_droite.length; i++) {
        fleche_droite[i].addEventListener('click', diapo_right);
    }

});


