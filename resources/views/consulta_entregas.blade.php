@extends('/layouts/base_layout')

@section('content')

<div class="container-fluid px-5" style="max-width: 1500px">
   <h3 class="py-3">Lista de Entregas</h3>

   <table class="table">
      <thead class="thead-dark">
         <tr>
            <th scope="col">ID da Entrega</th>
            <th scope="col">Status</th>
            <th scope="col">Data do Pedido</th>
            <th scope="col">Remetente</th>
            <th scope="col">Destinatário</th>
            <th scope="col">Endereço</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($entregas as $entrega)
            <?php 
               $data = new DateTime($entrega["rastreamento"]["date"]);
               $data = $data->format('d/m/Y H:i');
            ?>
            <tr class="cursor-pointer link">
               <th scope="row"> <a href="/entrega/{{$entrega["id"]}}" class="link-cover"></a> {{$entrega["id"]}} </th>
               <td> <a href="/entrega/{{$entrega["id"]}}" class="link-cover"></a> {{$entrega["rastreamento"]["message"]}} </td>
               <td> <a href="/entrega/{{$entrega["id"]}}" class="link-cover"></a> {{$data}} </td>
               <td> <a href="/entrega/{{$entrega["id"]}}" class="link-cover"></a> {{$entrega["remetente_nome"]}} </td>
               <td> <a href="/entrega/{{$entrega["id"]}}" class="link-cover"></a> {{$entrega["cliente"]["cliente_nome"]}} </td>
               <td> <a href="/entrega/{{$entrega["id"]}}" class="link-cover"></a> {{$entrega["cliente"]["cliente_endereco"]}} </td>
            </tr>
         @endforeach
      </tbody>
   </table>
</div>

<?php 
   // print_r($entregas);

   // foreach ($entregas as $entrega) 
   // {
   //    print_r( $entrega["rastreamentos"] );
   // }
   // print_r( $entregas["rastreamentos"] );
?>

@endsection