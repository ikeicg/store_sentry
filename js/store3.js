let form = document.querySelector(".sales_form");
let error_box = document.querySelector("#error");

function addProductItem() {
  let table = document.querySelector(".entity_table");
  let noProd = document.querySelectorAll(".product_input").length;

  table.insertAdjacentHTML(
    "beforeend",
    `
  <tr class="product_input">

      <td>
          <input  data-id=${
            noProd + 1
          } type="number" class="prod_id" name="prod_id" required autocomplete='off' oninput='populatedetails(this) '>
      </td>
      <td>
          <p class = 'prod_name' data-id=${noProd + 1}></p>
      </td>
      <td>
          <p class = 'prod_price' data-id=${noProd + 1}></p>
      </td>
      <td>
          <input type="number" class="prod_qt" name="prod_qt" id="" required autocomplete='off'>
      </td>
      <td>
          <input type="date" class="expiry" name="expiry" required >
      </td>
  </tr>
`
  );

  document.querySelectorAll('input[type="number"]').forEach((item) => {
    item.addEventListener("input", () => {
      error.textContent = "";
    });
  });
}

function populatedetails(element) {
  let elementid = element.getAttribute("data-id");
  let prod_name = document.querySelector(`[data-id='${elementid}'].prod_name`);
  let prod_price = document.querySelector(
    `[data-id='${elementid}'].prod_price`
  );

  fetch("logic/fetch_product.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ value: element.value, type: "populateform" }),
  })
    .then((response) => response.json())
    .then((data) => {
      prod_price.textContent = data.cp;
      prod_name.textContent = data.pn;
    })
    .catch((error) => console.error("Fetch error:", error));
}

form.addEventListener("submit", function (e) {
  e.preventDefault();

  prod_inputs = document.querySelectorAll(".product_input");

  data = [];

  prod_inputs.forEach(function (item) {
    data_item = {};

    if (item.querySelector(".prod_name").textContent) {
      const product_id = parseInt(item.querySelector(".prod_id").value);
      const product_quantity = parseInt(item.querySelector(".prod_qt").value);
      const product_price = parseInt(
        item.querySelector(".prod_price").textContent
      );
      const product_expiry = item.querySelector(".expiry").value;

      const existingItemIndex = data.findIndex(
        (el) => el.product_id === product_id
      );

      if (existingItemIndex !== -1) {
        // If product_id already exists, update quantity and expiry
        data[existingItemIndex].product_quantity += product_quantity;

        let currentExpiry = data[existingItemIndex].product_expiry;
        if (product_expiry < currentExpiry) {
          data[existingItemIndex].product_expiry = product_expiry;
        }
      } else {
        // If product_id doesn't exist, create a new entry
        data.push({
          product_id: product_id,
          product_quantity: product_quantity,
          product_price: product_price,
          product_expiry: product_expiry,
        });
      }
    }
  });

  if (data.length > 0) {
    valid_quantity = true;

    data.forEach((item) => {
      if (item.product_quantity <= 0) {
        valid_quantity = null;
      }
    });

    if (valid_quantity) {
      const totalCost = data.reduce((acc, item) => {
        const itemCost = item.product_price * item.product_quantity;
        return acc + itemCost;
      }, 0);

      const spr_id = parseInt(document.querySelector(".prod_spr").value);

      fetch("logic/set_orders.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          products: data,
          totalValue: totalCost,
          supplierId: spr_id,
          type: "purchase",
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          error_box.textContent = data.status;
          location.reload();
        });
    } else {
      error_box.textContent = "Invalid Quantity in One or more Items";
    }
  }
});
