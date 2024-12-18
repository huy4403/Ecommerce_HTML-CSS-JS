
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
tabs.forEach((tab) => {
  tab.onclick = function () {
    // Lưu trữ tab và pane đang active trước khi xóa các lớp active
    const prevActiveTab = $(".tab-item.active");

    // Xóa tất cả các lớp active
    prevActiveTab.classList.remove("active");

    // Thêm lớp active cho tab và pane được chọn
    this.classList.add("active");

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


// Xử lý sự kiện khi nhấn nút quay lại đầu trang
document.getElementById("scrollToTopButton").addEventListener("click", function() {
  document.body.scrollTop = 0; // Safari
  document.documentElement.scrollTop = 0; // Chrome, Firefox, IE, Opera
});
// JavaScript function to handle onchange event of the select element
function changeSort(optionValue) {
  window.location.href = '../view/admin-panel.php?pg=qldh&sort=' + optionValue;
}
function updateVanchuyen(ID){
  alert("Cập nhật tình trạng vận chuyển đơn hàng " + ID + " thành công!");
}
function changeSortsp(optionValue) {
  window.location.href = '../view/admin-panel.php?pg=listsp&sortsp=' + optionValue;
}

if (window.location.href.includes("../view/admin-panel.php?sortsp=" + optionValue)) {
  var qlysanphamTab = document.getElementById('qlysanpham');
  qlysanphamTab.click();
}

function uppdateKH() {
  alert("Cập nhật khách hàng thành công");
}

function SortLoaiTime(loaiSortValue, timeSortValue) {
  
  // Redirect to the desired URL with the selected values
  window.location.href = '../view/admin-panel.php?pg=thongke&loai_sort=' + loaiSortValue + '&time_sort=' + timeSortValue;
}
function isInteger(str) {
  return /^\d+$/.test(str);
}
function kiemTraChuoi(chuoi) {
  // Sử dụng biểu thức chính quy để kiểm tra xem chuỗi có số nguyên và ít nhất một dấu phẩy không
  var regex = /^-?\d+,\d*$/;
  return regex.test(chuoi);
}
function addSP(){
  let testerror = false
  let name = document.getElementById("name").value;
  let masp = document.getElementById("masp").value;
  let color = document.getElementById("color").value;
  let soluong = document.getElementById("soluong").value;
  let gianhap = document.getElementById("gianhap").value;
  let giaban = document.getElementById("giaban").value;
  let img1 = document.getElementById("img1").value;
  let img2 = document.getElementById("img2").value;
  let img3 = document.getElementById("img3").value;
  let img4 = document.getElementById("img4").value;
  let img5 = document.getElementById("img5").value;
  let ghichu = document.getElementById("ghichu").value;
  let iddm = document.getElementById("iddm").value;
  //Check mã sản phẩm
  if(masp.length == 0){
    document.getElementById('empty-masp').innerHTML = 'Vui lòng nhập mã sản phẩm';
    testerror = true;
  }else{
    document.getElementById('empty-masp').innerHTML = ' ';
  }
  //Cái này là check null số lượng thôi
  if(soluong.length == 0){
    document.getElementById('empty-soluong').innerHTML = 'Vui lòng nhập số lượng';
    testerror = true;
  }else{
    if(isInteger(soluong)){
      if(soluong.length > 3){
        document.getElementById('empty-soluong').innerHTML = 'Số lượng tối đa có thể nhập là 999';
        testerror = true;
      }else{
        document.getElementById('empty-soluong').innerHTML = ' ';
      }
    }else{
      document.getElementById('empty-soluong').innerHTML = 'Vui lòng nhập đúng định dạng số lượng';
      testerror = true;
    }
  }
  if(img1 == ''){
    document.getElementById('empty-img1').innerHTML = 'Ảnh 1 bắt buộc phải có';
    testerror = true;
  }else{
    document.getElementById('empty-img1').innerHTML = '';
  }
  if(name.length == 0){
    document.getElementById('empty-tenhang').innerHTML = 'Vui lòng nhập tên hàng';
    testerror = true;
  }else{
      document.getElementById('empty-tenhang').innerHTML = ' ';
  }
  if(color.length == 0){
    document.getElementById('empty-mausac').innerHTML = 'Vui lòng nhập màu';
    testerror = true;
  }else{
      document.getElementById('empty-mausac').innerHTML = ' ';
  }
  //Check giá nhập
  if(gianhap.length == 0){
    document.getElementById('empty-gianhap').innerHTML = 'Vui lòng nhập giá nhập';
    testerror = true;
  }else{
    if(isInteger(gianhap)){
      document.getElementById('empty-gianhap').innerHTML = ' ';
    }else{
      document.getElementById('empty-gianhap').innerHTML = 'Vui lòng nhập đúng định dạng giá nhập';
      testerror = true;
    }
  }
  //Check giá bán
  if(giaban.length == 0){
    document.getElementById('empty-giaban').innerHTML = 'Vui lòng nhập giá bán';
    testerror = true;
  }else{
    if(isInteger(giaban)){
      document.getElementById('empty-giaban').innerHTML = ' ';
    }else{
      document.getElementById('empty-giaban').innerHTML = 'Vui lòng nhập đúng định dạng giá bán';
      testerror = true;
    }
  }
  if(testerror){
    return false;
  }else{
  fetch('../database/admin-insert.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `name=${name}&masp=${masp}&color=${color}&soluong=${soluong}&gianhap=${gianhap}&giaban=${giaban}&img1=${img1}&img2=${img2}&img3=${img3}&img4=${img4}&img5=${img5}&ghichu=${ghichu}&iddm=${iddm}`,
  })
    .then(response => response.text())
    .then(data => {
      if (data === "Thêm thành công sản phẩm") {
        document.getElementById('empty').innerHTML = data;
      }
      else {
        // Đăng nhập không thành công, hiển thị thông báo lỗi
        document.getElementById('empty').innerHTML = data;
      }
    });
  }
  return false;
}

function updateSP(){
  let testerror = false
  let name = document.getElementById("name").value;
  let id = document.getElementById("id").value;
  let masp = document.getElementById("masp").value;
  let color = document.getElementById("color").value;
  let soluong = document.getElementById("soluong").value;
  let gianhap = document.getElementById("gianhap").value;
  let giaban = document.getElementById("giaban").value;
  let img1 = document.getElementById("img1").value;
  let img2 = document.getElementById("img2").value;
  let img3 = document.getElementById("img3").value;
  let img4 = document.getElementById("img4").value;
  let img5 = document.getElementById("img5").value;

  let oldimg1 = document.getElementById("old_img1").value;
  let oldimg2 = document.getElementById("old_img2").value;
  let oldimg3 = document.getElementById("old_img3").value;
  let oldimg4 = document.getElementById("old_img4").value;
  let oldimg5 = document.getElementById("old_img5").value;

  let ghichu = document.getElementById("ghichu").value;
  let iddm = document.getElementById("iddm").value;
  //Check mã sản phẩm
  if(masp.length == 0){
    document.getElementById('empty-masp').innerHTML = 'Vui lòng nhập mã sản phẩm';
    testerror = true;
  }else{
    document.getElementById('empty-masp').innerHTML = ' ';
  }
  //Cái này là check null số lượng thôi
  if(soluong.length == 0){
    document.getElementById('empty-soluong').innerHTML = 'Vui lòng nhập số lượng';
    testerror = true;
  }else{
    if(isInteger(soluong)){
      if(soluong.length > 3){
        document.getElementById('empty-soluong').innerHTML = 'Chỉ nhập được tối đa 999 sản phẩm 1 lần';
        testerror = true;
      }else{
        document.getElementById('empty-soluong').innerHTML = ' ';
      }
    }else{
      document.getElementById('empty-soluong').innerHTML = 'Vui lòng nhập đúng định dạng số lượng';
      testerror = true;
    }
  }

  if(name.length == 0){
    document.getElementById('empty-tenhang').innerHTML = 'Vui lòng nhập tên hàng';
    testerror = true;
  }else{
      document.getElementById('empty-tenhang').innerHTML = ' ';
  }
  if(color.length == 0){
    document.getElementById('empty-mausac').innerHTML = 'Vui lòng nhập màu';
    testerror = true;
  }else{
      document.getElementById('empty-mausac').innerHTML = ' ';
  }
  //Check giá nhập
  if(gianhap.length == 0){
    document.getElementById('empty-gianhap').innerHTML = 'Vui lòng nhập giá nhập';
    testerror = true;
  }else{
    if(kiemTraChuoi(gianhap)){
      document.getElementById('empty-gianhap').innerHTML = ' ';
    }else{
      document.getElementById('empty-gianhap').innerHTML = 'Vui lòng nhập đúng định dạng giá nhập';
      testerror = true;
    }
  }
  //Check giá bán
  if(giaban.length == 0){
    document.getElementById('empty-giaban').innerHTML = 'Vui lòng nhập giá bán';
    testerror = true;
  }else{
    if(isInteger(giaban)){
      document.getElementById('empty-giaban').innerHTML = ' ';
    }else{
      document.getElementById('empty-giaban').innerHTML = 'Vui lòng nhập đúng định dạng giá bán';
      testerror = true;
    }
  }

  if(img1 == ''){
    img1 = oldimg1;
  }
  if(img2 == ''){
    img2 = oldimg2;
  }
  if(img3 == ''){
    img3 = oldimg3;
  }
  if(img4 == ''){
    img4 = oldimg4;
  }
  if(img5 == ''){
    img5 = oldimg5;
  }

  if(testerror){
    return false;
  }else{
  fetch('../database/admin-update-sanpham.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `name=${name}&masp=${masp}&color=${color}&soluong=${soluong}&gianhap=${gianhap}&giaban=${giaban}&img1=${img1}&img2=${img2}&img3=${img3}&img4=${img4}&img5=${img5}&ghichu=${ghichu}&iddm=${iddm}&id=${id}`,
  })
    .then(response => response.text())
    .then(data => {
      if (data === "Sửa thành công sản phẩm") {
        document.getElementById('empty').innerHTML = data;
      }
      else {
        // Đăng nhập không thành công, hiển thị thông báo lỗi
        document.getElementById('empty').innerHTML = data;
      }
    });
  }
  return false;
}