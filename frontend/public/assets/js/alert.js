function showAlert(message) {
  $("#alert").text(message);
  $("#alert").show("slow");
  $(".alert").toggleClass(`status-${type}`);

  $("#alert").click(function () {
    $(this).hide("slow");
  });

  setTimeout(() => {
    $("#alert").hide("slow");
  }, 5000);
}

showAlert(message, type);