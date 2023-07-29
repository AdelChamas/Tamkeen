document.querySelector('.sidebar-toggle').addEventListener('click', function (){
    document.getElementById('sidebar').classList.toggle('visible');
    document.querySelector('main').classList.toggle('wrap');
    document.querySelector('.instructor-main').classList.toggle('wrap');
});
