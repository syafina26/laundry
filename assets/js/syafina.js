function selectCustomers() {
  const select = document.getElementById("customer_id");
  const phone = select.options[select.selectedIndex].getAttribute("data-phone");

  document.getElementById("phone").value = phone || "";
}

function openModal(service) {
  document.getElementById("modal_id").value = service.id;
  document.getElementById("modal_name").value = service.name;
  document.getElementById("modal_price").value = service.price;
  document.getElementById("modal_qty").value = 1;

  new bootstrap.Modal("#exampleModal").show();
}

let cart = [];

function addCart() {
  const id = document.getElementById("modal_id").value;
  const name = document.getElementById("modal_name").value;
  const price = parseInt(document.getElementById("modal_price").value);
  const quantity = parseInt(document.getElementById("modal_qty").value);

  const existing = cart.find((item) => item.id == id);

  if (existing) {
    existing.quantity += quantity;
  } else {
    cart.push({
      id,
      name,
      product_price: price,
      quantity: quantity,
    });
  }

  renderCart();
  bootstrap.Modal.getInstance(document.getElementById("exampleModal")).hide();
}

function renderCart() {
  const cartContainer = document.querySelector("#cartItems");
  cartContainer.innerHTML = "";

  if (cart.length === 0) {
    cartContainer.innerHTML = `
      <div class="text-center text-muted mt-5">
        <i class="bi bi-basket"></i>
        <p>Empty Cart</p>
      </div>`;
    updateTotal();
    return;
  }

  cart.forEach((item) => {
    const div = document.createElement("div");
    div.className =
      "cart-item d-flex justify-content-between align-items-center mb-2";

    div.innerHTML = `
      <div>
        <strong>${item.name}</strong>
        <small>Rp. ${item.product_price}</small>
      </div>
      <div class="d-flex align-items-center">
        <button class="btn btn-outline-secondary me-2" onclick="changeQty(${item.id}, -1)">-</button>
        <span>${item.quantity}</span>
        <button class="btn btn-outline-secondary ms-2" onclick="changeQty(${item.id}, 1)">+</button>
        <button class="btn btn-outline-danger ms-3" onclick="removeItem(${item.id})">
          <i class="bi bi-trash-fill"></i>
        </button>
      </div>
    `;
    cartContainer.appendChild(div);
  });

  updateTotal();
}

//hapus item dari cart
function removeItem(id) {
  cart = cart.filter((p) => p.id != id);
  renderCart();
}
//mengatur qty di cart
function changeQty(id, x) {
  const item = cart.find((p) => p.id == id);
  if (!item) return;

  item.quantity += x;

  if (item.quantity <= 0) {
    item.quantity = 1;
  }

  renderCart();
}

function updateTotal() {
  const subtotal = cart.reduce(
    (sum, item) => sum + item.product_price * item.quantity,
    0
  );

  const tax = subtotal * 0.1;
  const total = subtotal + tax;

  document.getElementById(
    "subtotal"
  ).textContent = `Rp. ${subtotal.toLocaleString()}`;
  document.getElementById("tax").textContent = `Rp. ${tax.toLocaleString()}`;
  document.getElementById("total").textContent = `Rp. ${total.toLocaleString()}`;

  document.getElementById("subtotal_value").value = subtotal;
  document.getElementById("tax_value").value = tax;
  document.getElementById("total_value").value = total;
}

document.getElementById("clearCart").addEventListener("click", function () {
  cart = [];
  renderCart();
});

async function processPayment() {
  if (cart.length === 0) {
    alert("Cart Masih Kosong");
    return;
  }
  const order_code = document.querySelector(".orderNumber").textContent.trim();
  const subtotal = document.querySelector("#subtotal_value").value.trim();
  const tax = document.querySelector("#tax_value").value.trim();
  const grandTotal = document.querySelector("#total_value").value.trim();
  const customer_id = document.getElementById("customer_id").value;
  const end_date = document.getElementById("end_date").value;
  try {
    const res = await fetch("add-order.php?payment", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        cart,
        order_code,
        subtotal,
        tax,
        grandTotal,
        customer_id,
        end_date,
      }),
    });
    const data = await res.json();
    if (data.status == "success") {
      alert("Transaction Success");
      window.location.href = "print.php";
    } else {
      alert("Transaction failed", data.message);
    }
  } catch (error) {
    alert("Yahh Transaction fail");
    console.log("error", error);
  }
}

//useEffect(() => {
//},[])

//DomContentLoaded : akan meload function pertama kali
