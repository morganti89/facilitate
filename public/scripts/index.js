function openTab(tab) {
    let tabs = document.querySelectorAll('.tab');
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].style.display = 'none';
    }
    document.querySelector('#'+tab).style.display = 'block';
    changeClass(tab);
}

function changeClass(tab) {
    var btn = document.querySelector('.form__fake-btn');

    if (btn == null){
        btn = document.querySelector('.form__btn');
    }

    if (tab == 'user') {
        btn.classList.add('form__btn');
        btn.classList.remove('form__fake-btn');
        return;
    }

    btn.classList.remove('form__btn');
    btn.classList.add('form__fake-btn');

}
