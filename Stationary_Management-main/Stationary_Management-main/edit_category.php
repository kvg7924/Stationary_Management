}
    // edit category
    if(isset($_POST['update_category'])){
        $category_title = $_POST['category_title'];
        // check empty fields 
        if(empty($category_title)){
            echo "<script>window.alert('Please fill the field');</script>";
        }else{
            // update query 
            $update_category_query = "UPDATE `categories` SET category_title='$category_title' WHERE category_id = $edit_id";
            $update_category_result = mysqli_query($con,$update_category_query);
            if($update_category_result){
                echo "<script>window.alert('Category updated successfully');</script>";
                echo "<script>window.open('./index.php?view_categories','_self');</script>";
            }
        }
    }
    ?>