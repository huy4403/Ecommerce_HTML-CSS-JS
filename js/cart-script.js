import("../database/connect.php");
var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("header").classList.remove("hidden");
  }
  else {
    document.getElementById("header").classList.add("hidden");
  }
  prevScrollpos = currentScrollPos;
};


window.addEventListener("scroll", function() {
  var scrollToTopButton = document.getElementById("scrollToTopButton");
  
  // Hiển thị nút khi cuộn xuống một phần tử cụ thể
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      scrollToTopButton.style.display = "block";
  } else {
      scrollToTopButton.style.display = "none";
  }
});

// Xử lý sự kiện khi nhấn nút quay lại đầu trang
document.getElementById("scrollToTopButton").addEventListener("click", function() {
  document.body.scrollTop = 0; // Safari
  document.documentElement.scrollTop = 0; // Chrome, Firefox, IE, Opera
});

// Thanh toán
var originalInnerHTML = document.getElementById("confirmationDiv").innerHTML;
function resetConfirmation() {
  var confirmationDiv = document.getElementById("confirmationDiv");
  confirmationDiv.innerHTML = originalInnerHTML;
}
// Thanh toan san pham
function showConfirmation() {
  var confirmationDiv = document.getElementById("confirmationDiv");
  confirmationDiv.style.display = "block";
  resetConfirmation();
}
function hideConfirmation() {
  var confirmationDiv = document.getElementById("confirmationDiv");
  confirmationDiv.style.display = "none";
}

function togglePaymentDetails() {
  var paymentMethod = document.getElementById("paymentMethod").value;
  var bankDetails = document.getElementById("bankDetails");
  var momoDetails = document.getElementById("momoDetails");
  var confirmButton = document.getElementById("confirmButton");

  if (paymentMethod === "transfer") {
    bankDetails.style.display = "block";
    momoDetails.style.display = "none";
    confirmButton.disabled = false; // Bật nút xác nhận
  } else if (paymentMethod === "momo") {
    bankDetails.style.display = "none";
    momoDetails.style.display = "block";
    confirmButton.disabled = true; // Vô hiệu hóa nút xác nhận
  } else {
    bankDetails.style.display = "none";
    momoDetails.style.display = "none";
    confirmButton.disabled = true; // Vô hiệu hóa nút xác nhận
  }
}
function redirectToOrdersTab() {
    // Redirect to profile.php
    window.location.href = '../database/purchase.php';
    // Wait for a short time (e.g., 500 milliseconds) before switching tabs
}

function confirmPurchase() {
    alert("Mua hàng thành công, cảm ơn quý khách");
  
    redirectToOrdersTab();
}