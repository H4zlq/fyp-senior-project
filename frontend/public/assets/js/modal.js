const modal = $('#myModal');
const span = $('.close');

span.click(() => {
  modal.hide();
});

function showModal() {
  modal.show();
}

function closeModal() {
  modal.hide();
}

$(window).click((event) => {
  if (event.target == modal) {
    modal.hide();
  }
});