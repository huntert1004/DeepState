// (The entry point that initializes everything)
import { sidebar_collapse, sidebar_enlarge, init_sidebar_dropdown } from './modules/navigation.js';

document.addEventListener('DOMContentLoaded', () => {
    const project_button = document.getElementById("projects");
    const chat_button = document.getElementById("chats");
    init_sidebar_dropdown(project_button);
    init_sidebar_dropdown(chat_button);
    



});