<?php
function deleteImage($file, $dir, $thumb = false){
    if(file_exists(public_path().'/uploads/'.$dir.'/'.$file) && !empty($file)){
        unlink(public_path().'/uploads/'.$dir.'/'.$file);
        if(file_exists(public_path().'/uploads/'.$dir.'/Thumb-'.$file)){
            unlink(public_path().'/uploads/'.$dir.'/Thumb-'.$file);
        }
    }
}

function uploadImage($file, $dir, $thumb = null){
    // $thumb => widthXheight
    $path = public_path().'/uploads/'.$dir;
    if(!File::exists($path)){
        File::makeDirectory($path, 0777, true, true);
    }
    $file_name = ucfirst($dir)."-".date('Ymdhis').rand(0, 999).".".$file->getClientOriginalExtension();
    $success = $file->move($path, $file_name);
    if($success){
        if($thumb){
            list($width, $height) = explode("x", $thumb);
            Image::make($path."/".$file_name)->resize($width, $height, function($constraints){
                return $constraints->aspectRatio();
            })->save($path.'/Thumb-'.$file_name);
        }
        return $file_name;
    }else{
        return false;
    }
}

function getFooterPageList(){
    $page = new \App\Models\Page();
    $all_pages = $page->get();
    if ($all_pages) {
        foreach($all_pages as $page_list){
        ?>
            <li class="p-b-10">
                <a href="<?php echo route('page-detail', $page_list->slug)?>" class="stext-107 cl7 hov-cl1 trans-04">
                    <?php echo $page_list->title?>
                </a>
            </li>
        <?php
        }
    }
}

function getCategoryMenu(){
    $category = new \App\Models\Category();
    $category = $category->getAllCategories();
    if ($category->count() > 0) {
        echo '<li><a href="" class="dropbtn">Category</a><ul class="dropdown">';
        foreach ($category as $cat_info) {
            if ($cat_info->child_cats->count() > 0) {
            ?>
                <li style="width: 250px"><a href="#"><?php echo $cat_info->title?></a>
                    <ul class="dropdown-subcontent">
                        <?php
                            foreach ($cat_info->child_cats as $children) {
                        ?>
                                <li><a href="<?php echo route('child-cat-product',[$cat_info->slug, $children->slug]);?>"><?php echo $children->title?></a></li>
                        <?php
                            }
                        ?>
                    </ul>
                </li>                 
            <?php
             } else{
                echo '<li style="width: 250px"><a href="'.route('cat-product',$cat_info->slug).'">'.$cat_info->title.'</a></li>';                 
             }
        }
        echo "</ul></li>";
    }
}
