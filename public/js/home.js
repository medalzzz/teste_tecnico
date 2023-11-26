$("#cpf").on("input", function() {
   $(this).val( BrazilianValues.formatToCPF($(this).val()) );
})