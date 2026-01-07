<x-layout
    notRenderLayout="false"
    title="Nova conta"
    css="<?= DIR_CSS . 'form.css' ?>"
    js="<?= DIR_JS . 'index.js' ?>">
    <section class="h-100-vh ">

        <div class="tabs">
            <button onclick="openTab('company')">Empresa</button>
            <button onclick="openTab('address')">Endereço</button>
            <button onclick="openTab('user')">Usuário</button>
        </div>

        <form method="post" class="form">
            <!-- GUIA DA EMPRESA -->
            <div id="company" class="tab">
                <h2 class="form__main_title">Dados da Empresa</h2>
                <div class="form__field">
                    <label class="form__label">Nome da Empresa</label>
                    <input class="form__input_text" type="text" name="company_name">
                </div>
                <div class="form__field">
                    <label class="form__label">Razão Social</label>
                    <input class="form__input_text" type="text" name="social_name">
                </div>
                <div class="form__field">
                    <label class="form__label">CNPJ/CPF</label>
                    <input class="form__input_text" type="text" name="cnpj">
                </div>
                <div class="form__field">
                    <label class="form__label">Email</label>
                    <input class="form__input_text" type="email" name="company_email">
                </div>

                
            </div>

            <!-- GUIA DO ENDEREÇO -->
            <div id="address" class="tab" style="display: none;">
                <h2 class="form__main_title">Dados de Endereço</h2>
                <div class="form__field">
                    <label class="form__label">Logradouro</label>
                    <input class="form__input_text" type="text" name="public_place">
                </div>
                <div class="form__field">
                    <label class="form__label">Número</label>
                    <input class="form__input_text" type="text" name="number">
                </div>
                <div class="form__field">
                    <label class="form__label">Bairro</label>
                    <input class="form__input_text" type="text" name="neighborhood">
                </div>
                <div class="form__field">
                    <label class="form__label">Cidade</label>
                    <input class="form__input_text" type="text" name="city">
                </div>
                <div class="form__field">
                    <div class="form__field">
                        <label class="form__label">Estado</label>
                        <select class="form__input_select" name="state">
                            <option value="RS">RS</option>
                            <option value="SC">SC</option>
                            <option value="PR">PR</option>
                        </select>
                    </div>
                </div>
                <div class="form__field">
                    <label class="form__label">País</label>
                    <input class="form__input_text" type="text" name="country">
                </div>
                <div class="form__field">
                    <label class="form__label">CEP</label>
                    <input class="form__input_text" type="text" name="zip_code">
                </div>
            </div>

            <!-- GUIA DO USUÁRIO -->
            <div id="user" class="tab" style="display: none;">
                <h2 class="form__main_title">Dados de Usuário</h2>
                <div class="form__field">
                    <label class="form__label">Nome</label>
                    <input class="form__input_text" type="text" name="name">
                </div>
                <div class="form__field">
                    <label class="form__label">Email</label>
                    <input class="form__input_text" type="text" name="email">
                </div>
                <div class="form__field">
                    <label class="form__label">Senha</label>
                    <input class="form__input_text" type="password" name="password">
                </div>
            </div>
            <button class="form__fake-btn" >Enviar</button>
        </form>
    </section>
</x-layout>
