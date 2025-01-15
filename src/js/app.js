let step = 1;
const firstStep = 1;
const lastStep = 3;

const appoinment = {
  id: "",
  name: "",
  date: "",
  time: "",
  services: [],
};

document.addEventListener("DOMContentLoaded", function () {
  startApp();
});

function startApp() {
  showSection(); // Show section with a specific step
  tabs(); // Change between tabs
  buttonsPager(); // Add or remove buttons to the pager
  nextPage(); // Go to the next page
  previousPage(); // Go to the previous page

  consultAPI(); // Consult API in PHP backend
  clientId(); // Get client ID
  clientName(); // Get client name
  clientDate(); // Get client date
  clientTime(); // Get client hour
  showResume(); // Show resume of the appoinment
}

function showSection() {
  // Hide section with class show
  const previousSection = document.querySelector(".show");
  if (previousSection) {
    previousSection.classList.remove("show");
  }

  // Select section with a specific step
  const stepSelector = `#step-${step}`;
  const section = document.querySelector(stepSelector);
  section.classList.add("show");

  // Remove active button
  const previousButton = document.querySelector(".current");
  if (previousButton) {
    previousButton.classList.remove("current");
  }

  // Change active button
  const tab = document.querySelector(`[data-step="${step}"]`);
  tab.classList.add("current");
}

function tabs() {
  const buttons = document.querySelectorAll(".tabs button");

  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      step = parseInt(e.target.dataset.step);
      showSection();
      buttonsPager();
    });
  });
}

function buttonsPager() {
  const nextPage = document.querySelector("#next");
  const previousPage = document.querySelector("#prev");

  if (step === firstStep) {
    previousPage.classList.add("hidden");
    nextPage.classList.remove("hidden");
  } else if (step === lastStep) {
    previousPage.classList.remove("hidden");
    nextPage.classList.add("hidden");

    // Show resume
    showResume();
  } else {
    previousPage.classList.remove("hidden");
    nextPage.classList.remove("hidden");
  }
}

function previousPage() {
  const previousPage = document.querySelector("#prev");
  previousPage.addEventListener("click", function () {
    if (step <= firstStep) return;
    step--;
    buttonsPager();
    showSection();
  });
}

function nextPage() {
  const nextPage = document.querySelector("#next");
  nextPage.addEventListener("click", function () {
    if (step >= lastStep) return;
    step++;
    buttonsPager();
    showSection();
  });
}

async function consultAPI() {
  try {
    const url = "http://localhost:3000/api/services";
    const result = await fetch(url);
    const services = await result.json();
    showServices(services);
  } catch (error) {
    console.log(error);
  }
}

function showServices(services) {
  services.forEach((service) => {
    const { id, service_name, price } = service;

    const serviceName = document.createElement("P");
    serviceName.classList.add("service-name");
    serviceName.textContent = service_name;

    const servicePrice = document.createElement("P");
    servicePrice.classList.add("service-price");
    servicePrice.textContent = `$ ${price}`;

    const serviceDiv = document.createElement("DIV");
    serviceDiv.classList.add("service");
    serviceDiv.dataset.idService = id;
    serviceDiv.onclick = function () {
      selectService(service);
    };

    serviceDiv.appendChild(serviceName);
    serviceDiv.appendChild(servicePrice);

    document.querySelector("#service").appendChild(serviceDiv);
  });
}

function selectService(service) {
  const { id } = service;
  const { services } = appoinment;

  // Find the service that was clicked
  const selectedService = document.querySelector(`[data-id-service="${id}"]`);

  // Check if the service is already selected
  if (services.some((added) => added.id === id)) {
    // Delete selected service
    appoinment.services = services.filter((added) => added.id !== id);
    selectedService.classList.remove("selected");
  } else {
    // Add selected service
    appoinment.services = [...services, service];
    selectedService.classList.add("selected");
  }
}

function clientId() {
  appoinment.id = document.querySelector("#client_id").value;
}

function clientName() {
  appoinment.name = document.querySelector("#name").value;
}

function clientDate() {
  const inputDate = document.querySelector("#date");
  inputDate.addEventListener("input", (e) => {
    const day = new Date(e.target.value).getUTCDay();
    if ([0, 6].includes(day)) {
      e.target.value = "";
      showAlert(
        "Lo siento, no trabajamos los fines de semana",
        "error",
        ".form"
      );
    } else {
      appoinment.date = e.target.value;
    }
  });
}

function clientTime() {
  const inputTime = document.querySelector("#time");
  inputTime.addEventListener("input", (e) => {
    const appoinmentTime = e.target.value;
    const hour = appoinmentTime.split(":")[0];
    if (hour < 8 || hour > 18) {
      e.target.value = "";
      showAlert(
        "Lo siento, solo trabajamos de 10:00 a 18:00",
        "error",
        ".form"
      );
    } else {
      appoinment.time = appoinmentTime;
      // console.log(appoinment);
    }
  });
}

function showAlert(message, type, element, disappear = true) {
  // If there is an alert, do not show another
  const prevAlert = document.querySelector(".alert");
  if (prevAlert) {
    prevAlert.remove();
  }

  // Script to show the alert
  const alert = document.createElement("DIV");
  alert.textContent = message;
  alert.classList.add("alert");
  alert.classList.add(type);

  const reference = document.querySelector(element);
  reference.appendChild(alert);

  if (disappear) {
    // Disappear after 3 seconds
    setTimeout(() => {
      alert.remove();
    }, 3000);
  }
}

function showResume() {
  const resume = document.querySelector(".resume-content");

  // Remove previous resume
  while (resume.firstChild) {
    resume.removeChild(resume.firstChild);
  }

  if (
    Object.values(appoinment).includes("") ||
    appoinment.services.length === 0
  ) {
    showAlert(
      "Todos los campos son obligatorios",
      "error",
      ".resume-content",
      false
    );
    return;
  }

  // Formatted resume
  const { name, date, time, services } = appoinment;

  // Header of the resume
  const heading = document.createElement("H3");
  heading.textContent = "Servicios adquiridos";
  resume.appendChild(heading);

  // Iterate over services and show them in the resume
  services.forEach((service) => {
    const { id, price, service_name } = service;
    const containerService = document.createElement("DIV");
    containerService.classList.add("container-service");

    const serviceName = document.createElement("P");
    serviceName.textContent = service_name;

    const servicePrice = document.createElement("P");
    servicePrice.innerHTML = `<span>Precio:</span> $ ${price}`;

    containerService.appendChild(serviceName);
    containerService.appendChild(servicePrice);

    resume.appendChild(containerService);
  });

  // Header of the client
  const headingClient = document.createElement("H3");
  headingClient.textContent = "Información de la cita";
  resume.appendChild(headingClient);

  const clientName = document.createElement("P");
  clientName.innerHTML = `<span>Nombre:</span> ${name}`;

  const clientDate = document.createElement("P");
  // Format date
  const formattedDate = new Date(date).toLocaleDateString("es-MX", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });
  const capitalizedDate =
    formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);
  // Show date
  clientDate.innerHTML = `<span>Fecha:</span> ${capitalizedDate}`;

  const clientTime = document.createElement("P");
  const timeParts = time.split(":");
  const hours = parseInt(timeParts[0]);
  const minutes = timeParts[1];
  const period = hours >= 12 ? "PM" : "AM";
  const formattedTime = `${hours % 12 || 12}:${minutes} ${period}`;
  clientTime.innerHTML = `<span>Hora:</span> ${formattedTime}`;

  // Button to confirm the appoinment
  const confirmButton = document.createElement("BUTTON");
  confirmButton.classList.add("btn");
  confirmButton.classList.add("btn-appoinment");
  confirmButton.textContent = "Confirmar cita";
  confirmButton.onclick = bookAppoinment;

  resume.appendChild(clientName);
  resume.appendChild(clientDate);
  resume.appendChild(clientTime);
  resume.appendChild(confirmButton);
}

async function bookAppoinment() {
  // Destructuring appoinment
  const { id, date, time, services } = appoinment;
  const idServices = services.map((service) => service.id);
  const data = new FormData();
  data.append("userId", id);
  data.append("date", date);
  data.append("time", time);
  data.append("services", idServices);

  try {
    // API request
    const url = "http://localhost:3000/api/appointments";

    const reply = await fetch(url, {
      method: "POST",
      body: data,
    });

    const result = await reply.json();
    console.log(result.result);

    if (result.result) {
      Swal.fire({
        icon: "success",
        title: "Cita creada",
        text: "La cita fue creada correctamente",
        confirmButtonText: "Aceptar",
      }).then(() => {
        location.reload();
      });
    }
    // console.log([...appoinment.services]); // Convert object to array to see what are you sending to the backend
  } catch (error) {
    Swal.fire({
      icon: "error",
      title: "Error al crear la cita",
      text: "Intenta nuevamente"
    }).then(() => {
      location.reload();
    });
  }
}