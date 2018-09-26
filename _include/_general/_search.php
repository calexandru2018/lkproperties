<?php
    /* 
        CSS is loaded on this specific page so that other pages dont load unnecessary files,
        to help speed up loading time
    */
?>  
<link rel="stylesheet" href="assets/css/range-slider.css">
<link defer href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link defer rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
<link defer rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">

<?php
    /* 
        Custom styling for this select.
    */
?>  
<style>
    .select2, .select2-container, .select2-container--default, .select2-container--below{
        max-width: 950px !important;
    }
    .select2-selection, .select2-selection--single{
        height: 100% !important;
    }
    .select2-selection__rendered{
        padding-top: 5px;
    }
    .select2-selection__arrow{
        margin-top: 5px;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default .select2-selection--multiple {
        outline: none !important;
        border: none!important;
        background-color: var(--light)!important;
    }
    .noScroll { /* ...or body.dialogShowing */
        overflow-y: hidden !important;
    }
</style>
<div class="search-container custom-container my-1 px-4 px-md-2">
    <div class="input-group my-0 w-100" >
        <div class="input-group-prepend">
            <button class="btn btn-primary" type="button" id="search">
                <i class="fas fa-search"></i>
                <span class="border-0 align-top text-white d-none d-md-inline"><?php echo $lang['searchbar']['search'];?></span>
            </button>
        </div>
        <select class="state-select form-control custom-focus border-bottom rounded-0" multiple="multiple" name="search_place" id="search_place">
            <?php 
                echo '<optgroup label="'.$lang['searchbar']['optGroup']['poi'].'">';
                    $query = $CONN->db->query('
                        select 
                            city_translation.nameTranslated as cityName,
                            poi_translation.nameTranslated as poiName,
                            poi_translation.poi_link_ID
                        from
                            poi_translation
                        left join
                            poi_link
                        on
                            poi_translation.poi_link_ID = poi_link.poi_link_ID
                        left join
                            city_poi_link
                        on
                            poi_link.poi_link_ID = city_poi_link.poi_link_ID
                        left join
                            city_link
                        on
                            city_poi_link.city_link_ID = city_link.city_link_ID
                        left join
                            city_translation
                        on
                            city_link.city_link_ID = city_translation.city_link_ID
                        where
                            poi_translation.langCode = "'.$selectedLang.'"
                        and
                            city_translation.langCode = "'.$selectedLang.'"
                    ');
                    while($fetch = $query->fetch_object()){
                        echo '<option value="poi-'.$fetch->poi_link_ID.'">'.$fetch->cityName.' - '.$fetch->poiName.'</option>';
                    }
                echo '</optgroup>';
                echo '<optgroup label="'.$lang['searchbar']['optGroup']['city'].'">';
                    $query = $CONN->db->query('
                        select 
                            city_translation.nameTranslated,
                            city_translation.city_link_ID
                        from
                            city_link
                        left join
                            city_translation
                        on
                            city_link.city_link_ID = city_translation.city_link_ID
                        where
                            city_translation.langCode = "'.$selectedLang.'"
                    ');
                    while($fetch = $query->fetch_object()){
                        echo '<option value="city-'.$fetch->city_link_ID.'">'.$fetch->nameTranslated.'</option>';
                    }
                echo '</optgroup>';
            ?>
        </select>
        <div class="input-group-append">
            <button class="btn btn-success" role="button" data-toggle="collapse" data-target="#filterDropdown" aria-haspopup="true" aria-expanded="false" aria-controls="filterDropdown">
                <i class="fas fa-filter"></i>
                <span class="border-0 align-top text-white d-none d-md-inline" id=""><?php echo $lang['searchbar']['filter'];?></span>
            </button>
        </div>
    </div>
</div>
<div class="filter-container custom-container p-0 border-top-0 px-md-2">
    <div class="row mx-0">
        <div class="col-12 col-12 px-4 px-md-0">
            <div class="row mx-0 collapse" id="filterDropdown"><!-- START UL -->
                <div class="row mx-0 mb-3"> 
                    <div class="col-12 col-md-6 list-group-item border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                                <span class="text-info"><?php echo $lang['searchbar']['filterParams']['beachDistance']['name'];?></span>
                        </div>
                        <div class="container pt-2" data-filtBy="filtBy-distance">
                            <input type="range" min="0" max="20000" step="50" value="<?php echo ((isset($_GET['beachDistance'])) ? $_GET['beachDistance']:'500')?>" name="search_beachDistance" data-rangeSlider>
                            <?php echo $lang['searchbar']['filterParams']['beachDistance']['pre'];?> <output class="pt-2"></output>m
                        </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info">
                                <?php 
                                    
                                    // $var = $_SERVER['QUERY_STRING'];
                                    // // echo substr_count($var,'poi-');
                                    // echo strpos ($var, 'poi-');
                                ?>
                            <?php echo $lang['searchbar']['filterParams']['roomQuantity']['name'];?></span>
                        </div>
                        <div class="container pt-2" data-filtBy="filtBy-room">
                            <input type="range" min="1" max="8" step="1" value="<?php echo ((isset($_GET['roomQty'])) ? $_GET['roomQty']:'2')?>" name="search_roomQty" data-rangeSlider>
                            <?php echo $lang['searchbar']['filterParams']['roomQuantity']['pre'];?> <output class="pt-2"></output> <?php echo $lang['searchbar']['filterParams']['roomQuantity']['post'];?>
                            </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item text-center border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info"><?php echo $lang['searchbar']['filterParams']['poolAccess']['name'];?></span>
                        </div>
                        <div class="container" data-filtBy="filtBy-pool">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-check-label mx-auto ">
                                        <input type="radio" class="form-check-input" name="search_poolAccess" value="1" <?php echo ((isset($_GET['poolAccess']) && $_GET['poolAccess'] == 1) ? 'checked="checked"':'')?>><?php echo $lang['searchbar']['filterParams']['poolAccess']['yes'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="search_poolAccess" value="0" <?php echo ((isset($_GET['poolAccess']) && $_GET['poolAccess'] == 0) ? 'checked="checked"':'')?>><?php echo $lang['searchbar']['filterParams']['poolAccess']['no'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="search_poolAccess" value="2" <?php echo ((isset($_GET['poolAccess']) && $_GET['poolAccess'] == 2) ? 'checked="checked"':'')?>><?php echo $lang['searchbar']['filterParams']['poolAccess']['neutral'];?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item text-center border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info"><?php echo $lang['searchbar']['filterParams']['viewType']['name'];?></span>
                        </div>
                        <div class="container" data-filtBy="filtBy-view">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="search_viewType" value="1" <?php echo ((isset($_GET['viewType']) && $_GET['viewType'] == 1) ? 'checked="checked"':'')?>><?php echo $lang['searchbar']['filterParams']['viewType']['sea'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="search_viewType" value="2" <?php echo ((isset($_GET['viewType']) && $_GET['viewType'] == 2) ? 'checked="checked"':'')?>><?php echo $lang['searchbar']['filterParams']['viewType']['pool'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="search_viewType" value="0" <?php echo ((isset($_GET['viewType']) && $_GET['viewType'] == 0) ? 'checked="checked"':'')?>><?php echo $lang['searchbar']['filterParams']['viewType']['neutral'];?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 my-3 px-0">
                <div class="form-group float-right w-auto mb-0">
                    <select name="search_sortRent" class="form-control" id="sel1">
                        <option value="asc"><?php echo $lang['sortBy']['name'];?>: <?php echo $lang['sortBy']['asc'];?></option>
                        <option value="desc"><?php echo $lang['sortBy']['name'];?>: <?php echo $lang['sortBy']['desc'];?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="assets/js/range-slider.min.js"></script>
<script>
    $(document).ready(function() {
        $('.state-select').select2();
        var slider = document.querySelectorAll('input[type="range"]');
        rangeSlider.create(slider, {
            polyfill: true,     // Boolean, if true, custom markup will be created
            rangeClass: 'rangeSlider',
            fillClass: 'rangeSlider__fill',
            handleClass: 'rangeSlider__handle',
            startEvent: ['mousedown', 'touchstart', 'pointerdown'],
            moveEvent: ['mousemove', 'touchmove', 'pointermove'],
            endEvent: ['mouseup', 'touchend', 'pointerup'],
            vertical: false,    // Boolean, if true slider will be displayed in vertical orientation
            stick: null,        // [Number stickTo, Number stickRadius] : use it if handle should stick to stickTo-th value in stickRadius
            borderRadius: 10,   // Number, if you use buffer + border-radius in css for looks good,
            onInit: function () {
                var selector = '[data-rangeSlider]',
                elements = document.querySelectorAll(selector);
                function valueOutput(element) {
                    var value = element.value,
                        output = element.parentNode.getElementsByTagName('output')[0];
                    output.innerHTML = value;

                }
                for (var i = elements.length - 1; i >= 0; i--) {
                    valueOutput(elements[i]);
                }
                Array.prototype.slice.call(document.querySelectorAll('input[type="range"]')).forEach(function (el) {
                    el.addEventListener('input', function (e) {
                        valueOutput(e.target);
                    }, false);
                });
            },
            onSlideStart: function (position, value) {
                var htmlElement = document.getElementsByTagName('html')[0];
                var bodyTag = document.getElementsByTagName('body')[0];
                htmlElement.classList.add('noScroll');
                bodyTag.classList.add('noScroll');
            },
            onSlide: function (position, value) {
                
            },
            onSlideEnd: function (position, value) {
                var htmlElement = document.getElementsByTagName('html')[0];
                var bodyTag = document.getElementsByTagName('body')[0];
                htmlElement.classList.remove('noScroll');
                bodyTag.classList.remove('noScroll');
            }
        });
        document.querySelector("#search").addEventListener("click", function(e){
            var inp = document.querySelectorAll("input[name^=search_], select");
            var userInp = collectInput(inp);
            var customURL = urlBuilder(userInp);
            var url_string = window.location.href;
            var url = new URL(url_string);
            var filter = url.searchParams.get("show");
            if(filter == 'filter'){
                splittedURL = url_string.split('show=filter');
                var new_url = splittedURL[0]+'show=filter'+customURL;
            }else{
                var new_url = window.location.href+'&show=filter'+customURL;
            }
            window.location.href = new_url;
        });    
    });

        function urlBuilder(input){
            var url = '';
            for (var key in input) {
                var name = key.split('_');
                url = url + '&' + name[1] + "=" + input[key];
            }
            return url;
        }

        function collectInput(arrayContent){
            returnedObject = {};
            for(let x = 0; x < arrayContent.length; x++){
                if(arrayContent[x].type == 'radio'){
                    if(arrayContent[x].checked)
                        returnedObject[arrayContent[x].name] = arrayContent[x].value;
                }else if(arrayContent[x].type == 'select-multiple'){
                    // console.log(arrayContent[x].id);
                    var cityPoi = $('#' + arrayContent[x].id).find(':selected');
                    for(var c = 0; c < cityPoi.length; c++){
                        returnedObject['search_' + cityPoi[c].value] = cityPoi[c].value.substr(cityPoi[c].value.length - 1);
                    }
                }else{
                    returnedObject[arrayContent[x].name] = arrayContent[x].value;
                }
            }
            return returnedObject;
        }
</script>