<?php 
    class FilterSearch{

        private $db;
        private $langList = [
            'portuguese' => 'pt', 
            'english' => 'en',
            'italian' => 'it',
            'french' => 'fr', 
            'neutral'=> 'na'
        ];

        function __construct($conn){
            $this->db = $conn;
        }
        public function closeConnection(){
            mysqli_close($this->db);
        }

        public function fetchAll(array $searchInput, $lang){

            $lang = $this->langaugeValidator($lang); 

            $propertyIDCollection = [];
            $returnedObjects = [];

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
                    'name' => 'poolAccess',
                    'default' => NULL
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
            $isRent = 1;
            $cityIDCollector = [];
            $poiIDCollector = [];
            
            /* hasPoolAccess */
            /* 
                1 - Yes
                2 - indifferent 
                0 - No
            */
        
            foreach($searchInput as $key => $value){
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
                if($key == $defaultValues['hasPoolAccess']['name'] && ($value != 2) )
                    $hasPoolAccess = (int)$value;
                if($key == $defaultValues['wifi']['name'] && ($value != 2) )
                    $wifi = (int)$value;
                if(substr($key,0,4) === $defaultValues['sort']['name'])
                    $sort = $value;
                if(substr($key,-4) === 'Rent')
                    $isRent = 0;
            }
    
            if($sort == 'asc'){
                $sort = 'order by property_price.minPrice asc';
            }else{
                $sort = 'order by property_price.maxPrice desc';
            }
            $cityLeftJoinSQL = '';
            $poiLeftJoinSQL = '';
    
            if(count($poiIDCollector) > 0){
                $cityLeftJoinSQL = '
                    left join
                        property_city_poi
                    on
                        property.property_ID = property_city_poi.property_ID
                    left join
                        city_poi_link
                    on
                        property_city_poi.city_poi_link_ID = city_poi_link.city_poi_link_ID
                    left join
                        poi_link
                    on
                        city_poi_link.poi_link_ID = poi_link.poi_link_ID 
                ';
            }
    
            if(count($cityIDCollector) > 0){
                $cityLeftJoinSQL = '
                    left join
                        property_city_poi
                    on
                        property.property_ID = property_city_poi.property_ID
                    left join
                        city_poi_link
                    on
                        property_city_poi.city_poi_link_ID = city_poi_link.city_poi_link_ID
                    left join
                        city_link
                    on
                        city_poi_link.city_link_ID = city_link.city_link_ID 
                ';
            }
    
            $baseSQL = '
                select
                    property.publicID,
                    property.property_ID, 
                    property.isForSale,
                    property.roomAmmount,
                    property.maxAllowedGuests, 
                    property.beachDistance,
                    property.hasPoolAccess,
                    property.viewType,
                    property.propertyType
                from
                    property
                left join
                    property_price
                on
                    property.property_ID = property_price.property_ID 
                '.$cityLeftJoinSQL.' 
                '.$poiLeftJoinSQL.' 
                where
                    (
                        beachDistance <= "'.$beachDistance.'"
                    and
                        isForSale = "'.$isRent.'"
                    and
                        isVisible = 1
                    and
                        roomAmmount <= "'.$roomQty.'"
                        '.(($viewType == 0) ? '':' and viewType = "'.$viewType.'"').'
                        '.((is_int($hasPoolAccess) == false) ? '':' and hasPoolAccess = "'.$hasPoolAccess.'"').'
                    ) 
                ';
                // echo $baseSQL.'<br/><br/><br/>';
            /* Dynamic sql builder */
                $dynamicSQLCity = '';
                $dynamicSQLPoi = '';
                strlen($dynamicSQLCity);
                for($c = 0; $c < count($cityIDCollector); $c++){
                    if($c == (count($cityIDCollector)-1) )
                        $dynamicSQLCity = $dynamicSQLCity.'city_poi_link.city_link_ID = '.$cityIDCollector[$c].'';
                    else
                        $dynamicSQLCity = $dynamicSQLCity.'city_poi_link.city_link_ID = '.$cityIDCollector[$c].' or ';
                }
                // echo $baseSQL.'<br/><br/><br/>';
                for($c = 0; $c < count($poiIDCollector); $c++){
                    if($c == (count($poiIDCollector)-1) )
                        $dynamicSQLPoi = $dynamicSQLPoi.'city_poi_link.city_link_ID = '.$poiIDCollector[$c].'';
                    else
                        $dynamicSQLPoi = $dynamicSQLPoi.'city_poi_link.city_link_ID = '.$poiIDCollector[$c].' or ';
                }
                // echo $baseSQL.'<br/><br/><br/>';
                if(strlen($dynamicSQLCity) > 2 && strlen($dynamicSQLPoi) < 2)
                    $baseSQL = $baseSQL.'and ('.$dynamicSQLCity.')';
                else if(strlen($dynamicSQLCity) < 2 && strlen($dynamicSQLPoi) > 2)
                    $baseSQL = $baseSQL.'and ('.$dynamicSQLPoi.')';
                else if(strlen($dynamicSQLCity) > 2 && strlen($dynamicSQLPoi) > 2)
                    $baseSQL = $baseSQL.' and (('.$dynamicSQLPoi.')'.' or ('.$dynamicSQLPoi.'))';
            /* Dynamic sql builder */

            $query = $this->db->query($baseSQL);
            if(!$this->db->error){
                while($fetch = $query->fetch_object()){
                    $returnedObjects[$c]['id'] = $fetch->property_ID;
                    $returnedObjects[$c]['forSale'] = $fetch->isForSale;
                    $returnedObjects[$c]['publicID'] = $fetch->publicID;
                    $returnedObjects[$c]['roomAmmount'] = $fetch->roomAmmount;
                    $returnedObjects[$c]['maxAllowedGuests'] = $fetch->maxAllowedGuests;
                    $returnedObjects[$c]['beachDistance'] = $fetch->beachDistance;
                    $returnedObjects[$c]['hasPoolAccess'] = $fetch->hasPoolAccess;
                    $returnedObjects[$c]['viewType'] = $fetch->viewType;
                    $returnedObjects[$c]['propertyType'] = $fetch->propertyType;
                    $returnedObjects[$c]['thumbnail'] = $this->getMainImg($fetch->property_ID);
                    $returnedObjects[$c]['title'] = $this->getTitle($fetch->property_ID, $lang);
                    $returnedObjects[$c]['price'] = $this->getPrice($fetch->property_ID, $fetch->isForSale);
                    $returnedObjects[$c]['description'] = $this->getShortDesc($fetch->property_ID, $lang);
                    $returnedObjects[$c]['services'] = $this->getServicesUnique($fetch->property_ID, $lang);
                    $c++;
                }                
            }
            return $returnedObjects; 
        }

        private function getMainImg(int $propertyID){
            $result = $this->db->query('
                select
                    thumbnailURL
                from 
                    property_gallery
                where
                    property_ID = "'.$propertyID.'"
                limit 1
            ');
            $fetch = $result->fetch_object();
            return $fetch->thumbnailURL;
        }
        private function getTitle(int $propertyID, string $lang){
            $result = $this->db->query('
                select
                    title
                from 
                    title_translation
                inner join
                    title_link
                on
                    title_translation.title_link_ID = title_link.title_link_ID
                where
                    title_link.property_ID = "'.$propertyID.'"
                and
                    title_translation.langCode = "'.$lang.'"
            ');
            $fetch = $result->fetch_object();
            return $fetch->title;
        }
        private function getPrice(int $propertyID, int $isForSale){

            $result = $this->db->query('
                select
                    '.(($isForSale == 1) ? 'cat1':'minPrice').'
                from
                    property_price
                where
                    property_ID = "'.$propertyID.'"
            ');
            $fetch = $result->fetch_object();
            return (($isForSale == 1) ? $fetch->cat1 : $fetch->minPrice);
        }
        private function getShortDesc(int $propertyID, string $lang){
            $result = $this->db->query('
                select
                    shortDescription
                from 
                    short_desc_translation
                inner join
                    short_desc_link
                on
                    short_desc_translation.short_desc_link_ID = short_desc_link.short_desc_link_ID
                where
                    short_desc_link.property_ID = "'.$propertyID.'"
                and
                    short_desc_translation.langCode = "'.$lang.'" 
            ');
            $fetch = $result->fetch_object();
            return $fetch->shortDescription;
        }
        private function getServicesUnique(int $propertyID, string $lang){
            $uniqueServiceIDCollector = [];
            $uniqueServiceCollector = [];

            $result = $this->db->query('
                select
                    unique_service_link_ID
                from 
                    property_unique_service
                where
                    property_ID = "'.$propertyID.'"
            ');
            while($serviceHolder = $result->fetch_object()){
                $uniqueServiceIDCollector[] = $serviceHolder->unique_service_link_ID; 
            }
            $sqlResultTranslatedBase = '
                select 
                    uniqueServiceTranslated
                from
                    unique_service_translation
                where (
            ';
            for($c = 0; $c < count($uniqueServiceIDCollector); $c++){
                if($c == (count($uniqueServiceIDCollector)-1))
                    $sqlResultTranslatedBase = $sqlResultTranslatedBase.'unique_service_link_ID = '.$uniqueServiceIDCollector[$c].') and langCode = "'.$lang.'"';
                else
                    $sqlResultTranslatedBase = $sqlResultTranslatedBase.'unique_service_link_ID = '.$uniqueServiceIDCollector[$c].' or ';
            }
            $queryResultTranslatedBase = $this->db->query($sqlResultTranslatedBase);
            
            if(!$this->db->error){
                while($fetchTranslation = $queryResultTranslatedBase->fetch_assoc()){
                    $uniqueServiceCollector[] = $fetchTranslation['uniqueServiceTranslated'];
                }
            }
            return $uniqueServiceCollector;
        } 
        /* Custom controll function */
            private function langaugeValidator(string $lang){
                $langChecker = false;
                foreach($this->langList as $key => $value){
                    if($value == $lang)
                        $langChecker = true;
                }
                return (($langChecker == true) ? $lang : 'en');
            }
        /* Custom controll function */
    }
?>  