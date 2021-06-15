$(window).on("load", function(e){

  $("buttom.dropdown-item"). on("click", function(){
    $("#unidad_id").val($(this).attr("data-value")); 
  });
  $("#asignar").on("click", function(){
    if($("#monto").val() == ""){
      e.preventDefault();
      $("#numeric").addClass("d-none");
      $("#required").removeClass("d-none");
      setTimeout(function(){$("#required").addClass("d-none")},3000);
    }else if(isNaN(parseInt($("#monto").val()))){
      e.preventDefault();
      $("#required").addClass("d-none");
      $("#numeric").removeClass("d-none");
      setTimeout(function(){$("#numeric").addClass("d-none")},3000);
    }
  });

});