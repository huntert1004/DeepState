// (Sidebar toggles/Project switching)

export function sidebar_collapse(wrapper){
    wrapper.style.width = "15%";
}
export function sidebar_enlarge(wrapper){
    wrapper.style.width = "unset";
}
export function init_sidebar_dropdown(button){
    var open = false;
    const icon = button.children[0];
    console.log(icon);
    button.addEventListener('click', function(){
    if(open){
      element.classList.remove("fa-arrow-right-open");
      icon.classList.toggle('fa-arrow-right');
    } else{
      icon.classList.toggle('fa-arrow-right-open');
      element.classList.remove("fa-arrow-right"); 
    }
    open = !open;
  });
}