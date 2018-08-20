<?php 
    // var_dump($_GET);

    /* DEFAULT VALUES */
    if(isset($_GET) && count($_GET) > 1){
        $selectedLang;
        $defaultValues = 
            [
                'beachDistance' => 
                [
                    'name' => 'beachDistance',
                    'default' => 50
                ],
                'roomQty' => 
                [
                    'name' => 'roomQty',
                    'default' => 2
                ],
                'viewType' => 
                [
                    'name' => 'viewType',
                    'default' => 0
                ],
                'hasPoolAccess' => 
                [
                    'name' => 'hasPoolAccess',
                    'default' => 0
                ],
                'wifi' => 
                [
                    'name' => 'wifi',
                    'default' => 0
                ],
                'sort' => 
                [
                    'name' => 'sort',
                    'default' => 0
                ],
            ];
        $beachDistance = $defaultValues['beachDistance']['default'];
        $roomQty = $defaultValues['roomQty']['default'];
        $viewType = $defaultValues['viewType']['default'];
        $hasPoolAccess = $defaultValues['hasPoolAccess']['default'];
        $wifi = $defaultValues['wifi']['default'];
        $sort = $defaultValues['sort']['default'];
        $isRent = 0;
        $cityIDCollector = [];
        $poiIDCollector = [];

        
        foreach($_GET as $key => $value){
            if(substr($key,0,4) === 'city')
                $cityIDCollector[] = (int)$value;
            if(substr($key,0,3) === 'poi')
                $poiIDCollector[] = (int)$value;
            if($key == $defaultValues['beachDistance']['name'])
                $beachDistance = (int)$value;
            if($key == $defaultValues['roomQty']['name'])
                $roomQty = (int)$value;
            if($key == $defaultValues['viewType']['name'])
                $viewType = (int)$value;
            if($key == $defaultValues['hasPoolAccess']['name'])
                $hasPoolAccess = (int)$value;
            if($key == $defaultValues['wifi']['name'])
                $wifi = (int)$value;
            if(substr($key,0,4) === $defaultValues['sort']['name'])
                $sort = $value;
            if(substr($key,-4) === 'Rent')
                $isRent = 1;
            
                echo $key.'<br/>';
        }
        print_r($cityIDCollector);
        print_r($poiIDCollector);
        $baseSQL = '
            select
                property.*,
                price = (SELECT min(property_price_ID) FROM property_price WHERE property_price.property_ID = property.property_ID),
            from
                property
            where
                beachDistance <= "'.$beachDistance.'"
            left join
                property_price
            on
                property.property_ID = property_price.property_ID
            and
                roomAmmount <= "'.$roomQty.'"
            '.(($viewType == 0) ? '':'and viewType ="'.$viewType.'"').'
            '.(($hasPoolAccess == 0) ? '':'and hasPoolAccess ="'.$hasPoolAccess.'"').'
            order by 
                price
            '.$sort.'
        ';
        echo $baseSQL;
    }
?>