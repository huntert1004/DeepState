// (Sidebar toggles/Project switching)


// -------------------- Sidebar Functions Start ---------------------------

// This function takes in the button and the corrisponding ul element. To hide and trigger our icon animation on button click.
export function init_sidebar_dropdown(button,ul) {
    var open = false;
    const icon = button.children[0];
    button.addEventListener('click', function () {
        if (open) {
            ul.classList.remove('hide');
            icon.classList.toggle('fa-arrow-right');

        } else {
            icon.classList.toggle('fa-arrow-right-open');
            ul.classList.toggle('hide');
            
        }
        open = !open;
    });
}

// This function takes in the button element, the main page wrapper and the middle menu which is just called menu.
// To not only change the width of the sidebar on click but to also hide some of the elements I dont want to be shown on collapse
export function init_sidebar_collapse(button, wrapper,menu) {
    var open = true;
    const stuff_we_need_to_hide = menu.children;
    button.addEventListener('click', function () {
        if (!open) {
            wrapper.classList.remove('collapsed');
            for (let i = 1; i < stuff_we_need_to_hide.length; i++){
                stuff_we_need_to_hide[i].classList.remove("hide");
            }
        } else {
            wrapper.classList.toggle('collapsed');
            for (let i = 1; i < stuff_we_need_to_hide.length; i++){
                stuff_we_need_to_hide[i].classList.toggle('hide');
            }
            
        }
        
        open = !open;

    });
}

// -------------------- Sidebar Functions End ---------------------------