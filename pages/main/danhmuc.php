<?php
    $sql_product = "SELECT * FROM tbl_tensanpham WHERE tbl_tensanpham.id_danhmuc='$_GET[id]' ORDER BY id_sanpham DESC";
    $query_product = mysqli_query($mysqli,$sql_product);
    //GET tendanhmuc
    $sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc='$_GET[id]' LIMIT 1";
    $query_cate = mysqli_query($mysqli,$sql_cate);
    $row_title = mysqli_fetch_array($query_cate);
?>
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
<h3>Danh mục sản phẩm: <?php echo $row_title['tendanhmuc'] ?></h3>
    <ul class="product_list">
        <?php
        while($row_product= mysqli_fetch_array($query_product)){
        ?>
        <li> 
            <a href="index.php?quanly=sanpham&id=<?php echo $row_product['id_sanpham'] ?>">
                <img src="admin/modules/quanlysp/uploads/<?php echo $row_product['hinhanh'] ?>">  
                <p class="title_product">Tên sản phẩm: <?php echo $row_product['tensanpham'] ?></p>
                <p class="price_product">Giá: <?php echo $row_product['giasp'] ?></p>
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