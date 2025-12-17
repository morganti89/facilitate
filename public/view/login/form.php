<x-layout notRenderLayout="false" title="Login" css="<?= DIR_CSS.'form.css' ?>">
    <section class="h-100-vh ">
        <form class="form" method="post">
            <h2 class="form__main_title">Login</h2>
            <div class="d-flex w-100 g-xxl">
                <label class="form__label">Email</label>
                <input class="form__input_text" type="email" name="user">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="form__label">Senha</label>
                <input class="form__input_text"type="password" name="password">
            </div>
            <a href="<?=  route('company')?>" class="form__link">Criar nova conta</a>
            <button class="form__btn" type="submit">Enviar</button>
        </form>
    </section>
</x-layout>