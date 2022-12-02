<?php
    if(isset($_GET['trang'])){
        $page=$_GET['trang'];
    }else{
        $page='1';
    }
    if($page==''||$page==1){
        $begin= 0;
    }else{
        $begin=($page*5)-5;
    }
    $sql_product = "SELECT * FROM tbl_tensanpham, tbl_danhmuc WHERE tbl_tensanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
    ORDER BY tbl_tensanpham.id_sanpham DESC LIMIT $begin,5";
    $query_product = mysqli_query($mysqli,$sql_product);
?>
<h3>Sản phẩm mới nhất</h3>
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
            <div style="clear:both;"></div>
            <style type="text/css">
                ul.list_trang{
                    padding:0;
                    margin:0;
                    list-style:none;
                }
                ul.list_trang li{
                    float: left;
                    padding:5px 13px;
                    margin:5px;
                    background:burlywood;
                    display:block;
                }
                ul.list_trang li a{
                    color:#000;
                    text-align:center;
                    text-decoration:none;
                }
            </style>
            <?php
            $sql_trang= mysqli_query($mysqli,"SELECT * FROM tbl_tensanpham");
            $row_count= mysqli_num_rows($sql_trang);
            $trang= ceil($row_count/5);
            ?>
            <p>Trang hiện tại: <?php echo $page ?>/<?php echo $trang ?></p>
            <ul class="list_trang">
                <?php
                for($i=1;$i<=$trang;$i++){
                ?>
                <li <?php if($i==$page){echo 'style="background:brown"';}else{echo '';} ?>><a href="index.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                }
                ?>
            </ul>