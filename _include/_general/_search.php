<div class="search-container custom-container my-1 px-4 px-md-2">
    <div class="input-group my-0 w-100" >
        <div class="input-group-prepend">
            <button class="btn btn-primary pb-0" type="submit">
                <i data-feather="search"></i>
                <span class="border-0 align-top text-white d-none d-md-inline">Search</span>
            </button>
        </div>
        <input class="form-control p-1 px-md-2 custom-focus border-bottom rounded-0" type="text" placeholder="Try searching for Rocha">
        <div class="input-group-append">
            <button class="btn btn-success pb-0" role="button" data-toggle="collapse" data-target="#filterDropdown" aria-haspopup="true" aria-expanded="false" aria-controls="filterDropdown">
                <i data-feather="filter"></i>
                <span class="border-0 align-top text-white d-none d-md-inline" id="">Filter By</span>
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
                                <span class="text-info">Beach Distance</span>
                        </div>
                        <div class="container pt-2" data-filtBy="filtBy-distance">
                            <input type="range" min="50" max="2000" step="50" value="100" name="beachDistance" data-rangeSlider>
                            Up to <output class="pt-2"></output>m
                        </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info">Room Quantity</span>
                        </div>
                        <div class="container pt-2" data-filtBy="filtBy-room">
                            <input type="range" min="1" max="8" step="1" value="2" name="room" data-rangeSlider>
                            Up to <output class="pt-2"></output> rooms
                            </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item text-center border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info">Pool Access</span>
                        </div>
                        <div class="container" data-filtBy="filtBy-pool">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-check-label mx-auto ">
                                        <input type="radio" class="form-check-input" name="filtBy-pool" data-filtBy-pool="1" value="1">Yes
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-pool" value="0">No
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-pool" value="2">Indifferent
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item text-center border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info">View Type</span>
                        </div>
                        <div class="container" data-filtBy="filtBy-view">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-view" value="1">Sea
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-view" value="2">Pool
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-view" value="0">Indifferent
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 list-group-item text-center border-0 px-0 px-md-1">
                        <div class="input-group-text mb-2 bg-white border-top-0 border-left-0 border-right-0 rounded-0">
                            <span class="text-info">Wifi</span>
                        </div>
                        <div class="container text-center" data-filtBy="filtBy-wifi">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-check-label mx-auto ">
                                        <input type="radio" class="form-check-input" name="filtBy-wifi" value="1">Yes
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-wifi" value="0">No
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="form-check-label mx-auto">
                                        <input type="radio" class="form-check-input" name="filtBy-wifi" value="2">Indifferent
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