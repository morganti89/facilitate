<x-layout css="<?= DIR_CSS . 'form.css' ?>" title="Módulos">
    <section class="h-100-vh ">
        <div class="tabs">
            <button onclick="openTab('createModule')">Criar módulo</button>
        </div>

        <form class="form" action="<?=  route('module/add') ?>" method="post">
            <h2 class="form__main_title">Criar módulo</h2>
            <div class="form__field">
                <label class="form__label">Nome do módulo</label>
                <input class="form__input_text" type="text" name="name">
            </div>
            <div class="form__field">
                <label class="form__label">Subgrupo</label>
                <input class="form__input_text" type="text" name="subgroup">
            </div>
            <div class="form__field">
                <label class="form__label">Link</label>
                <input class="form__input_text" type="text" name="link">
            </div>
            <button class="form__btn" type="submit">Enviar</button>
        </form>
    </section>
</x-layout>