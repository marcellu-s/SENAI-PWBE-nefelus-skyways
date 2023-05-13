const inputSubject = document.querySelector('#subject');

function resquestComments(query='') {

  $.ajax({
    method: "POST",
    url: "../assets/php/viewComments.php",
    data: {
      q: query
    },
    success: function (response) {
      document.querySelector(".messages-wrapper").innerHTML = response;
    },
  });
}

inputSubject.addEventListener('keyup', function() {

  resquestComments(this.value);
});