let closeButtons = document.querySelectorAll(".close_form");

closeButtons.forEach((element) => {
  element.addEventListener("click", function () {
    let parentElement = this.parentNode;
    parentElement.style.display = "none";
  });
});

function openForm(formID) {
  let form = document.getElementById(formID);
  form.style.display = "block";
}

function fetchProductName(id) {
  let namebox = document.querySelector(".form_search_drop");

  fetch("logic/fetch_product.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ value: id, type: "searchoptions" }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.value) {
        namebox.textContent = data.value;
        namebox.setAttribute("data-id", `${id}`);
      } else {
        namebox.textContent = "No Such Product";
        namebox.setAttribute("data-id", `0`);
      }
    })
    .catch((error) => console.error("Fetch error:", error));
}

function populateEditForm(element) {
  let costprice = document.querySelector("#pdt_cp2");
  let sellingprice = document.querySelector("#pdt_sp2");
  let categoryid = document.querySelector("#cty_id2");
  let supplierid = document.querySelector("#spr_id2");
  let reorderqt = document.querySelector("#reorder_qt2");

  let value = element.getAttribute("data-id");
  if (value > 0) {
    fetch("logic/fetch_product.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ value: value, type: "populateform" }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data, costprice);
        costprice.value = data.cp;
        sellingprice.value = data.sp;
        categoryid.value = data.cid;
        supplierid.value = data.sid;
        reorderqt.value = data.rqt;
      })
      .catch((error) => console.error("Fetch error:", error));
  }
}
