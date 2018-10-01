<?php 
    $query = $CONN->db->query('
        select 
            mainImageURL
        from
            webpage
    ');
    $fetch = $query->fetch_object();
?> 
<div class="custom-container mb-4 mb-md-3 my-md-2 px-4 px-md-2 text-center" style="box-shadow: 0px 33px 10px -30px black">
    <img class="img-fluid rounded" src="<?php echo $GLOBALS['absPath'];?>gallery/main/fullsize/<?php echo $fetch->mainImageURL; ?>" alt="Home page image" id="home-page-image" />
</div>