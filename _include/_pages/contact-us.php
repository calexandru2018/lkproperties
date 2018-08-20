<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/brands.css" integrity="sha384-nT8r1Kzllf71iZl81CdFzObMsaLOhqBU1JD2+XoAALbdtWaXDOlWOZTR4v1ktjPE" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">

<div class="custom-container mb-5 pb-5 px-4 px-md-2 rounded text-muted">
    <div class="row">
        <div class="col-12">
            <h2><?php echo $lang['contactUs']['question'];?></h2>
            <p class="text-justify">
                <?php echo $lang['contactUs']['answer'];?>
            </p>
        </div>
        <div class="col-12">
            <form>
                <div class="form-row py-2 rounded">
                    <div class="col-12 py-2">
                        <label for="exampleFormControlTextarea1">*<?php echo $lang['contactUs']['describe'];?></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="col-12 py-2">
                            <label for="subject">*<?php echo $lang['contactUs']['subject'];?></label>
                            <input type="email" class="form-control" id="subject" aria-describedby="emailHelp" placeholder="<?php echo $lang['placeHolder']['subjectQuestion'];?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">Give us a heads up about your question.</small> -->
                    </div>
                    <div class="col-12 col-sm-6 pb-2 py-sm-0">
                        <label for="name">*<?php echo $lang['contactUs']['name'];?></label>
                        <input type="text" class="form-control" id="name" placeholder="<?php echo $lang['placeHolder']['name'];?>">
                    </div>
                    <div class="col-12 col-sm-6 py-2 py-sm-0">
                        <label for="exampleInputEmail1">*<?php echo $lang['contactUs']['email'];?></label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $lang['placeHolder']['email'];?>">
                        <small id="emailHelp" class="form-text text-white">*<?php echo $lang['contactUs']['infoSharing'];?></small>
                    </div>
                    <div class="col-12 py-2">
                        <p class="p-0 small float-left"><?php echo $lang['contactUs']['obligatory'];?>.</p>
                        <button type="submit" class="btn btn-info float-right"><?php echo $lang['placeHolder']['sendQuestion'];?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row my-md-5 py-4 py-md-2">        
        <div class="col-12">
            <h2><?php echo $lang['contactUs']['feedbackQuestion'];?></h2>
            <p class="text-justify">
                <?php echo $lang['contactUs']['feedbackAnswer'];?>
            </p>
        </div>
        <div class="col-12 col-md-6">
            <form>
                <div class="form-row py-2 rounded">
                    <div class="col-12 py-2">
                        <label for="exampleFormControlTextarea1">*<?php echo $lang['contactUs']['describe'];?></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="col-12 py-2">
                            <label for="subject"><?php echo $lang['contactUs']['subject'];?>(<?php echo $lang['placeHolder']['optional'];?>)</label>
                            <input type="email" class="form-control" id="subject" aria-describedby="emailHelp" placeholder="<?php echo $lang['placeHolder']['subjectFeedback'];?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">Give us a heads up about your question.</small> -->
                    </div>
                    <div class="col-12 col-sm-6 pb-2 py-sm-0">
                        <label for="name"><?php echo $lang['contactUs']['name'];?>(<?php echo $lang['placeHolder']['optional'];?>)</label>
                        <input type="text" class="form-control" id="name" placeholder="<?php echo $lang['placeHolder']['name'];?>">
                    </div>
                    <div class="col-12 col-sm-6 py-2 py-sm-0">
                        <label for="exampleInputEmail1">*<?php echo $lang['contactUs']['email'];?></label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $lang['placeHolder']['email'];?>">
                        <small id="emailHelp" class="form-text text-white">*<?php echo $lang['contactUs']['infoSharing'];?>.</small>
                    </div>
                    <div class="col-12 py-2">
                        <p class="p-0 small float-left"><?php echo $lang['contactUs']['obligatory'];?>.</p>
                        <button type="submit" class="btn btn-info float-right"><?php echo $lang['placeHolder']['sendFeedback'];?></button>
                    </div>
                </div>
            </form>
        </div>  
        <div class="col-12 col-md-6 pb-5 pb-md-0">
            <div class="row h-100">
                <div class="col-12">
                    <div class="row mx-2 pb-md-3 h-100 text-center">
                        <div class="col-12 col-md-6 pt-1 pb-2">
                            <a href="https://www.facebook.com/gerencialiliaungureanu/" target="_new">
                            <i class="fab fa-facebook fa-10x"></i>
                            </a>
                        </div>
                        <div class="col-12 col-md-6 pt-1 pb-2">
                            <a href="https://www.instagram.com/" target="_new">
                                <i class="fab fa-instagram fa-10x"></i>
                            </a>
                        </div>
                        <div class="col-12 col-md-6 pt-1 pb-2 pt-md-5">
                            <a href="https://www.twitter.com/" target="_new">
                                <i class="fab fa-twitter-square fa-10x"></i>
                            </a>
                        </div>
                        <div class="col-12 col-md-6 pt-1 pb-2 pt-md-5">
                            <a href="https://www.linkedin.com/" target="_new">
                                <i class="fab fa-linkedin fa-10x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row my-md-5 pt-5 pt-md-3 text-muted">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12 text-center mb-2">
                    <div class="row"></div>
                    <h3><?php echo $lang['staff']['title'];?></h3>
                </div>
                <?php 
                    $adminList = [];
                    $c = 0;
                    $query = $CONN->db->query('
                        select
                            name,
                            thumbnailURL
                        from
                            admin
                        where
                            isActive = 1
                        and
                            isPublicVisible = 1
                    ');
                    while($fetch = $query->fetch_object()){
                        $adminList[$c]['name'] = $fetch->name;
                        $adminList[$c]['url'] = $fetch->thumbnailURL;
                        $c++;
                    }
                    $colWidth = 12;
                    if($c == 2){
                        $colWidth = 6;
                    }elseif($c >= 3){
                        $colWidth = 4;
                    }
                ?>

                    <?php 
                        for($i = 0; $i < $c; $i++){
                            
                            echo'
                                <div class="col-12 col-md-'.$colWidth.' my-3">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <img src="gallery/ourstaff/'.$adminList[$i]['url'].'" alt="" class="img-thumbnail img-fluid rounded-circle contact-us-img">
                                        </div>
                                    </div>
                                    <div class="row text-center my-2">
                                        <div class="col-12">
                                            <h4>'.$adminList[$i]['name'].'</h4>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#date", {
            mode: "range",
            onChange: function(selectedDates, dateStr, instance) {
                console.log(document.querySelector("#myID").value);
            }
        });
</script>