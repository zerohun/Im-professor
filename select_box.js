$(document).ready(function(){

  $("select[name=choose_major]").change(function(){
    var id = $(this).val();
    $.getJSON("professors_ajax.php?id=" + id, function(data){
      $("select.professor").html(""); 
      $("select.professor").prepend("<option selected='selected'>교수 선택</option>");
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
      $("select.major").prepend("<option value=0 selected='selected'>학과 선택</option>");
      $(data).each(function(i,major){
        $("select.major").prepend("<option value=" + major["id"] +">" + major["name"] + "</option>");
      });
    });
  }); 
  $("select[name=choose_professor]").change(function(){
    var professor_id = $(this).val();
    $(location).attr('href','professor.php?id=' + professor_id);
  });
  
});
