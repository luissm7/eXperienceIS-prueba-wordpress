jQuery(document).ready(function ($) {
  $("#search-form").submit(function (e) {
    e.preventDefault();
    ajax(e);
  });

  function ajax() {
    var nameTerm = $("#name-search-input").val();
    var emailTerm = $("#email-search-input").val();
    var surnameTerm = $("#surname-search-input").val();

    $.ajax({
      type: "POST",
      url: ajax_object.ajax_url,
      data: {
        action: "buscar_resultados",
        name: nameTerm,
        email: emailTerm,
        surname: surnameTerm,
        pagina: currentPage,
      },
      success: function (response) {
        console.log(lastPage);
        $("#search-results").html(response);
      },
      error: function () {
        alert("Error al procesar la solicitud");
      },
    });

    updatePagination();
  }

  let currentPage = 1;
  let lastPage = 0;

  function updatePagination() {
    // Actualiza el número de página
    $("#currentPage").text("Página " + currentPage);

    // Actualiza botones
    if (currentPage === 1) {
      $("#prevPage").prop("disabled", true);
    } else {
      $("#prevPage").prop("disabled", false);
    }
    if (currentPage === lastPage) {
      $("#nextPage").prop("disabled", true);
    } else {
      $("#nextPage").prop("disabled", false);
    }
  }

  // Manejador para el botón "Siguiente"
  $("#nextPage").on("click", function () {
    currentPage++;
    ajax();
  });

  // Manejador para el botón "Anterior"
  $("#prevPage").on("click", function () {
    if (currentPage > 1) {
      currentPage--;
      ajax();
    }
  });

  //Función para saber cual es la última página
  $("#users tbody tr").each(function () {
    if ($(this).find("td").length > 0) {
      lastPage++;
    }
  });
});
