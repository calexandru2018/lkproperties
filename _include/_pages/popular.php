<?php 
    include('_include/_models/popular.php');
    $new = new Popular($CONN->db);
    if(isset($_GET['show']) && ($_GET['show'] == 'popular-city' || $_GET['show'] == 'popular-poi')){
        if($_GET['show'] == 'popular-city')
            $cat = 'city';
        else    
            $cat = 'poi';

        $fetched = $new->fetchSingle($cat,(int)$_GET['id'], $selectedLang);
        $gallery = $new->fetchGallery($cat,(int)$_GET['id']);
        $descriptionWidth = 12;
        $videoBox = '';
        // print_r($_GET);
        // print_r($fetched[0]);
?>
    <div class="custom-container mx-sm-auto px-2 pb-4 pb-md-5 rounded text-muted">
        <div class="d-flex flex-column">
            <div class="py-2">
                <figure class="figure">
                    <img src="<?php echo $GLOBALS['absPath'];?>gallery/<?php echo $cat.'/'.$fetched[4].'/fullsize/'.$fetched[3];?>" class="figure-img img-fluid rounded" style="box-shadow: 0px 33px 10px -30px black" alt="A placeholder.">
                </figure>
            </div>
            <div class="px-0 py-2">
                <h1><?php echo $fetched[1]; ?></h1>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <?php 
                    if(!empty($fetched[0])){
                        $descriptionWidth = 8;
                        $videoBox = '
                        <div class="col-12 col-md-4">
                            <h4>'.$lang['generalFiller']['video'].'</h4>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="'.$fetched[0].'"></iframe>
                            </div>
                        </div>
                        ';
                    }
                ?>
                <div class="col-12 col-md-<?php echo $descriptionWidth; ?>">
                    <h4><?php echo $lang['generalFiller']['title'];?></h4>
                    <p class="text-justify">
                        <?php echo $fetched[2]; ?>
                    </p>
                </div>
                <?php echo $videoBox; ?>
            </div>
        </div>
    </div>
    <section class="gallery-block grid-gallery pt-2 px-2 px-md-0 text-muted pb-4">
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
                    if(!empty($gallery)){
                        for($c = 0; $c < count($gallery); $c++){
                            echo '
                                <div class="col-sm-6 col-lg-4 item text-center">
                                    <a class="lightbox" href="'.$GLOBALS['absPath'].'gallery/'.$cat.'/'.$fetched[4].'/fullsize/'.$gallery[$c].'">
                                        <img class="img-fluid image scale-on-hover" src="'.$GLOBALS['absPath'].'gallery/'.$cat.'/'.$fetched[4].'/thumbnail/'.$gallery[$c].'">
                                    </a>
                                </div>
                            ';
                        }
                    }
                ?>
            </div>
        </div>
    </section>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.gallery-block');
    </script>
<?php }?>