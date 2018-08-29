<?php 
    class RentDetails{

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

        public function fetchRow(int $propertyPublicID, string $lang){

            $lang = $this->langaugeValidator($lang); 

            $returnedObject = [];
            $queryCount = $this->db->query('
                select 
                    property_ID
                from
                    property
                where 
                    isForSale = 0
                and
                    isVisible = 1
                and
                    publicID = "'.mysqli_real_escape_string($this->db, $propertyPublicID).'"
            ');
            if($this->db->error)
                return false;

            $fetchCount = $queryCount->fetch_object();
            $propertyID = $fetchCount->property_ID;

            $returnedObject['id'] = $propertyID;
            $returnedObject['publicID'] = $propertyPublicID;
            $returnedObject['objectGallery'] = $this->getObjectGallery($propertyID);
            $returnedObject['poiInfo'] = $this->getPoiID($propertyID, $lang);
            $returnedObject['poiGallery'] = $this->getPoiGallery($propertyID);
            $returnedObject['title'] = $this->getTitle($propertyID, $lang)['title'];
            $returnedObject['priceList'] = $this->getPriceList($propertyID, $lang);
            $returnedObject['description'] = $this->getLongDesc($propertyID, $lang)['longDescription'];
            $returnedObject['servicesCommon'] = $this->getServicesCommon($propertyID, $lang);
            $returnedObject['servicesUnique'] = $this->getServicesUnique($propertyID, $lang);
            
            return $returnedObject;
        }

        private function getPublicID(int $propertyID){
            $result = $this->db->query('
                select
                    publicID 
                from 
                    property
                where
                    property_ID = "'.$propertyID.'"
                and
                    isForSale = 0
                and
                    isVisible = 1
            ');
            return $result->fetch_array();
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
            return $result->fetch_array();
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
            return $result->fetch_array();
        }
        private function getPriceList(int $propertyID){

            $result = $this->db->query('
                select
                    cat1,
                    cat2,
                    cat3,
                    cat4,
                    cat5,
                    cat6,
                    cat7,
                    cat8,
                    cat9,
                    cat10
                from
                    property_price
                where
                    property_ID = "'.$propertyID.'"
            ');
            $fetchPrices = $result->fetch_row();
            return $fetchPrices;
        }
        private function getLongDesc(int $propertyID, string $lang){
            $result = $this->db->query('
                select
                    longDescription
                from 
                    long_desc_translation
                inner join
                    long_desc_link
                on
                    long_desc_translation.long_desc_link_ID = long_desc_link.long_desc_link_ID
                where
                    long_desc_link.property_ID = "'.$propertyID.'"
                and
                    long_desc_translation.langCode = "'.$lang.'" 
            ');
            return $result->fetch_array();
        }
        private function getServicesCommon(int $propertyID, string $lang){
            $commonServiceIDCollector = [];
            $commonServiceCollector = [];

            $result = $this->db->query('
                select
                    common_service_link_ID
                from 
                    property_common_service
                where
                    property_ID = "'.$propertyID.'"
            ');
            while($serviceHolder = $result->fetch_object()){
                $commonServiceIDCollector[] = $serviceHolder->common_service_link_ID; 
            }
            $sqlResultTranslatedBase = '
                select 
                    serviceTranslated
                from
                    common_service_translation
                where (
            ';
            for($c = 0; $c < count($commonServiceIDCollector); $c++){
                if($c == (count($commonServiceIDCollector)-1))
                    $sqlResultTranslatedBase = $sqlResultTranslatedBase.'common_service_link_ID = '.$commonServiceIDCollector[$c].') and langCode = "'.$lang.'"';
                else
                    $sqlResultTranslatedBase = $sqlResultTranslatedBase.'common_service_link_ID = '.$commonServiceIDCollector[$c].' or ';
            }
            $queryResultTranslatedBase = $this->db->query($sqlResultTranslatedBase);
            
            while($fetchTranslation = $queryResultTranslatedBase->fetch_assoc()){
                $commonServiceCollector[] = $fetchTranslation['serviceTranslated'];
            }

            return $commonServiceCollector;
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
            
            while($fetchTranslation = $queryResultTranslatedBase->fetch_assoc()){
                $uniqueServiceCollector[] = $fetchTranslation['uniqueServiceTranslated'];
            }

            return $uniqueServiceCollector;
        }
        private function getObjectGallery(int $propertyID){
            $output = [];
            $query = $this->db->query('
                select 
                    fullsizeURL
                from
                    property_gallery
                where
                    property_ID = "'.$propertyID.'"
            ');
            if($this->db->error)
                return false;
            while($fetch = $query->fetch_object()){
                $output[] = $fetch->fullsizeURL;
            }

            return $output;
        }

        private function getPoiID(int $propertyID, string $lang){
            $query = $this->db->query('
            SELECT
                poi_link.poi_link_ID,
                poi_translation.nameTranslated
            FROM	
                property
            left JOIN
                property_city_poi
            ON
                property.property_ID = property_city_poi.property_ID
            LEFT JOIN	
                city_poi_link
            ON
                property_city_poi.city_poi_link_ID = city_poi_link.city_poi_link_ID
            LEFT JOIN
                poi_link
            ON
                city_poi_link.poi_link_ID = poi_link.poi_link_ID
            left join
                poi_translation
            on
                poi_link.poi_link_ID = poi_translation.poi_link_ID
            WHERE
                property.property_ID = "'.$propertyID.'"
            and
                poi_translation.langCode = "'.$lang.'" 
            ');
            if($this->db->error)
                return false;

            $fetch = $query->fetch_object();
            $output['id'] = $fetch->poi_link_ID;
            $output['name'] = $fetch->nameTranslated;

            return $output;
        }

        private function getPoiGallery(int $propertyID){
            $output = [];
            $query = $this->db->query('
            SELECT
                poi_gallery.fullsizeURL,
                poi_link.poi_link_ID
            FROM	
                property
            left JOIN
                property_city_poi
            ON
                property.property_ID = property_city_poi.property_ID
            LEFT JOIN	
                city_poi_link
            ON
                property_city_poi.city_poi_link_ID = city_poi_link.city_poi_link_ID
            LEFT JOIN
                poi_link
            ON
                city_poi_link.poi_link_ID = poi_link.poi_link_ID
            LEFT JOIN
                poi_gallery
            ON
                poi_link.poi_link_ID = poi_gallery.poi_link_ID
            WHERE
                property.property_ID = "'.$propertyID.'"
            ');
            if($this->db->error)
                return false;

            while($fetch = $query->fetch_object()){
                $output[] = $fetch->fullsizeURL;
            }

            return $output;
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