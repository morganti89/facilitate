<x-layout notRenderLayout="false" title="Criar" css="<?= DIR_CSS.'form.css' ?>">
    <section class="h-100-vh ">
        <form class="user__form" method="post">

            <h2 class="user__main_title">Criar Usuário</h2>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Nome</label>
                <input class="user__input_text" type="text" name="name">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Email</label>
                <input class="user__input_text" type="email" name="email">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Senha</label>
                <input class="user__input_text"type="password" name="password">
            </div>
            <button class="btn user__btn">Enviar</button>
        </form>
    </section>
</x-layout>
