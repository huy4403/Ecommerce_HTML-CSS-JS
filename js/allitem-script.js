// scroll header
var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("header").classList.remove("hidden");
  } else {
    document.getElementById("header").classList.add("hidden");
  }
  prevScrollpos = currentScrollPos;
};
//header hienthi dropdown
function showProduct() {
  var product = document.getElementById("product");
  var hidden = document.getElementById("hidden-clothes");
  var hidden2 = document.getElementById("hidden-account");
  if (product.style.display === "none") {
    product.style.display = "block";
    hidden.style.right = "500px";
    hidden2.style.right = "290px";
  } else {
    product.style.display = "none";
    hidden.style.right = "300px";
    hidden2.style.right = "90px";
  }
}
//click-image
const activeImage = document.querySelector(".img-main img");
const productImages = document.querySelectorAll(".img-extra img");
function changeImage(e) {
  activeImage.src = e.target.src;
}
productImages.forEach((image) => image.addEventListener("click", changeImage));


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

function confirmPurchase() {
  var form = document.getElementById('purchaseForm');

        // Lấy giá trị từ các trường trong form
        var size = form.elements['size'].value;
        var quantity = form.elements['quantity'].value;
        var urlParams = new URLSearchParams(window.location.search);
        var idsp = urlParams.get('idsp');
        var formData = new FormData(form);
        formData.append('idsp', idsp);

        fetch('../database/purchase-direct.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.text())  // Nếu server trả về JSON
        .then(data => {
            // Xử lý kết quả từ server (nếu cần)
            if (data === "succes") {
              alert("Mua hàng thành công, cảm ơn quý khách");
              window.location.href = "../view/profile.php?purchase";
            }else {
              alert(data);
              hideConfirmation();
            }
        })
      };

//size-chart
function openSizeChart() {
  var open = document.getElementById("show-size-chart");
  open.style.display = "block";
}
function closeSizeChart() {
  var close = document.getElementById("show-size-chart");
  close.style.display = "none";
}
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