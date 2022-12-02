<?php
    if(isset($_POST['timkiem'])){
        $tukhoa = $_POST['tukhoa'];
    }
    $sql_product = "SELECT * FROM tbl_tensanpham,tbl_danhmuc WHERE tbl_tensanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
    AND tbl_tensanpham.tensanpham LIKE '%".$tukhoa."%'";
    $query_product = mysqli_query($mysqli,$sql_product);
?>
<h3>Tìm kiếm: <?php echo $_POST['tukhoa'] ?></h3>
            <ul class="product_list">
                <?php
                while($row=mysqli_fetch_array($query_product)){
                ?>
                <li> 
                <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                    <img src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>">  
                    <p class="title_product">Tên sản phẩm: <?php echo $row['tensanpham'] ?></p>
                    <p class="price_product">Giá: <?php echo $row['giasp'] ?></p>
                    <p style="text-align:center;color:black"><?php echo $row['tendanhmuc'] ?></p>
                </a>
                </li>
                <?php
                }
                ?>
            </ul>