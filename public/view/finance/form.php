<x-layout title="Adicionar Conta Pagar/Receber" css="<?= DIR_CSS.'form.css' ?>">
    <section class="h-100-vh ">
        <form class="user__form" method="post">

            <h2 class="user__main_title">Conta a pagar</h2>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Data Vencimento</label>
                <input class="user__input_text" type="date" name="expiration_date">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Fornecedor</label>
                <input class="user__input_text" type="text" name="provider">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">N. do Documento</label>
                <input class="user__input_text" type="text" name="n_document">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Tipo</label>
                <select class="user__input_select">
                    <option value="boleto">Boleto</option>
                    <option value="duplicata">Duplicata</option>
                    <option value="invoice">Nota Fiscal</option>
                </select>

                
            </div>

            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Data Pagamento</label>
                <input class="user__input_text"type="date" name="expiration_date">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Valor</label>
                <input class="user__input_text"type="text" name="value">
            </div>
            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Status</label>
                <select class="user__input_select">
                    <option>No prazo</option>
                    <option>Finalizado</option>
                    <option>Atrasado</option>
                </select>
            </div>


            <div class="d-flex w-100 g-xxl">
                <label class="user__label">Observação</label>
                <input class="user__input_text"type="text" name="obs">
            </div>
            <button class="btn user__btn" type="submit">Enviar</button>
        </form>
    </section>
</x-layout>
