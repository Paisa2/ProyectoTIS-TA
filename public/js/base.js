$(window).on("load", function(){
  $("#close-sidebar").off("click");
  $("#close-sidebar").on("click", function(){
    $("#aside").removeClass("c-sidebar-show");
    $(".c-sidebar-backdrop.c-fade.c-show").addClass("d-none");
  });

  $("form button[type='submit']:not(.dropdown-item)").on("click", function(){
    $(this).addClass("disabled");
    $(this).off("click");
    $(this).on("click", function(e){
      e.preventDefault();
    });
  });
});