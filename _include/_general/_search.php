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
                $poiArray = Array();
                $cityArray = Array();
                foreach($_GET as $key => $value){
                    if(strpos($key, 'poi-') !== false)
                        $poiArray[] = $value;
                    if(strpos($key, 'city-') !== false)
                        $cityArray[] = $value;
                }
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
                        for($c = 0; $c < count($poiArray); $c++){
                            if($poiArray[$c] == $fetch->poi_link_ID)
                                $poiSelected = 'selected';
                        }
                        echo '<option value="poi-'.$fetch->poi_link_ID.'"'.$poiSelected.'>'.$fetch->cityName.' - '.$fetch->poiName.'</option>';
                        $poiSelected = '';
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
                        for($c = 0; $c < count($cityArray); $c++){
                            if($cityArray[$c] == $fetch->city_link_ID)
                                $citySelected = 'selected';
                        }
                        echo '<option value="city-'.$fetch->city_link_ID.'"'.$citySelected.'>'.$fetch->nameTranslated.'</option>';
                        $citySelected = '';
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
                            <span class="text-info"><?php echo $lang['searchbar']['filterParams']['roomQuantity']['name'];?></span>
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
        </div>
    </div>
</div>
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
    });
    document.querySelector("#search").addEventListener("click", function(e){
        var inp = document.querySelectorAll("input[name^=search_], select");
        var userInp = collectInput(inp);
        var customURL = urlBuilder(userInp);
        var url_string = window.location.href;
        console.log(url_string);
    
        if(url_string.includes('for-sale/')){
            var new_url_string = url_string.split('/')
            console.log(new_url_string);
            url_string = new_url_string[5].replace('for-sale', '/');
            
        }else if(url_string.includes('/for-sale')){
            url_string = url_string.replace('for-sale', '');
        }       
        if(url_string.includes('filter')){
            splittedURL = url_string.split('filter');
            var new_url = splittedURL[0]+'filter'+customURL;
        }else{
            var new_url = url_string+'filter'+customURL;
        }
        window.location.href = new_url;
        console.log(new_url);
        
    });
</script>