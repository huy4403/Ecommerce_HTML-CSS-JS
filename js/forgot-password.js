function kiem_tra() {
  // Phone number
  let testerror = false;
  let tel = document.getElementById('tel').value;
  if (tel.length == 0) {
    document.getElementById('empty-number').innerHTML = 'Vui lòng nhập số điện thoại';
    testerror = true;
  } else {
    let regex_number = /^(0|\+84|\+840|84|840)\d{9}$/;
    if (!regex_number.test(tel)) {
      document.getElementById('empty-number').innerHTML = 'Số điện thoại không hợp lệ';
      testerror = true;
    } else {
      document.getElementById('empty-number').innerHTML = ' ';
    }
  }

  if (testerror) {
    return false;
  } else {
    fetch('../database/forgot-db.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `tel=${tel}`,
    })
      .then(response => response.text())
      .then(data => {
        if (data === "Success") {
          // Đăng nhập thành công
          var confirmdmk = confirm("Vui lòng soạn tin: 'ARISTINO " + tel + " PASSWORD Gửi 113' để thay đổi mật khẩu của bạn. Bạn có muốn chuyển đến trang SMS ngay bây giờ không(Miễn phí)?");
          
          if (confirmdmk) {
            // Người dùng đồng ý, chuyển hướng đến SMS
            window.location.href = 'tel:113';
          } else {
            // Người dùng không đồng ý, có thể thực hiện các hành động khác hoặc không làm gì cả
            document.getElementById('tel').value = "";
          }
        } else {
          // Đăng nhập không thành công, hiển thị thông báo lỗi
          alert(data);
          document.getElementById('tel').value = "";
        }
      });
    
    return false;
  }
}