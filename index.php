<?php
if((!empty($_GET['page']))  ||  (isset($_GET['page']))) {
    $page = $_GET['page'];
}else{
    $page = "";
}

switch ($page) {
    
    case 'lst-alu':
        include_once('views/users/admin/view-alu.php');
        break;

    case 'form-upd-files-alu':
        include_once('views/users/admin/form-upd-files-alu.php');
        break;

    case 'form-upd-alu':
        include_once('views/users/admin/form-upd-alu.php');
        break;

    case 'form-files-alu':
        include_once('views/users/client/form-files-alu.php');
        break;

    case 'form-alu':
        include_once('views/users/client/form-alu.php');
        break;    

    case 'kdx-pdf-alu':
        include_once('views/users/client/pdf.php');
        break;

    default:
        include_once('views/home/home.php');
        break;

}
?>