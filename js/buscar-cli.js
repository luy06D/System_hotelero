function buscarCliente(){
  $.ajax({
      url: '../controller/reservacion.controller.php',
      type:'GET',
      dataType: 'JSON',
      data: {
          'operacion' : 'clientesBuscar',
          'id'        : $("#tabDni").val()
      },
      success: function (result){
          if(result){                   
          $("#idcliente").val(result.idpersona);
          $("#nombres").val(result.clientes);      
          }
      }
  });
  


}

 // Función Keypress para el buscador
 $("#tabDni").keypress(function(event){
  if(event.keyCode == 13){
      buscarCliente();
  }
});