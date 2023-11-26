@extends('/layouts/base_layout')

@section('content')

<?php 
   function formatCnpjCpf($value)
   {
      $CPF_LENGTH = 11;
      $cnpj_cpf = preg_replace("/\D/", '', $value);
      
      if (strlen($cnpj_cpf) === $CPF_LENGTH) {
         return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
      } 
      
      return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
   }
   // $entrega = json_decode($entrega);
   
   // foreach ($entrega as $key => $item){
   //    print_r($item);
   //    // echo "$key => $item";
   //    echo "<br>";
   // }

   // print_r($entrega);

   $data_do_pedido = new DateTime(end($entrega["rastreamento"])["date"]);
   $data_do_pedido = $data_do_pedido->format('d/m/Y H:i');
?>
<div class="container d-flex flex-column justify-content-center align-items-center">
   <h3 class="py-3">Dados da Entrega</h3>

   <div class="card w-100">
      <div class="card-body">
         <h5 class="card-title"> ID da Entrega: {{$entrega["id"]}} </h5>
         <h6 class="card-subtitle mb-2 text-muted"> Remetente: {{$entrega["remetente_nome"]}} </h6>
         <p class="card-text"> Nº de Volumes: {{$entrega["volumes"]}} </p>
      </div>
      <ul class="list-group list-group-flush">
         <li class="list-group-item"> Data do Pedido: {{$data_do_pedido}} </li>
         <li class="list-group-item">
            <b class="card-text">Rastreamento</b>

            @foreach ($entrega["rastreamento"] as $rastreamento)
               <?php 
                  $data = new DateTime($rastreamento["date"]);
                  $data = $data->format('d/m/Y H:i');
               ?>
               <div>
                  <span>- {{$data}} -</span>
                  <span> {{$rastreamento["message"]}} </span>
               </div>
            @endforeach
         </li>
         <li class="list-group-item">
            <b class="card-text">Transportadora</b>
            <div>
               <span> Nome Fantasia: {{$entrega["transportadora"]["nome_fantasia"]}} </span>
            </div>
            <div>
               {{-- function de formatação de cnpj não funciona porque os dados de cpnj da API tem um dígito a menos que o normal --}}
               <span> CNPJ: {{formatCnpjCpf($entrega["transportadora"]["cnpj"]."0")}} </span>
            </div>
         </li>
         <li class="list-group-item">
            <b class="card-text">Dados do Cliente</b>
            <div> <span> Nome: {{$entrega["cliente"]["cliente_nome"]}} </span> </div>
            <div> <span> CPF: {{formatCnpjCpf($entrega["cliente"]["cliente_cpf"])}} </span> </div>
            <div> <span> CEP: {{$entrega["cliente"]["cliente_cep"]}} </span> </div>
            <div> <span> Endereço: {{$entrega["cliente"]["cliente_endereco"]}} </span> </div>
            <div> <span> Estado: {{$entrega["cliente"]["cliente_estado"]}} </span> </div>
            <div> <span> País: {{$entrega["cliente"]["cliente_pais"]}} </span> </div>
         </li>
      </ul>
   </div>
</div>


@endsection