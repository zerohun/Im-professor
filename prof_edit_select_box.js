$(document).ready(function(){
    $("select[name=university_id]").change( function (){
	var id = $("select[name=university_id]").val();
	var major_id = $("select[name=major_id]").val();
    $(this).find("#first_option").remove();
    $.getJSON("prof_edit_ajax.php?id=" + id + "&major=" + major_id, function(data){
      $("select.embedded_major").html("");
	  $(data).each(function(i,major){
        $("select.embedded_major").prepend("<option value=" + major["id"] +">" + major["name"] + "</option>");
        $("select.embedded_major").change();
		});
      });
    });
});
