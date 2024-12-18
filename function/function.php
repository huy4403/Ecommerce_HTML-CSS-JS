<script>
    function validateLogin(username, password) {
        if (username.length == 0 && username.length == 0) {
            document.write('Vui lòng nhập thông tin đăng nhập');
        } else {
            if (username.length == 0) {
                document.write('Vui lòng nhập tên đăng nhập');
            }
            if (password.length == 0) {
                document.write('Vui lòng nhập mật khẩu');
            } else if (password.length < 8 || passwordInput.length > 12) {

                document.write('Mật khẩu phải từ 8 - 12 ký tự');
            } else {
                document.write('Đăng nhập thành công');
            }
        }
    }
</script>