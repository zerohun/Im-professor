$(document).ready(function(){

  $("select[name=choose_major]").change(function(){
    var id = $(this).val();
    $.getJSON("professors_ajax.php?id=" + id, function(data){
      $("select.professor").html("");
      $(data).each(function(i,prof){
        $("select.professor").prepend("<option value=" + prof["id"] +">" + prof["name"] + "</option>");
      });
    });
  }); 
  $("select[name=choose_school]").change(function(){
    var id = $(this).val();
    $("#first_option").remove();
    $.getJSON("majors_ajax.php?id=" + id, function(data){
      $("select.major").html("");
      $(data).each(function(i,major){
        $("select.major").prepend("<option value=" + major["id"] +">" + major["name"] + "</option>");
      });
    });
  }); 
});
