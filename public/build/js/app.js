let step=1;const firstStep=1,lastStep=3,appoinment={name:"",date:"",time:"",services:[]};function startApp(){showSection(),tabs(),buttonsPager(),nextPage(),previousPage(),consultAPI()}function showSection(){const e=document.querySelector(".show");e&&e.classList.remove("show");const t=`#step-${step}`;document.querySelector(t).classList.add("show");const s=document.querySelector(".current");s&&s.classList.remove("current");document.querySelector(`[data-step="${step}"]`).classList.add("current")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(function(e){step=parseInt(e.target.dataset.step),showSection(),buttonsPager()}))}))}function buttonsPager(){const e=document.querySelector("#next"),t=document.querySelector("#prev");1===step?(t.classList.add("hidden"),e.classList.remove("hidden")):3===step?(t.classList.remove("hidden"),e.classList.add("hidden")):(t.classList.remove("hidden"),e.classList.remove("hidden"))}function previousPage(){document.querySelector("#prev").addEventListener("click",(function(){step<=1||(step--,buttonsPager(),showSection())}))}function nextPage(){document.querySelector("#next").addEventListener("click",(function(){step>=3||(step++,buttonsPager(),showSection())}))}async function consultAPI(){try{const e="http://localhost:3000/api/services",t=await fetch(e);showServices(await t.json())}catch(e){console.log(e)}}function showServices(e){e.forEach((e=>{const{id:t,service_name:s,price:c}=e,n=document.createElement("P");n.classList.add("service-name"),n.textContent=s;const o=document.createElement("P");o.classList.add("service-price"),o.textContent=`$ ${c}`;const i=document.createElement("DIV");i.classList.add("service"),i.dataset.idService=t,i.onclick=function(){selectService(e)},i.appendChild(n),i.appendChild(o),document.querySelector("#service").appendChild(i)}))}function selectService(e){const{id:t}=e,{services:s}=appoinment,c=document.querySelector(`[data-id-service="${t}"]`);c.classList.contains("selected")?(appoinment.services=s.filter((e=>e.id!==t)),c.classList.remove("selected")):(appoinment.services=[...s,e],c.classList.add("selected")),console.log(appoinment)}document.addEventListener("DOMContentLoaded",(function(){startApp()}));