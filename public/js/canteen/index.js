const sideMenu = document.querySelector("aside");
const menuBtn = document.getElementById("menu-btn");
const closeBtn = document.getElementById("close-btn");

menuBtn.addEventListener("click", () => {
  sideMenu.style.display = "block";
});

closeBtn.addEventListener("click", () => {
  sideMenu.style.display = "none";
});

Orders.forEach((order) => {
  const tr = document.createElement("tr");
  const trContent = `
        <td>${order.productName}</td>
        <td>${order.productNumber}</td>
        <td>${order.paymentStatus}</td>
        <td class="${order.status === "Declined" ? "danger" : order.status === "Pending" ? "warning" : "primary"}">${order.status}</td>
        <td class="primary">Details</td>
    `;
  tr.innerHTML = trContent;
  let table = document.querySelector("#table-order");
  if (table) {
    table.appendChild(tr);
  }
});

function convertToSlug(Text) {
  return Text.toLowerCase()
    .replace(/ /g, "-")
    .replace(/[^\w-]+/g, "");
}

function nameToSlug(input, target) {
  target = document.getElementById(target);
  if (target) {
    target.value = convertToSlug(input.value);
  }
}

function toast(text) {
  var myToast = Toastify({
    text: text,
    duration: 5000,
    close: true,
    gravity: "bottom",
  });

  myToast.showToast();
}

function getStatus(input, url) {
  xhttp = new XMLHttpRequest();
  const status = input.value;
  let body = "";
  body += "status=" + encodeURIComponent(status);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let tbody = document.getElementById("tbody-order");
      tbody.innerHTML = this.responseText;
    }
  };

  xhttp.open("POST", url, false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(body);
}
