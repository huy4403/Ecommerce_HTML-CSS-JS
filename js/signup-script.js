function validateEmail(email) {
  // Regular expression pattern for email validation
  var pattern = /^[^\s@]+@gmail\.com$/;

  // Use the test() method to check if the email matches the pattern
  if (!pattern.test(email)) {
    return false; // Invalid email
  } else {
    return true; // Valid email
  }
}
function kiem_tra() {
  let testerror = false;
  let name = document.getElementById('ten').value;
  let address = document.getElementById('address').value;
  //So dien thoai
  let tel = document.getElementById('tel').value;
  if (tel.length == 0) {
    document.getElementById('empty-number').innerHTML = 'Vui lòng nhập tên đăng nhập';
    testerror = true;
  }
  else {
      document.getElementById('empty-number').innerHTML = ' ';
  }

  let mail = document.getElementById('email').value;
  if (mail.length == 0) {
    document.getElementById('empty-email').innerHTML = 'Vui lòng nhập email';
    testerror = true;
  }
  else {
    if (!validateEmail(mail)) {
      document.getElementById('empty-email').innerHTML = 'Email không hợp lệ';
      testerror = true;
    }
    else {
      document.getElementById('empty-email').innerHTML = ' ';
    }
  }
  //Mat khau
  let password = document.getElementById('mat_khau').value;
  if (password.length == 0) {
    document.getElementById('empty-password').innerHTML = 'Vui lòng nhập mật khẩu';
    testerror = true;
  }
  else {
    if (password.length < 8 || password.length > 12) {
      document.getElementById('empty-password').innerHTML = 'Mật khẩu phải từ 8 - 12 ký tự';
      testerror = true;
    }
    else {
      document.getElementById('empty-password').innerHTML = ' ';
    }
  }
  // 
  let password2 = document.getElementById('mat_khau2').value;
  if (password2.length == 0) {
    document.getElementById('empty-password2').innerHTML = 'Vui lòng xác nhận mật khẩu';
    testerror = true;
  }
  else {
    if (password != password2) {
      document.getElementById('empty-password2').innerHTML = 'Mật khẩu không khớp';
      testerror = true;
    }
    else {
      document.getElementById('empty-password2').innerHTML = ' ';
    }
  }

  if (testerror) {
    return false;
  } else {
    fetch('../database/signup-save.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `tel=${tel}&name=${name}&email=${email}&address=${address}&password=${password}`, // Fixed missing equal sign and used correct variables
    })
      .then(response => response.text())
      .then(data => {
        if (data === "Đăng ký thành công!") {
          // Đăng nhập thành công, chuyển hướng đến trang chính
          document.getElementById('empty-number-password').innerHTML = data;
        }
        else {
          // Đăng nhập không thành công, hiển thị thông báo lỗi
          document.getElementById('empty-number-password').innerHTML = data;
          document.getElementById('tel').value = "";
          document.getElementById('email').value = "";
          document.getElementById('mat_khau').value = "";
          document.getElementById('mat_khau2').value = ""; // Fixed incorrect id used for password input
        }
      });
  }
  return false;
}
//An-hien mat khau
function show_password() {
  let password_input = document.getElementById("mat_khau");
  const showBtn = document.querySelector("span i");
  if (password_input.type === "password") {
    password_input.type = "text";
  }
  else {
    password_input.type = "password";
  }
}
function show_password2() {
  let password_input2 = document.getElementById("mat_khau2");
  const showBtn2 = document.querySelector("span i");
  if (password_input2.type === "password") {
    password_input2.type = "text";
  }
  else {
    password_input2.type = "password";
  }
}
//An nut Dang ki
const agreeCheckbox = document.getElementById('agree');
const submitButton = document.getElementById('submit');
document.getElementById('empty-agree').innerHTML = 'Vui lòng xác nhận đồng ý với chính sách bảo mật';
agreeCheckbox.addEventListener('change', function () {
  submitButton.disabled = !this.checked;
  submitButton.style.pointerEvents = this.checked ? 'auto' : 'none';
  if (!this.checked) {
    // Hiển thị thông báo yêu cầu
    document.getElementById('empty-agree').innerHTML = 'Vui lòng xác nhận đồng ý với chính sách bảo mật';
  } else {
    document.getElementById('empty-agree').innerHTML = '';
  }

});