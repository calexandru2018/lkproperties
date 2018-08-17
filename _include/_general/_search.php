<?php
    /* 
        CSS is loaded on this specific page so that other pages dont load unnecessary files,
        to help speed up loading time
    */
?>  
<link rel="stylesheet" href="assets/css/range-slider.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">

<?php
    /* 
        Custom styling for this select.
    */
?>  
<style>
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
</style>
<div class="search-container custom-container my-1 px-4 px-md-2">
    <div class="input-group my-0 w-100" >
        <div class="input-group-prepend">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i>
                <span class="border-0 align-top text-white d-none d-md-inline"><?php echo $lang['searchbar']['search'];?></span>
            </button>
        </div>
        <select class="state-select form-control custom-focus border-bottom rounded-0" name="state" multiple="multiple">
            <option value="AL">Alabama</option>
            <option value="WY">Wyoming</option>
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
                            <input type="range" min="50" max="2000" step="50" value="100" name="beachDistance" data-rangeSlider>
                            <?php echo $lang['searchbar']['filterParams']['beachDistance']['pre'];?> <output class="pt-2"></output>m
                        </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info"><?php echo $lang['searchbar']['filterParams']['roomQuantity']['name'];?></span>
                        </div>
                        <div class="container pt-2" data-filtBy="filtBy-room">
                            <input type="range" min="1" max="8" step="1" value="2" name="room" data-rangeSlider>
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
                                        <input type="radio" class="form-check-input" name="filtBy-pool" data-filtBy-pool="1" value="1"><?php echo $lang['searchbar']['filterParams']['poolAccess']['yes'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-pool" value="0"><?php echo $lang['searchbar']['filterParams']['poolAccess']['no'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-pool" value="2"><?php echo $lang['searchbar']['filterParams']['poolAccess']['neutral'];?>
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
                                        <input type="radio" class="form-check-input" name="filtBy-view" value="1"><?php echo $lang['searchbar']['filterParams']['viewType']['sea'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-view" value="2"><?php echo $lang['searchbar']['filterParams']['viewType']['pool'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-view" value="0"><?php echo $lang['searchbar']['filterParams']['viewType']['neutral'];?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item text-center border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info"><?php echo $lang['searchbar']['filterParams']['wifi']['name'];?></span>
                        </div>
                        <div class="container text-center" data-filtBy="filtBy-wifi">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-check-label mx-auto ">
                                        <input type="radio" class="form-check-input" name="filtBy-wifi" value="1"><?php echo $lang['searchbar']['filterParams']['wifi']['yes'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-wifi" value="0"><?php echo $lang['searchbar']['filterParams']['wifi']['no'];?>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-wifi" value="2"><?php echo $lang['searchbar']['filterParams']['wifi']['neutral'];?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
                console.log(element.name);
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
                console.info('onSlideStart', 'position: ' + position, 'value: ' + value);
            },
            onSlide: function (position, value) {
                console.log('onSlide', 'position: ' + position, 'value: ' + value);
            },
            onSlideEnd: function (position, value) {
                console.warn('onSlideEnd', 'position: ' + position, 'value: ' + value);
            }
        });    
    });
</script>