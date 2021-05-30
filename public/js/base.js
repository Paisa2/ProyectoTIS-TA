$(window).on("load", function(){
  $("#close-sidebar").off("click");
  $("#close-sidebar").on("click", function(){
    $("#aside").removeClass("c-sidebar-show");
    $(".c-sidebar-backdrop.c-fade.c-show").addClass("d-none");
  });
});