<?php
    session_start();
    include('../../admin/config/config.php');
    //them so luong
    if(isset($_GET['cong'])){
        $id=$_GET['cong'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$cart_item['soluong'],
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                        $_SESSION['cart'] = $product;
            }else{
                $tangsoluong=$cart_item['soluong'] + 1;
                if($cart_item['soluong']<=10){
                    $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$tangsoluong,
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                }else{
                    $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$cart_item['soluong'],
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                }
                $_SESSION['cart'] = $product;
            }
            header('Location:../../index.php?quanly=giohang');
        }
    }
    //tru so luong
    if(isset($_GET['tru'])){
        $id=$_GET['tru'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$cart_item['soluong'],
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                        $_SESSION['cart'] = $product;
            }else{
                $tangsoluong=$cart_item['soluong'] - 1;
                if($cart_item['soluong']>1){
                    $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$tangsoluong,
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                }else{
                    $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$cart_item['soluong'],
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                }
                $_SESSION['cart'] = $product;
            }
            header('Location:../../index.php?quanly=giohang');
        }
    }
    //xoa san pham
    if(isset($_SESSION['cart'])&&isset($_GET['xoa'])){
        $id=$_GET['xoa'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$cart_item['soluong'],
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
            }
        $_SESSION['cart'] = $product;
        header('Location:../../index.php?quanly=giohang');
        }
    }
    //xoa tat ca
    if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
        unset($_SESSION['cart']);
        header('Location:../../index.php?quanly=giohang');
    }
    //them san pham
    if(isset($_POST['themgiohang'])){
        /* session_destroy(); */
        $soluong=1;
        $id=$_GET['id_sanpham'];
        $sql = "SELECT * FROM tbl_tensanpham WHERE id_sanpham ='".$id."' LIMIT 1";
        $query = mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($query);
        if($row){
            $new_product=array(array('tensanpham'=>$row['tensanpham'],'id'=>$id,'masp'=>$row['masp'],'soluong'=>$soluong,
            'giasp'=>$row['giasp'],'hinhanh'=>$row['hinhanh']));
            //kiem tra session gio hang ton tai hay chua
            if(isset($_SESSION['cart'])){
                $found=false;
                foreach($_SESSION['cart'] as $cart_item){
                    //neu du lieu trung
                    if($cart_item['id']==$id){
                        $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$soluong,
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                        $found=true;
                    }else{
                        // neu du lieu ko trung
                        $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'masp'=>$cart_item['masp'],'soluong'=>$cart_item['soluong'],
                        'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh']);
                    }
                }
                if($found==false){
                    // lien ket du lieu moi voi du lieu cu
                    $_SESSION['cart'] = array_merge($product,$new_product);
                }else{
                    $_SESSION['cart'] = $product;
                }
            }else{
                $_SESSION['cart']=$new_product;
            }
        }
        header('Location:../../index.php?quanly=giohang');
    }  
?>