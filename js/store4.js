document.querySelectorAll(".order_line_sales").forEach((element) => {
  element.addEventListener("click", function () {
    let id = element.querySelector(".order_line_id").textContent;

    openForm("hd_orderlines");

    fetch("logic/fetch_orders.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ value: id, type: "sales" }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);

        let orderline_rows = document.querySelector("#pop_orderline");
        orderline_rows.innerHTML = "";
        let tot_row = document.querySelector("#pop_tot");
        let order_items = data.message.items;
        let tot_value = data.message.value;

        order_items.forEach((element) => {
          orderline_rows.insertAdjacentHTML(
            "beforeend",
            `<tr>
              <td>${element.p_name}</td>
              <td>${element.p_quantity}</td>
            </tr>`
          );
        });

        orderline_rows.insertAdjacentHTML(
          "beforeend",
          `
            <tr>
                <th>Total Value</th>
                <td>${tot_value}</td>
            </tr>
        `
        );
      });
  });
});

document.querySelectorAll(".order_line_purchase").forEach((element) => {
  element.addEventListener("click", function () {
    let id = element.querySelector(".order_line_id").textContent;

    openForm("hd_orderlines");

    fetch("logic/fetch_orders.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ value: id, type: "purchase" }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);

        let orderline_rows = document.querySelector("#pop_orderline");
        orderline_rows.innerHTML = "";
        let tot_row = document.querySelector("#pop_tot");
        let order_items = data.message.items;
        let tot_value = data.message.value;

        order_items.forEach((element) => {
          orderline_rows.insertAdjacentHTML(
            "beforeend",
            `<tr>
              <td>${element.p_name}</td>
              <td>${element.p_quantity}</td>
            </tr>`
          );
        });

        orderline_rows.insertAdjacentHTML(
          "beforeend",
          `
            <tr>
                <th>Total Value</th>
                <td>${tot_value}</td>
            </tr>
        `
        );
      });
  });
});

function openForm(formID) {
  let form = document.getElementById(formID);
  form.style.display = "block";
}

document.querySelector(".close_form").addEventListener("click", function () {
  let parentElement = this.parentNode;
  parentElement.style.display = "none";
});
