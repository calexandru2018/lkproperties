<div class="custom-container pb-4 pb-md-5 px-3 px-sm-0 rounded text-muted">
    <div class="row">
        <div class="col-12">
            <h2><?php echo $lang['contactUs']['question'];?></h2>
            <p class="text-justify">
                <?php echo $lang['contactUs']['answer'];?>
            </p>
        </div>
        <div class="col-12">
            <form data-type="4">
                <div class="form-row py-2 rounded">
                    <div class="col-12 py-2">
                        <label for="textArea">*<?php echo $lang['contactUs']['describe']; ?></label>
                        <textarea class="form-control" id="textArea" name="msg_description" rows="3" data-optional="false"></textarea>
                    </div>
                    <div class="col-12 py-2">
                        <label for="subject">*<?php echo $lang['contactUs']['subject']; ?></label>
                        <input type="text" class="form-control" name="msg_subject" id="subject" data-optional="false">
                    </div>
                    <div class="col-12 py-2">
                        <label for="subject"><?php echo $lang['contactUs']['date']; ?>(<?php echo $lang['placeHolder']['optional']; ?>)</label>
                        <input type="date" class="form-control bg-white" name="msg_date" id="date" data-optional="true">
                    </div>
                    <div class="col-12 col-sm-6 pb-2 py-sm-0">
                        <label for="name">*<?php echo $lang['contactUs']['name']; ?></label>
                        <input type="text" class="form-control" name="msg_name" placeholder="<?php echo $lang['placeHolder']['name']; ?>" data-optional="false">
                    </div>
                    <div class="col-12 col-sm-6 py-2 py-sm-0">
                        <label for="exampleInputEmail1">*<?php echo $lang['contactUs']['email']; ?></label>
                        <input type="email" class="form-control" name="msg_email" aria-describedby="emailHelp" placeholder="<?php echo $lang['placeHolder']['email']; ?>" data-optional="false">
                        <small id="emailHelp" class="form-text"><?php echo $lang['contactUs']['infoSharing']; ?></small>
                    </div>
                    <div class="col-12 py-2">
                        <p class="p-0 small float-left d-none text-danger" id="errorMessage"><?php echo $lang['contactUs']['obligatory']; ?></p>
                        <button class="btn btn-info float-right" id="send-info"><?php echo $lang['placeHolder']['sendQuestion']; ?></button>
                        <div class="cssload-container float-right pl-5 mt-3 d-none">
                            <div class="cssload-whirlpool"></div>
                        </div>
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
            <form data-type="3">
                <div class="form-row py-2 rounded">
                    <div class="col-12 py-2">
                        <label for="msg_description">*<?php echo $lang['contactUs']['describe']; ?></label>
                        <textarea class="form-control" id="textArea" name="msg_description" rows="3" data-optional="false"></textarea>
                    </div>
                    <div class="col-12 py-2">
                        <label for="msg_subject">*<?php echo $lang['contactUs']['subject'];?></label>
                        <input type="text" class="form-control" name="msg_subject" id="subject" data-optional="false">
                    </div>
                    <div class="col-12 col-sm-6 pb-2 py-sm-0">
                        <label for="msg_name">*<?php echo $lang['contactUs']['name'];?></label>
                        <input type="text" class="form-control" name="msg_name" placeholder="<?php echo $lang['placeHolder']['name']; ?>" data-optional="true">
                    </div>
                    <div class="col-12 col-sm-6 py-2 py-sm-0">
                        <label for="msg_email">*<?php echo $lang['contactUs']['email'];?></label>
                        <input type="email" class="form-control" name="msg_email" aria-describedby="emailHelp" placeholder="<?php echo $lang['placeHolder']['email']; ?>" data-optional="true">
                        <small id="emailHelp" class="form-text"><?php echo $lang['contactUs']['infoSharing'];?>.</small>
                    </div>
                    <div class="col-12 py-2">
                        <p class="p-0 small float-left d-none text-danger" id="errorMessage"><?php echo $lang['contactUs']['obligatory']; ?></p>
                        <button class="btn btn-info float-right" id="send-feedback"><?php echo $lang['placeHolder']['sendFeedback'];?></button>
                        <div class="cssload-container float-right pl-5 mt-3 d-none">
                            <div class="cssload-whirlpool"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>  
        <div class="col-12 col-md-6 px-0 pb-5 pb-md-0">
            <div class="row h-100 px-0 mx-0">
                <div class="col-12 px-0">
                    <div class="row pb-md-3 h-100 text-center mx-0">
                        <div class="col-6 pt-1 pb-2">
                            <a href="https://www.facebook.com/gerencialiliaungureanu/" target="_new">
                            <i class="fab fa-facebook fa-10x"></i>
                            </a>
                        </div>
                        <div class="col-6 pt-1 pb-2">
                            <a href="https://www.instagram.com/" target="_new">
                                <i class="fab fa-instagram fa-10x"></i>
                            </a>
                        </div>
                        <div class="col-6 pt-1 pb-2 pt-md-5">
                            <a href="https://www.twitter.com/" target="_new">
                                <i class="fab fa-twitter-square fa-10x"></i>
                            </a>
                        </div>
                        <div class="col-6 pt-1 pb-2 pt-md-5">
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
                    for($i = 0; $i < $c; $i++){
                        echo'
                            <div class="col-12 col-sm-'.(($colWidth == 4) ? 6 : $colWidth).' col-lg-'.$colWidth.' mt-3">
                                <div class="row text-center">
                                    <div class="col-12">
                                        <img src="'.$GLOBALS['absPath'].'gallery/ourstaff/'.$adminList[$i]['url'].'" alt="" class="img-thumbnail img-fluid rounded-circle contact-us-img">
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
            console.log(document.querySelector("#date").value);
        }
    });
    document.querySelector('#send-info').onclick = function(e){
        e.preventDefault();
        sendEmail(this, '<?php echo $lang['generalFiller']['messageSent']; ?>', '<?php echo $GLOBALS['absPath']; ?>');
    };
    document.querySelector('#send-feedback').onclick = function(e){
        e.preventDefault();
        sendEmail(this, '<?php echo $lang['generalFiller']['messageSent']; ?>', '<?php echo $GLOBALS['absPath']; ?>');
    };
</script>