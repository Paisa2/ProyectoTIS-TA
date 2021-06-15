@extends('base')
@section('head')
<link rel="stylesheet" href="{{asset('css/forms.css')}}">
<style>
.select-editable {
  position: relative;
}
.select-editable > input {
  position:absolute; 
  top:0px; 
  left:0px; 
  border-right:none; 
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  box-shadow:none !important; 
  width:93%;
}
.select-editable .dropdown button.dropdown-toggle{
  display: flex;
  justify-content: flex-end;
}
.select-editable .dropdown .dropdown-menu {
  width: 100%;
  box-shadow: 0 4px 5px 0 rgba(var(--elevation-base-color), .14), 0 1px 10px 0 rgba(var(--elevation-base-color), .12), 0 2px 4px -1px rgba(var(--elevation-base-color), .20);
}
.select-editable .dropdown .dropdown-menu .dropdown-item {
  cursor: pointer;
}
.c-dark-theme .select-editable .dropdown .dropdown-menu {
  background-color: #34353e;
}
.select-editable .dropdown .dropdown-menu .options{
  display: block;
  max-height: 12rem;
  overflow-y: auto;
}
.select-editable .dropdown-menu .search, 
.select-editable .dropdown-menu .without {
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding: 0rem .5rem;
  clear: both;
  background-color: transparent;
  border: 0;
}
.select-editable .dropdown-menu .without {
  padding: 0.5rem 1.25rem 0 1.25rem;
  color: #757575 !important;
}
.select-editable .dropdown-menu .search input{
  background-color: transparent !important;
  box-shadow: none !important;
}

</style>
@endsection

@section('main')
<form style="width:50%; height:40rem;">
  

  <div class="select-editable">
    <div class="dropdown">
      <button class="form-control dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <span class="search"><input type="text" class="form-control"></span>
        <span class="options">
          <span class="dropdown-item" id="ASD_asd">ASD asd</span>
          <span class="dropdown-item" id="Another_action">Another action</span>
          <span class="dropdown-item" id="Something_else_here">Something else here</span>
          <span class="dropdown-item" id="Something_else_here">Something else here</span>
          <span class="dropdown-item" id="Something_else_here">Something else here</span>
          <span class="dropdown-item" id="Something_else_here">Something else here</span>
          <span class="dropdown-item" id="Something_else_here">Something else here</span>
          <span class="dropdown-item" id="Something_else_here">Something else here</span>
          <span class="dropdown-item" id="Something_else_here">Something else here</span>
          </span>
        <span class="without d-none">Sin resultados</span>
      </div>
    </div>
    <input type="text" value="" class="form-control">
  </div>

</form>
@endsection

@section('scripts')
<script>
  $(window).on("load", function(){

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

  });
</script>
@endsection