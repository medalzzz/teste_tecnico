@extends('/layouts/base_layout')

@section('content')

<div class="container d-flex flex-column">
   <h3 class="py-3 text-center">Consulta de Entregas</h3>

   <form id="busca_por_cpf" action="/entregas" class="d-flex justify-content-center align-items-center" style="gap: 10px">
      <label class="m-0" for="cpf">Busca por CPF</label>
      <input type="text" name="cpf" id="cpf" maxlength="14">

      <button class="btn btn-primary btn-sm" type="submit">BUSCAR</button>
   </form>
</div>

<script src="{{asset('js/home.js')}}" defer></script>

@endsection