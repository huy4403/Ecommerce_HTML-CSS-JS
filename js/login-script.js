function show_password() {
  let password_input = document.getElementById("password");
  const showBtn = document.querySelector("span i");
  if (password_input.type === "password") {
    password_input.type = "text";
  }
  else {
    password_input.type = "password";
  }
}

function validate() {
  let testerror = false;
  let telInput = document.getElementById("tel").value;
  let passwordInput = document.getElementById("password").value;
  if (telInput == 'admin' && passwordInput == '') {
    document.getElementById('empty-number').innerHTML = ' ';
    document.getElementById('empty-password').innerHTML = ' ';
    testerror = false;
  } else {
    if (telInput.length == 0 && passwordInput.length == 0) {
      document.getElementById('empty-number-password').innerHTML = 'Vui lòng nhập thông tin đăng nhập';
      testerror = true;
    } else {
      if (telInput.length == 0) {
        document.getElementById('empty-number').innerHTML = 'Vui lòng nhập tên đăng nhập';
        testerror = true;
      } else {
        document.getElementById('empty-number').innerHTML = ' ';
      }
      if (passwordInput.length == 0) {
        document.getElementById('empty-password').innerHTML = 'Vui lòng nhập mật khẩu';
        testerror = true;
      }
      else {
        if (passwordInput.length < 8 || passwordInput.length > 12) {
          document.getElementById('empty-password').innerHTML = 'Mật khẩu phải từ 8 - 12 ký tự';
          testerror = true;
        }
        else {
          document.getElementById('empty-password').innerHTML = ' ';
        }
      }
    }
  }
  if (testerror) {
    return false;
  } else {
    // Thực hiện yêu cầu POST đến trang PHP kiểm tra đăng nhập
    fetch('../database/login-save.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `tel=${telInput}&password=${passwordInput}`,
    })
      .then(response => response.text())
      .then(data => {
        if (data === "Đăng nhập thành công!") {
          // Đăng nhập thành công, chuyển hướng đến trang chính
          window.location.href = "../view/trangchu.php";
        } else if (data === "Đăng nhập thành công admin!") {
          // Đăng nhập thành công, chuyển hướng đến trang chính
          window.location.href = "../view/admin-panel.php";
        }
        else {
          // Đăng nhập không thành công, hiển thị thông báo lỗi
          document.getElementById('empty-number-password').innerHTML = data;
          document.getElementById('tel').value = "";
          document.getElementById('password').value = "";
        }
      });
  }
  return false;
}