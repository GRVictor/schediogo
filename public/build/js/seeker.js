function startApp(){searchByDate(),confirmDelete()}function searchByDate(){document.querySelector("#date").addEventListener("input",(function(e){const t=e.target.value;window.location=`?date=${t}`}))}function confirmDelete(){document.querySelectorAll(".delete-form").forEach((e=>{e.addEventListener("submit",(function(t){t.preventDefault(),Swal.fire({title:"¿Seguro que quieres eliminar la cita?",text:"Esta acción no se puede deshacer",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Sí, eliminar",cancelButtonText:"No, cancelar"}).then((t=>{t.isConfirmed&&e.submit()}))}))}))}document.addEventListener("DOMContentLoaded",(function(){startApp()}));