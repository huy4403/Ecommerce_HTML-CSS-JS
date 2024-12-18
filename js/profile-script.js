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
//Chuyen doi cac Tabs
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);
const tabs = $$(".tab-item");
const panes = $$(".tab-pane");
const tabActive = $(".tab-item.active");
tabs.forEach((tab, index) => {
  const pane = panes[index];
  tab.onclick = function () {
    // Lưu trữ tab và pane đang active trước khi xóa các lớp active
    const prevActiveTab = $(".tab-item.active");
    const prevActivePane = $(".tab-pane.active");

    // Xóa tất cả các lớp active
    prevActiveTab.classList.remove("active");
    prevActivePane.classList.remove("active");

    // Thêm lớp active cho tab và pane được chọn
    this.classList.add("active");
    pane.classList.add("active");

    // Thay đổi màu sắc của tab cũ
    if (prevActiveTab) {
      prevActiveTab.style.backgroundColor = ""; // Đặt lại màu nền
      prevActiveTab.style.color = ""; // Đặt lại màu chữ
    }

    // Thay đổi màu sắc của tab mới và pane mới
    updateColors();
  };
});

function updateColors() {
  // Lấy tab và pane đang active
  const activeTab = $(".tab-item.active");

  // Thay đổi màu sắc
  if (activeTab) {
    activeTab.style.backgroundColor = "#000"; // Đen
    activeTab.style.color = "#fff"; // Trắng
  }
}


//Submit voucher
const discountCodeInput = document.getElementById("discount-code");
const applyButton = document.querySelector(".apply-button");
discountCodeInput.addEventListener("input", function () {
  applyButton.disabled = this.value.trim() === "";
});

function uppdateAccount() {
  alert("Cập nhật tài khoản thành công");
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

if (window.location.href.includes('profile.php?purchase')) {
  var ordersTab = document.getElementById('ordersTab');
  ordersTab.click();
}
