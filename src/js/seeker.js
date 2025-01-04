document.addEventListener('DOMContentLoaded', function() {
    startApp();
});

function startApp() {
    searchByDate();
    confirmDelete();
}

function searchByDate() {
    const dateInput = document.querySelector('#date');
    dateInput.addEventListener('input', function(e) {
        const selectedDate = e.target.value;

        window.location= `?date=${selectedDate}`;
    });
}

function confirmDelete() {
    const deleteForms = document.querySelectorAll(".delete-form");
  
    deleteForms.forEach((form) => {-
      form.addEventListener("submit", function (e) {
        e.preventDefault();
  
        Swal.fire({
          title: "¿Seguro que quieres eliminar la cita?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, eliminar",
          cancelButtonText: "No, cancelar",
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  }