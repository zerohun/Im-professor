$(document).ready(function(){

  $("select[name=school]").change(function(){
    var id = $(this).val();
    $(this).find("#first_option").remove();
    $.getJSON("majors_ajax.php?id=" + id, function(data){
      $("select[name=major]").html("");
      $(data).each(function(i,major){
        $("select[name=major]").prepend("<option value=" + major["id"] +">" + major["name"] + "</option>");
		$("select[name=major]").prepend("<input type = hidden name = option_major_value id = option_major_value value = " + major["id"] +">");    // 학과를 join.php 로 보냄
        $("select[name=major]").change();
      });
    });
  }); 
});
