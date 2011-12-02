$(document).ready(function(){
    $("select[name=school]").change( function (){
	var id = $("select[name=school]").val();
	var major_id = $("select[name=major]").val();
    $(this).find("#first_option").remove();
    $.getJSON("prof_edit_ajax.php?id=" + id + "&major=" + major_id, function(data){
      $("select[name=major]").html("");
	  $(data).each(function(i,major){
        $("select[name=major]").prepend("<option value=" + major["id"] +">" + major["name"] + "</option>");
        $("select[name=major]").change();
		});
      });
    });
});
