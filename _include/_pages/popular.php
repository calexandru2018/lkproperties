<?php 
    include('_include/_models/popular.php');
    $new = new Popular($CONN->db);
    if(isset($_GET['show']) && ($_GET['show'] == 'popular-city' || $_GET['show'] == 'popular-poi')){
        if($_GET['show'] == 'popular-city')
            $cat = 'city';
        else    
            $cat = 'poi';

        $fetched = $new->fetchSingle($cat,(int)$_GET['id'], $_GET['lang']);
        $gallery = $new->fetchGallery($cat,(int)$_GET['id']);
        // print_r($gallery);
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />

    <div class="custom-container mx-sm-auto px-4 px-md-2 rounded text-muted">
        <div class="d-flex flex-column">
            <div class="py-2">
                <figure class="figure">
                    <img src="gallery/<?php echo $cat.'/'.$fetched[4].'/fullsize/'.$fetched[3];?>" class="figure-img img-fluid rounded" style="box-shadow: 0px 33px 10px -30px black" alt="A generic square placeholder image with rounded corners in a figure.">
                    <!-- <figcaption class="figure-caption px-1"></figcaption> -->
                </figure>
            </div>
            <div class="px-0 py-2">
                <h1><?php echo $fetched[1]; ?></h1>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-12 col-md-8">
                    <h4><?php echo $lang['generalFiller']['title'];?></h4>
                    <p class="text-justify">
                        <?php echo $fetched[2]; ?>
                    </p>
                </div>
                <div class="col-12 col-md-4">
                    <h4><?php echo $lang['generalFiller']['video'];?></h4>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/5EwJEfXcY04"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="gallery-block grid-gallery mb-5 pb-5 px-2 px-md-0 text-muted">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="heading mb-2  text-left">
                        <h4><?php echo $lang['generalFiller']['gallery'];?></h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    for($c = 0; $c < count($gallery); $c++){
                        echo '
                            <div class="col-md-6 col-lg-4 item text-center">
                                <a class="lightbox" href="gallery/'.$cat.'/'.$fetched[4].'/fullsize/'.$gallery[$c].'">
                                    <img class="img-fluid image scale-on-hover" src="gallery/'.$cat.'/'.$fetched[4].'/thumbnail/'.$gallery[$c].'">
                                </a>
                            </div>
                        ';
                    }
                ?>
                <!-- <div class="col-md-6 col-lg-4  item">
                    <a class="lightbox" href="assets/img/image1.jpg">
                        <img class="img-fluid image scale-on-hover" src="assets/img/image1.jpg">
                    </a>
                </div> -->
            </div>
        </div>
    </section>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.gallery-block');
    </script>
<?php }?>