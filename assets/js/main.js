// (The entry point that initializes everything)
import { init_sidebar_collapse, init_sidebar_dropdown } from './modules/navigation.js';

document.addEventListener('DOMContentLoaded', () => {
    const project_button = document.getElementById("projects");
    const chat_button = document.getElementById("chats");
    const ul = document.getElementsByTagName("ul");
    
    init_sidebar_dropdown(project_button, ul[1]);
    init_sidebar_dropdown(chat_button, ul[2]);


    const collapse_button = document.getElementsByClassName("bars")[0];
    const wrapper = document.getElementsByClassName("wrapper")[0];
    const menu = document.getElementsByClassName("menu")[0];
    init_sidebar_collapse(collapse_button, wrapper, menu);




});