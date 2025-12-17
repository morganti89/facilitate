<x-layout notRenderLayout="true" title="Facilitate" css="<?= DIR_CSS.'home.css' ?>">
    <section>
        <nav class="
            navbar
            ">
            <a class="logo_link" href="#">
                <img class="logo_img" src="<?= DIR_IMG.'logo.png' ?>"/>
            </a>
            <div>
                <ul class="list-group d-flex">
                    <li class="list-item">
                        <div class="dropdown">
                            <button class="dropbtn">Produtos</button>
                            <div class="dropdown-content">
                                <a href="#">Financeiro</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-item"><a class="txt-color-primary" href="#">Sobre</a></li>
                </ul>
            </div>
            <a class="btn-submit mr-l logout" href="<?= route('login') ?>">Login</a>
        </nav>
    </section>
    <section class="home-content">
        <img class="home__img" src="<?= DIR_IMG . 'home.avif' ?>" />
        <div class="d-flex flex-dir-column g-xxl m-a">
            <h1 class="main_title">Automatizar seu negócio</h1>
            <span class="sec_title">Gerencie sua empresa</span>
            <a class="btn-submit"
                href="<?= route('user') ?>">
                Crie sua conta grátis
            </a>
        </div>
    </section>
    <footer class="footer">
        <p>Desenvolvido por Paulo</p>
    </footer>
</x-layout>
