<?php
if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);
    $sql = "SELECT * FROM product WHERE category_id = $category_id ORDER BY product_id DESC";
    $query = mysqli_query($mysqli, $sql);
    // Lấy tên danh mục
    $sql_cat = "SELECT category_name FROM category WHERE category_id = $category_id LIMIT 1";
    $query_cat = mysqli_query($mysqli, $sql_cat);
    $cat_name = '';
    if ($row_cat = mysqli_fetch_assoc($query_cat)) {
        $cat_name = $row_cat['category_name'];
    }
    echo '<h2 class="h3 pd-top">Danh mục: ' . htmlspecialchars($cat_name) . '</h2>';
    echo '<div class="row">';
    $count = 0;
    while ($row = mysqli_fetch_array($query)) {
        $count++;
        echo '<div class="col" style="--w-md: 3">';
        echo '  <div class="product__card">';
        echo '    <a href="index.php?page=product_detail&product_id=' . $row['product_id'] . '">';
        echo '      <img class="w-100 d-block object-fit-cover" src="admin/modules/product/uploads/' . $row['product_image'] . '" alt="' . htmlspecialchars($row['product_name']) . '" />';
        echo '      <h3 class="product__name">' . htmlspecialchars($row['product_name']) . '</h3>';
        echo '      <div class="product__price">' . number_format($row['product_price']) . ' ₫</div>';
        echo '    </a>';
        echo '  </div>';
        echo '</div>';
    }
    if ($count == 0) {
        echo '<div class="col-12"><p>Không có sản phẩm nào trong danh mục này.</p></div>';
    }
    echo '</div>';
} else {
    echo '<p>Không tìm thấy danh mục sản phẩm.</p>';
} 