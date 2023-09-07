window.addEventListener('load',() => {

    const  NOMBRE_CLIC_DIAPO = 2;

    var fleche_gauche = document.getElementsByClassName("fleche_gauche");
    var fleche_droite = document.getElementsByClassName("fleche_droite");

    //var products = this.parentNode.getElementsByClassName("content_diapo");

    var content_diapo = document.getElementsByClassName("content_diapo");

    for (let i = 0; i < content_diapo.length; i++) {

        var products = content_diapo[i].children;
        console.log(products.length);
        content_diapo[i].style.gap = "20px";
        var x_content_diapo = content_diapo[i].getBoundingClientRect().x;
        //console.log(x_content_diapo);
        for (let j = 0; j < products.length; j++) {
            var x = x_content_diapo + j * products[j].children[0].getBoundingClientRect().width;
            //console.log(x);
            //console.log(products[j].children[0].getBoundingClientRect().width);
            /*products[j].style.left = x.toString() + 'px';*/
            products[j].style.left = '0px';
            /*products[j].style.right = '0px';*/
        }

        var width_content_diapo = content_diapo[i].getBoundingClientRect().width;
        var gap_content_diapo = parseInt(content_diapo[i].style.gap.replace('px', ''));
        var len_px_diapo = content_diapo[i].getElementsByClassName("a_content_diapo")[0].getBoundingClientRect().width * products.length + (gap_content_diapo * products.length)

        console.log(len_px_diapo);
        console.log(width_content_diapo);
        console.log(len_px_diapo - width_content_diapo);

        if (len_px_diapo - width_content_diapo < 0) {
            console.log("OK");
            content_diapo[i].style.justifyContent = 'space-evenly';
        }

    }

    var move_diapo_left = function () {

        var products = this.parentNode.getElementsByClassName("content_diapo")[0].children;
        var gap_content_diapo = parseInt(document.getElementsByClassName('content_diapo')[0].style.gap.replace('px', ''));
        var width_content_diapo = parseInt(document.getElementsByClassName('content_diapo')[0].getBoundingClientRect().width);
        //console.log(width_content_diapo);
        //console.log(gap_content_diapo);

        indice_clic = parseInt(this.parentNode.getElementsByClassName("indice_clic")[0].innerHTML);

        var len_px_diapo = products[0].getBoundingClientRect().width * products.length + (gap_content_diapo * products.length)
        //console.log(len_px_diapo);

        console.log(len_px_diapo - width_content_diapo);
        if (len_px_diapo - width_content_diapo < 0) {
            return;
        }

        var decal = (len_px_diapo - width_content_diapo)  / NOMBRE_CLIC_DIAPO;
        //console.log(decal);
        //console.log(-len_px_diapo);

        indice_clic--;
        this.parentNode.getElementsByClassName("indice_clic")[0].innerHTML = indice_clic.toString();

        if (indice_clic < 0) {
            indice_clic = 0;
            this.parentNode.getElementsByClassName("indice_clic")[0].innerHTML = indice_clic.toString();
            return;
        }


        for (let i = 0; i < products.length; i++) {

            var posX = parseInt(products[i].style.left.replace("px", ""));

            //posX = posX - products[i].getBoundingClientRect().width - gap_content_diapo;
            posX = posX + decal;
            //console.log(posX);
            /*products[i].style.left = posX.toString() + 'px';*/
            products[i].style.left = posX.toString() + 'px';
        }

    }

    var move_diapo_right = function () {

        var products = this.parentNode.getElementsByClassName("content_diapo")[0].children;
        var gap_content_diapo = parseInt(document.getElementsByClassName('content_diapo')[0].style.gap.replace('px', ''));
        var width_content_diapo = parseInt(document.getElementsByClassName('content_diapo')[0].getBoundingClientRect().width);
        //console.log(width_content_diapo);
        //console.log(gap_content_diapo);

        //var indice_clic = this.ge
        indice_clic = parseInt(this.parentNode.getElementsByClassName("indice_clic")[0].innerHTML);
        console.log(indice_clic);

        var len_px_diapo = products[0].getBoundingClientRect().width * products.length + (gap_content_diapo * products.length)
        //console.log(len_px_diapo);

        console.log(len_px_diapo - width_content_diapo);
        if (len_px_diapo - width_content_diapo < 0) {

            return;
        }

        var decal = (len_px_diapo - width_content_diapo)  / NOMBRE_CLIC_DIAPO;
        //console.log(decal);
        //console.log(-len_px_diapo);

        indice_clic++;
        console.log(indice_clic);

        this.parentNode.getElementsByClassName("indice_clic")[0].innerHTML = indice_clic.toString();

        if (indice_clic > NOMBRE_CLIC_DIAPO) {
            indice_clic = NOMBRE_CLIC_DIAPO;
            this.parentNode.getElementsByClassName("indice_clic")[0].innerHTML = indice_clic.toString();
            return;
        }

        for (let i = 0; i < products.length; i++) {

            var posX = parseInt(products[i].style.left.replace("px", ""));


            //posX = posX - products[i].getBoundingClientRect().width - gap_content_diapo;
            posX = posX - decal;
            //console.log(posX);
            /*products[i].style.left = posX.toString() + 'px';*/
            products[i].style.left = posX.toString() + 'px';
        }


    }

    for (let i = 0; i < fleche_gauche.length; i++) {
        fleche_gauche[i].addEventListener('click', move_diapo_left);
    }

    for (let i = 0; i < fleche_droite.length; i++) {
        fleche_droite[i].addEventListener('click', move_diapo_right);
    }



});