<x-layout 
   css="<?= DIR_CSS . "dashboard.css" ?>" 
   js="<?= DIR_JS . "dashboard.js" ?>"
   title="Dashboard" >

    <section class="section__dashboard">

         <a class='btn-add' href="<?= route('finance/add') ?>">
            <img src="<?= DIR_IMG.'dashboard/add.svg'?>" />
         </a>

         <?php if(!isset($data)) :?>
            <h1>Não há contas para exibir</h1>
         <?php else :?>
            <table class="tb">
               <tr>
                  <th>Fornecedor</th>
                  <th>Valor</th>
                  <th>Data de Validade</th>
               </tr>
            <?php foreach ($data as $key => $value):?> 
               <tr>
                  <td>
                     <?= $value->getProvider() ?>
                  </td>
                  <td>
                     <a class="list_counts__link"href=""><?= $value->getValue() ?></a>
                  </td>
                  <td>
                     <?= $value->getExpirationDate() ?>
                  </td>
               </tr>
            <?php endforeach ?>
            <table>
         <?php endif ?>
    </section>

</x-layout>
