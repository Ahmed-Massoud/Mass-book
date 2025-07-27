
const slider1 = document.querySelector(`.al1`);
let isDown1 = false;
let startX1;
let scrollLeft;

slider1.addEventListener('mousedown', (e) => {
    isDown1 = true;
    slider1.classList.add('active');
    startX1 = e.pageX - slider1.offsetLeft;
    scrollLeft = slider1.scrollLeft;
});

slider1.addEventListener('mouseleave', () => {
    isDown1 = false;
    slider1.classList.remove('active');
});

slider1.addEventListener('mouseup', () => {
    isDown1 = false;
    slider1.classList.remove('active');
});

slider1.addEventListener('mousemove', (e) => {
    if (!isDown1) return; 
    e.preventDefault();
    const x = e.pageX - slider1.offsetLeft;
    const walk = (x - startX1) * 3;
    slider1.scrollLeft = scrollLeft - walk;
});