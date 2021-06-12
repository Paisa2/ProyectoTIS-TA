$(window).on('load', function(){

  if(localStorage.getItem('mode-dark') == 'true'){
    $('body#app').addClass('c-dark-theme');
    $('#mode-dark > input').prop('checked', true);
  }else{
    $('body#app').removeClass('c-dark-theme');
    $('#mode-dark > input').prop('checked', false);
  }

  $('#close-sidebar').off('click');
  $('#close-sidebar').on('click', function(){
    $('#aside').removeClass('c-sidebar-show');
    $('.c-sidebar-backdrop.c-fade.c-show').addClass('d-none');
  });

  $('form button[type="submit"]:not(.dropdown-item)').on('click', function(){
    $(this).addClass('disabled');
    $(this).off('click');
    $(this).on('click', function(e){
      e.preventDefault();
    });
  });

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

});