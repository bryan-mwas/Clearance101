$(function(){
  // error messages default hide
  // schools
  $('#schoolComment_error_message').hide();
  $('#schoolValue_error_message').hide();
  // cafeteria
  $('#cafeteriaComment_error_message').hide();
  $('#cafeteriaValue_error_message').hide();
  // library
  $('#libraryComment_error_message').hide();
  $('#libraryValue_error_message').hide();
  // financial aid.
  $('#finAidLoan_error_message').hide();
  $('#finAidPaid_error_message').hide();
  $('#finAidBal_error_message').hide();
  $('#finAidLender_error_message').hide();

  // finance
  $('#amount_error_message').hide();
  $('#finPendschool_error_message').hide();
  $('#finPendcaft_error_message').hide();
  $('#finPendFinAid_error_message').hide();
  $('#finPendLib_error_message').hide();
  $('#finPendFin_error_message').hide();
  // perform action when out of text box.
  // schools
  $("#schoolValue").focusout(function(){
    check_schoolValue();
  });
  $("#schoolComment").focusout(function(){
    check_schoolComment();
  });
  // cafeteria
  $("#cafeteriaComment").focusout(function(){
    check_cafeteriaComment();
  });
  $("#cafeteriaValue").focusout(function(){
    check_cafeteriaValue();
  });

  // library
  $("#libraryComment").focusout(function(){
    check_libraryComment();
  });
  $("#libraryValue").focusout(function(){
    check_libraryValue();
  });

  // financial Aid
  $("#finAidLoan").focusout(function(){
    check_finAidLoan();
  });
  $("#finAidPaid").focusout(function(){
    check_finAidPaid();
  });
  $("#finAidBal").focusout(function(){
    check_finAidBal();
  });
  $("#finAidLender").focusout(function(){
    check_finAidLender();
  });
  // finance
  $("#clearAmount").focusout(function(){
    check_ammount();
  });
  $("#finPendschool").focusout(function(){
    check_finPendschool();
  });
  $("#cafPendschool").focusout(function(){
    check_finPendschool();
  });
  $("#finPendschool").focusout(function(){
    check_finPendschool();
  });
  $("#cafPendschool").focusout(function(){
    check_cafPendschool();
  });
  $("#finPendFinAid").focusout(function(){
    check_finPendFinAid();
  });
  $("#finPendLib").focusout(function(){
    check_finPendLib();
  });

  $("#finPendFin").focusout(function(){
    check_finPendFin();
  });

  // the logic
  // schools
  function check_schoolValue(){
    var amt = $("#schoolValue").val();
    var re = new RegExp("^[0-9]");
    if(!amt.match(re)){
      $("#schoolValue_error_message").html("Invalide Input");
      $("#schoolValue_error_message").show();
    }else{
      $("#schoolValue_error_message").hide();
    }
  }

  function check_schoolComment(){
    var schoolCom = $("#schoolComment").val();
    var regex = new RegExp("^[a-zA-Z0-9.]*$");
    if(!schoolCom.match(regex)){
      $("#schoolComment_error_message").html("It must contain Letters and Numbers only");
      $("#schoolComment_error_message").show();
    }else{
      $("#schoolComment_error_message").hide();
    }
  }
  // cafeteria
  function check_cafeteriaComment(){
    var caftCom = $("#cafeteriaComment").val();
    var regex = new RegExp("^[a-zA-Z0-9.]*$");
    if(!caftCom.match(regex)){
      $("#cafeteriaComment_error_message").html("It must contain Letters and Numbers only");
      $("#cafeteriaComment_error_message").show();
    }else{
      $("#cafeteriaComment_error_message").hide();
    }
  }
  function check_cafeteriaValue(){
    var caftAmount = $("#cafeteriaValue").val();
    var re = new RegExp("^[0-9]");
    if(!caftAmount.match(re)){
      $("#cafeteriaValue_error_message").html("Invalide Input");
      $("#cafeteriaValue_error_message").show();
    }else{
      $("#cafeteriaValue_error_message").hide();
    }
  }

  // library
  function check_libraryComment(){
    var libCom = $("#libraryComment").val();
    var regex = new RegExp("^[a-zA-Z0-9.]*$");
    if(!libCom.match(regex)){
      $("#libraryComment_error_message").html("It must contain Letters and Numbers only");
      $("#libraryComment_error_message").show();
    }else{
      $("#libraryComment_error_message").hide();
    }
  }
  function check_libraryValue(){
    var libAmount = $("#libraryValue").val();
    var re = new RegExp("^[0-9]");
    if(!libAmount.match(re)){
      $("#libraryValue_error_message").html("Invalide Input");
      $("#libraryValue_error_message").show();
    }else{
      $("#libraryValue_error_message").hide();
    }
  }

  // financial aid
  function check_finAidLoan(){
    var amt = $("#finAidLoan").val();
    var re = new RegExp("^[0-9]");
    if(!amt.match(re)){
      $("#finAidLoan_error_message").html("Invalide Input");
      $("#finAidLoan_error_message").show();
    }else{
      $("#finAidLoan_error_message").hide();
    }
  }
  function check_finAidPaid(){
    var amt = $("#finAidPaid").val();
    var re = new RegExp("^[0-9]");
    if(!amt.match(re)){
      $("#finAidPaid_error_message").html("Invalide Input");
      $("#finAidPaid_error_message").show();
    }else{
      $("#finAidPaid_error_message").hide();
    }
  }
  function check_finAidBal(){
    var amt = $("#finAidBal").val();
    var re = new RegExp("^[0-9]");
    if(!amt.match(re)){
      $("#finAidBal_error_message").html("Invalide Input");
      $("#finAidBal_error_message").show();
    }else{
      $("#finAidPaid_error_message").hide();
    }
  }
  function check_finAidLender(){
    var finAidLenderCom = $("#finAidLender").val();
    var regex = new RegExp("^[a-zA-Z.]*$");
    if(!finAidLenderCom.match(regex)){
      $("#finAidLender_error_message").html("It must contain Letters only");
      $("#finAidLender_error_message").show();
    }else{
      $("#finAidLender_error_message").hide();
    }
  }
  // finance
  function check_ammount(){
    var amt = $("#clearAmount").val();
    var re = new RegExp("^[0-9]");
    if(!amt.match(re)){
      $("#amount_error_message").html("Invalide Input");
      $("#amount_error_message").show();
    }else{
      $("#amount_error_message").hide();
    }
  }

  function check_finPendschool(){
    var amtSchool = $("#finPendschool").val();
    var re = new RegExp("^[0-9]");
    if(!amtSchool.match(re)){
      $("#finPendschool_error_message").html("Invalide Input");
      $("#finPendschool_error_message").show();
    }else{
      $("#finPendschool_error_message").hide();
    }
  }

  function check_cafPendschool(){
    var amtCaft = $("#cafPendschool").val();
    var re = new RegExp("^[0-9]");
    if(!amtCaft.match(re)){
      $("#finPendcaft_error_message").html("Invalide Input");
      $("#finPendcaft_error_message").show();
    }else{
      $("#finPendcaft_error_message").hide();
    }
  }

  function check_finPendFinAid(){
    var amtFinAid = $("#finPendFinAid").val();
    var re = new RegExp("^[0-9]");
    if(!amtFinAid.match(re)){
      $("#finPendFinAid_error_message").html("Invalide Input");
      $("#finPendFinAid_error_message").show();
    }else{
      $("#finPendFinAid_error_message").hide();
    }
  }

  function check_finPendLib(){
    var amtLib= $("#finPendLib").val();
    var re = new RegExp("^[0-9]");
    if(!amtLib.match(re)){
      $("#finPendLib_error_message").html("Invalide Input");
      $("#finPendLib_error_message").show();
    }else{
      $("#finPendLib_error_message").hide();
    }
  }

  function check_finPendFin(){
    var amtFinAid = $("#finPendFin").val();
    var re = new RegExp("^[0-9]");
    if(!amtFinAid.match(re)){
      $("#finPendFin_error_message").html("Invalide Input");
      $("#finPendFin_error_message").show();
    }else{
      $("#finPendFin_error_message").hide();
    }
  }
});
