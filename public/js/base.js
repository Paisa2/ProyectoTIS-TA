let interval;
let counter = 0;
let attrs = ["M8 17H10V24H22V17H24V26H8V17Z", "M10 26V17H8V28H24V17H22V26H10Z", "M8 18H10V28.1538H22V18H24V30H8V18Z"];
function hideVerticalNavbar(){
  $('#sidebar').removeClass('c-sidebar-lg-show');
  // $('#c-wrapper').addClass('m-0');
  $('#c-header').removeClass('c-header-fixed');
  $('#c-header > button.c-header-toggler').addClass('d-none');
  $('#c-subheader').addClass('d-none');
  $('#navbar').removeClass('d-none');
  $('#c-header > a.navbar-brand').removeClass('d-none');
}
function showVertivalNavbar(){
  $('#sidebar').addClass('c-sidebar-lg-show');
  // $('#c-wrapper').removeClass('m-0');
  $('#c-header').addClass('c-header-fixed');
  $('#c-header > button.c-header-toggler').removeClass('d-none');
  $('#c-subheader').removeClass('d-none');
  $('#navbar').addClass('d-none');
  $('#c-header > a.navbar-brand').addClass('d-none');
}

if(localStorage.getItem('mode-dark') == 'true'){
  $('body#app').addClass('c-dark-theme');
  $('#mode-dark > input').prop('checked', true);
}else{
  $('body#app').removeClass('c-dark-theme');
  $('#mode-dark > input').prop('checked', false);
}
if(localStorage.getItem('navbar-vertical') == 'true'){
  showVertivalNavbar();
  $('#navbar-vertical > input').prop('checked', true);
}else{
  hideVerticalNavbar();
  $('#navbar-vertical > input').prop('checked', false);
}
if(localStorage.getItem('bg-image') == 'true'){
  $('body#app').addClass('bg-image');
  $('#bg-image > input').prop('checked', true);
}else{
  $('body#app').removeClass('bg-image');
  $('#bg-image > input').prop('checked', false);
}

$(window).on('load', function(){

  // Aside cerrar
  $('#close-sidebar').off('click');
  $('#close-sidebar').on('click', function(){
    $('#aside').removeClass('c-sidebar-show');
    $('.c-sidebar-backdrop.c-fade.c-show').addClass('d-none');
  });

  // Submit solo una vez
  $('form button[type="submit"]:not(.dropdown-item)').on('click', function(){
    $(this).addClass('disabled');
    $(this).off('click');
    $(this).on('click', function(e){
      e.preventDefault();
    });
  });

  // Modo claro/oscuro
  $('#mode-dark > span').on('click', function(){
    if ($('#mode-dark > input').is(':checked')){ 
      // modo dark off
      $('body#app').removeClass('c-dark-theme');
      localStorage.setItem('mode-dark', 'false');
    }else{ 
      // modo dark on
      $('body#app').addClass('c-dark-theme');
      localStorage.setItem('mode-dark', 'true');
    }
  });

  // Sidebar vertical
  $('#navbar-vertical > span').on('click', function(){
    if ($('#navbar-vertical > input').is(':checked')){ 
      // navbar vertical off
      hideVerticalNavbar();
      localStorage.setItem('navbar-vertical', 'false');
    }else{ 
      // navbar vertical on
      showVertivalNavbar();
      localStorage.setItem('navbar-vertical', 'true');
    }
  });

  // Fondo con imagen
  $('#bg-image > span').on('click', function(){
    if ($('#bg-image > input').is(':checked')){ 
      // fondo con imagen off
      $('body#app').removeClass('bg-image');
      localStorage.setItem('bg-image', 'false');
    }else{ 
      // fondo con imagen on
      $('body#app').addClass('bg-image');
      localStorage.setItem('bg-image', 'true');
    }
  });

  // Select editable

  $(".select-editable > input").on("focus", function(){
    $(this).prev().children(":first-child").addClass("focus");
  });
  $(".select-editable > input").on("blur", function(){
    $(this).prev().children(":first-child").removeClass("focus");
  });
  $(".select-editable .dropdown-item").on("click", function(){
    $(this).parent().parent().parent().next().val($(this).attr("id").replace(/_/g, " "));
    $(".select-editable .search input").val("");
  });

  $(".select-editable .search input").on("keyup", function(){
    let value = $(this).val().replace(/ /g, "_")
    if(value != ""){
      $(this).parent(".search").siblings(".options").children(":not([id*='"+value+"'])").addClass("d-none");
      $(this).parent(".search").siblings(".options").children("[id*='"+value+"']").removeClass("d-none");
    }else {
      $(this).parent(".search").siblings(".options").children().removeClass("d-none");
    }
    if($(this).parent(".search").siblings(".options").children(".d-none").length == $(this).parent(".search").siblings(".options").children().length){
      $(this).parent(".search").siblings(".without").removeClass("d-none");
    }else{
      $(this).parent(".search").siblings(".without").addClass("d-none");
    }
  });

  // Tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="tooltip"]').on('click', ()=>{
      $('.tooltip[role="tooltip"]').remove();
    });
  })
  // Popovers
  $(function () {
    $('[data-toggle="popover"]').popover();
  })

  // impresora
  $("#event-print").on("mouseenter", ()=>{
    interval = setInterval(function(){
      if (counter == 3) counter = 0;
      $("#event-print .paper").attr("d", attrs[counter]);
      counter++;
    }, 1000);
  });
  $("#event-print").on("mouseleave", ()=>{
    clearInterval(interval);
  });

});