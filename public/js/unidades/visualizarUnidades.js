$(window).on("load", function(){

  $("button.dropdown-item"). on("click", function(){
    $("#unidad_id").val($(this).attr("data-value")); 
  });
  $("#asignar").on("click", function(e){
    if($("#monto").val() == ""){
      e.preventDefault();
      $("#numeric-m").addClass("d-none");
      $("#required-m").removeClass("d-none");
      setTimeout(function(){$("#required-m").addClass("d-none")},3000);
    }else if(isNaN(parseInt($("#monto").val()))){
      e.preventDefault();
      $("#required-m").addClass("d-none");
      $("#numeric-m").removeClass("d-none");
      setTimeout(function(){$("#numeric-m").addClass("d-none")},3000);
    }
  });

});