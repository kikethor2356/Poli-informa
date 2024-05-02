const menu = document.getElementById("navegacion");
const stickyOffset = menu.offsetTop;
const elements = document.querySelectorAll('.navegacion__enlace');

window.addEventListener("scroll", () => {
    if (window.pageYOffset > stickyOffset) {
        for(const element of elements){
            element.classList.add("enlace");
        }
        menu.classList.add("sticky");
    } else {
        for(const element of elements){
            element.classList.remove("enlace");
        }
        menu.classList.remove("sticky");
    }
});

function smoothScroll(event) {
    event.preventDefault();
    const targetId = event.currentTarget.getAttribute('href').substring(1);
    const targetSection = document.getElementById(targetId);
    targetSection.scrollIntoView({ behavior: 'smooth' });
}

document.querySelectorAll('.navegacion__enlace').forEach(link => {
    link.addEventListener('click', smoothScroll);
});
document.querySelectorAll('.cabecera__enlace').forEach(link => {
    link.addEventListener('click', smoothScroll);
});