<p>Giỏ hàng
    <?php
    if(isset($_SESSION['dangky'])){
        echo 'xin chào: '.'<span style="color:red">'.$_SESSION['dangky'].'</span>';
    }
    ?>
</p>

<?php
    if(isset($_SESSION['cart'])){
        
    }
?>
<table style="width:100%; text-align:center;border-collapse:collapse" border="1">
    <tr>
        <th>ID</th>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Giá sản phẩm</th>
        <th>Thành tiền</th>
        <th>Quản lý</th>
    </tr>
    <?php
    if(isset($_SESSION['cart'])){
        $i = 0;
        $tongtien=0;
        foreach($_SESSION['cart'] as $cart_item){
            $thanhtien=$cart_item['soluong']*$cart_item['giasp'];
            $tongtien += $thanhtien;
            $i++;
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $cart_item['masp']; ?></td>
        <td><?php echo $cart_item['tensanpham']; ?></td>
        <td><img src="admin/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'];?>" style="width:50px" ></td>
        <td>
            <a style="text-decoration:none" href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>">+</a>
            <?php echo $cart_item['soluong']; ?>
            <a style="text-decoration:none" href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>">-</a>
        </td>
        <td><?php echo $cart_item['giasp']; ?></td>
        <td><?php echo $thanhtien; ?></td>
        <td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>">Xóa</a></td>
    </tr>
    <?php
        }
    ?>
    <tr>
        <td colspan="8">
            <p>Tổng tiền <?php echo $tongtien; ?></p>
            <p><a href="pages/main/themgiohang.php?xoatatca=1">Xóa tất cả</a></p>
            <?php
                if(isset($_SESSION['dangky'])){
            ?>
                <p><a href="pages/main/thanhtoan.php">Đặt hàng</a></p>
            <?php
                }else{
            ?>
                <p><a href="index.php?quanly=dangky">Đăng ký để đặt hàng</a></p>
            <?php 
                }
            ?>
        </td>
    </tr>
    <?php
    }else{
    ?>
    <tr>
        <td colspan="8"><p>Hiện tại giỏ hàng trống</p></td>
    </tr>
    <?php
    }
    ?>
</table> 