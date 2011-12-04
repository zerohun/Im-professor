function enable_join(){
  alert("사용하실 수 있습니다.");
  $("#email", opener.document).attr("readOnly", "true");

  $("#submitbutton" , opener.document).remove();
  $("#for_submit" , opener.document).append("<input id='submitbutton' type='submit' value='회원가입' />");
  window.close(); 
}


function duplicated(){
  alert("중복된 ID입니다. 사용하실 수 없습니다.");
  $("#email", opener.document).val("");
  var sbutton = $("#submitbutton[type='submit']" , opener.document);
  if(sbutton.length > 0){
    sbutton.remove();
    $("#for_submit" , opener.document).append("<input id='submitbutton' type='button' value= '회원가입' />");
    sbutton.click(function(){
      alert("아이디 중복체크를 해 주세요");
    });
  }
  window.close();

}
