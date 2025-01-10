document.addEventListener("DOMContentLoaded", function () {
    confirmDelete();
  });
  
  function confirmDelete() {
    const deleteForms = document.querySelectorAll(".delete-form");
  
    deleteForms.forEach((form) => {
      form.addEventListener("submit", function (e) {
        e.preventDefault();
  
        Swal.fire({
          title: "¿Seguro que quieres eliminar este servicio?",
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