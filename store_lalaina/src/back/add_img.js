window.addEventListener('load',() => {

    var number_of_input_type_file = 1;

    var add_input_file = function () {

        var new_input_file = document.createElement("input");
        number_of_input_type_file++;
        new_input_file.setAttribute("id", "input_img" + number_of_input_type_file.toString());
        new_input_file.setAttribute("name", "input_img" + number_of_input_type_file.toString());
        new_input_file.setAttribute("accept", ".jpg, .jpeg, .png");
        new_input_file.setAttribute("type", 'file');


        var button_add_img = document.getElementById("button_add_img");
        button_add_img.before(new_input_file);

    }

    var button_add_img = document.getElementById("button_add_img");

    button_add_img.addEventListener('click', add_input_file);

});
