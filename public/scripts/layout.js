window.onload = (event) => {
    const xlayout = document.querySelector('x-layout');
    const layout = document.querySelector('.layout');

    if (xlayout === null || xlayout.attributes.notRenderLayout) {
        layout.remove();
        layout.style.display = "none";
    }

    if (xlayout.attributes.css != undefined && xlayout.attributes.css !== '') {
        addCSSFile(xlayout);
    }

    if (xlayout.attributes.js != undefined && xlayout.attributes.js !== '') {
        const script = document.createElement('script');
        script.src = xlayout.attributes.js.value;
        document.body.appendChild(script);
    }

    if (xlayout.attributes.title != undefined && xlayout.attributes.title.value !== '') {
        const title = xlayout.attributes.title.value;
        document.title = title;
    }
    layout.style.display = "flex";
    const mainHeader = document.querySelector('.main_header');
}

function addCSSFile(xlayout) {

    let css = xlayout.attributes.css.value;

    if(!css.includes(',')){
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = css.trim();
        link.type = "text/css";
        document.head.appendChild(link);
        return;
    } 
    
    var split = css.split(',');
    split.forEach(element => {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = element.trim();
        link.type = "text/css";
        document.head.appendChild(link);
    });
}