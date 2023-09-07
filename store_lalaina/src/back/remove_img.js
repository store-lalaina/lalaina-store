window.addEventListener('load',() => {

    var number_of_input_type_file = 1;

    var button_remove_imgs = document.getElementsByClassName("button_remove_img");

    var remove_img = function () {

        console.log(this.parentNode.parentNode);

        var div_img_product = this.parentNode.parentNode;

        div_img_product.remove();

    }

    var add_input_file = function () {
        var new_input_file = document.createElement("input");
        number_of_input_type_file++;
        new_input_file.setAttribute("id", "input_img" + number_of_input_type_file.toString());
        new_input_file.setAttribute("name", "input_img" + number_of_input_type_file.toString());
        new_input_file.setAttribute("accept", ".jpg, .jpeg, .png");
        new_input_file.setAttribute("type", 'file');
        var button_add_img = document.getElementById("button_add_img");
        button_add_img.after(new_input_file);
    }

    for (let i = 0; i < button_remove_imgs.length; i++) {
        button_remove_imgs[i].addEventListener('click', remove_img);
    }

    var button_add_img = document.getElementById("button_add_img");
    button_add_img.addEventListener('click', add_input_file);

});