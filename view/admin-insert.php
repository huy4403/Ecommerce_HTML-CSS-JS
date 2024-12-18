<form class="insert-form" onsubmit="return addSP()" method="POST" align="center">
    <table>
        <tr>
            <td>
                <label for="name">Tên hàng:</label>
                <input type="text" id="name" name="name" placeholder="Tên hàng hóa">
                <div id="empty-tenhang"></div>
            </td>
            <td>
                <label for="masp">Mã SP:</label>
                <input type="text" id = "masp" name="masp" placeholder="Mã sản phẩm">
                <div id="empty-masp"></div>
            </td>
        </tr>
        <tr>
            <td>
                <label for="color">Màu sắc:</label>
                <input type="text" id = "color" name="color" placeholder="Màu sắc">
                <div id="empty-mausac"></div>
            </td>
            <td>
                <label for="gianhap">Giá nhập:</label>
                <input type="text" id = "gianhap" name="gianhap" placeholder="Giá nhập">
                <div id="empty-gianhap"></div>
            </td>
        </tr>
        <tr>
            <td>
                <label for="giaban">Giá bán:</label>
                <input type="text" id = "giaban" name="giaban" placeholder="Giá bán">
                <div id="empty-giaban"></div>
            </td>
            <td>
                <label for="soluong">Số lượng:</label>
                <input type="text" id = "soluong" name="soluong" placeholder="Số lượng">
                <div id="empty-soluong"></div>
            </td>
        </tr>
        <tr>
            <td>
                <label for="img1">Ảnh SP 1:</label>
                <input type="file" id = "img1" name="img1">
                <div id = "empty-img1"></div>
            </td>
            <td>
                <label for="img2">Ảnh SP 2:</label>
                <input type="file" id = "img2" name="img2">
            </td>
        </tr>
        <tr>
            <td>
                <label for="img3">Ảnh SP 3:</label>
                <input type="file" id = "img3" name="img3">
            </td>
            <td>
                <label for="img4">Ảnh SP 4:</label>
                <input type="file" id = "img4" name="img4">
            </td>
        </tr>
        <tr>
            <td>
                <label for="img5">Ảnh SP 5:</label>
                <input type="file" id = "img5" name="img5">
            </td>
            <td>
                <label for="ghichu">Ghi chú:</label>
                <textarea name="ghichu" id = "ghichu" placeholder="Ghi chú"></textarea>
                <div id="empty-ghichu"></div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="danhmuc">
                <label for="danhmuc">Danh mục:</label>
                <select class="choose-danhmuc" id = "iddm" name="iddm">
                    <option value="1">Áo sơ mi</option>
                    <option value="2">Áo polo</option>
                    <option value="3">Quần</option>
                    <option value="4">Suit</option>
                    <option value="5">Giảm giá</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                
        <div id="empty"></div>
                <input class="submit" id = "save" type="submit" name="save" value="Xác nhận">
            </td>
        </tr>
    </table>
</form>