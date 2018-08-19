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
    <img class="img-fluid rounded" src="gallery/main/" alt="Home page image" id="home-page-image" />
    <!-- 
    Use this in case images are not gonna get cropped    
    <div class="center-cropped" 
        style="background-image: url('assets/img/1.jpg');">
        <img class="testImg" src="assets/img/1.jpg" alt="Card image" />
    </div> -->
</div>
<script>
let w=window,
    d=document,
    e=d.documentElement,
    g=d.getElementsByTagName('body')[0],
    x=w.innerWidth||e.clientWidth||g.clientWidth,
    y=w.innerHeight||e.clientHeight||g.clientHeight;

    $( document ).ready(function() {

        var imgURL = '<?php echo $fetch->mainImageURL; ?>';
        var img = document.querySelector('#home-page-image');
        var orgSrc = img.src;
        var baseUrl = orgSrc.substring(0, orgSrc.indexOf("main/"));

        if (x <= 860) {      
            var dynamicLoaded = baseUrl + 'main/mobile/' + imgURL;
            img.src = dynamicLoaded;
            console.log(dynamicLoaded);
        }else{
            var dynamicLoaded = baseUrl + 'main/fullsize/' + imgURL;
            img.src = dynamicLoaded;
            console.log(dynamicLoaded);
        }
    });

</script>   