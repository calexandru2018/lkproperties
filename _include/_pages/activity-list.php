<?php 
    $new = new Activity($CONN->db);

    $fetched = $new->fetchAll($selectedLang);
?>
    <div class="custom-container mb-5 pb-5 px-4 px-md-2 rounded text-muted">
        <div class="row">
            <div class="col-12 mb-1">
                <div class="p-0">
                    <h1>Algarve</h1>
                    <p class="text-justify mb-0">
                        <?php echo $lang['activities']['info'];?>
                    </p>
                </div>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="row">
            <?php
                $c = 0;
                $showImages = '';
                for($c = 0; $c < count($fetched); $c++){
                    if($c == 0 || $c % 2 == 0){
                        // $showImages = $showImages.'open div-';
                        $showImages = $showImages.'
                            <br/><div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="col-12">
                                        <h2>'.$fetched[$c][0].'</h2>
                                        <figure class="figure mb-2">
                                            <img src="gallery/activity/'.$fetched[$c][3].'/fullsize/'.$fetched[$c+1][0].'" class="figure-img img-fluid rounded shadow-sm" alt="A generic square placeholder image with rounded corners in a figure.">
                                            <!--<figcaption class="figure-caption">A caption for the above image.</figcaption>-->
                                        </figure>
                                        <div class="text-justify">
                                            '.$fetched[$c][1].'
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <section class="gallery-block grid-gallery py-0 text-center">
                                            <div class="row">
                        ';
                    }else{
                        for($c2 = 0; $c2 < count($fetched[$c]); $c2++){ 
                            $showImages = $showImages.'
                                                <div class="col-4 item">
                                                    <a class="lightbox" href="gallery/activity/'.$fetched[$c-1][3].'/fullsize/'.$fetched[$c][$c2].'">
                                                        <img class="img-fluid image scale-on-hover" src="gallery/activity/'.$fetched[$c-1][3].'/thumbnail/'.$fetched[$c][$c2].'">
                                                    </a>
                                                </div>';
                        }
                        $showImages = $showImages.'
                                            </div> 
                                        </section>
                                    </div>
                                </div>
                            </div
                        ';
                    }
                } 
                echo $showImages;
            ?>
    </div>
    <script>
        baguetteBox.run('.gallery-block');
    </script>
<?php  ?>