$(document).ready(function(){
    var id = $("select[name=school]").val();
	var major_id = $("select[name=major]").val();
    $(this).find("#first_option").remove();
    $.getJSON("majors_ajax.php?id=" + id + "&major=" + major_id, function(data){
      $("select[name=major]").html("");
	  alert ( data );
	  $(data).each(function(i,major){
        $("select[name=major]").prepend("<option value=" + major["id"] +">" + major["name"] + "</option>");
		$("select[name=major]").prepend("<input type = hidden name = option_major_value id = option_major_value value = " + major["id"] +">");    // �а��� join.php �� ����
        $("select[name=major]").change();
      });
    });
});
