$(window).on("load", function(e){

  $("button.dropdown-item"). on("click", function(){
    $("#cotizacion_id").val($(this).attr("data-value")); 
  });
  $("#with-business").on("click", function(){
    if ($('#with-business > input').is(':checked')){ 
      // con razon social on
      $("#business").removeClass("d-none");
      $("#razon_social").prop("disabled", false);
      $("#required-rs").addClass("d-none");
    }else{ 
      // con razon social off
      $("#business").addClass("d-none");
      $("#razon_social").prop("disabled", true);
      $("#required-rs").addClass("d-none");
    }
  });
  $("#generar-cot-pdf").on("click", function(e){
    if ($('#with-business > input').is(':checked')){ 
      // con razon social on
      if($("#razon_social").val() == ""){
        e.preventDefault();
        $("#required-rs").removeClass("d-none");
        setTimeout(function(){$("#required-rs").addClass("d-none")},3000);
      }
    }else {
      $("#required-rs").addClass("d-none");
    }
  });

});