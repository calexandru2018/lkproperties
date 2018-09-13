<?php 
    class RentList{

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

        public function fetchAll($lang){

            $lang = $this->langaugeValidator($lang); 

            $propertyIDCollection = [];
            $propertyRoomCollection = [];
            $propertyGuestsAmmountCollection = [];
            $returnedObjects = [];
            $queryCount = $this->db->query('
                select 
                    property_ID,
                    roomAmmount,
                    maxAllowedGuests
                from
                    property
                where 
                    isForSale = 0
                and
                    isVisible = 1
            ');
            while($fetchCount = $queryCount->fetch_object()){
                $propertyIDCollection[] = $fetchCount->property_ID;
                $propertyRoomCollection[] = $fetchCount->roomAmmount;
                $propertyGuestsAmmountCollection[] = $fetchCount->maxAllowedGuests;
            }

            for($c = 0; $c < count($propertyIDCollection); $c++){
                $returnedObjects[$c]['id'] = $propertyIDCollection[$c];
                $returnedObjects[$c]['roomAmmount'] = $propertyRoomCollection[$c];
                $returnedObjects[$c]['maxAllowedGuest'] = $propertyGuestsAmmountCollection[$c];
                $returnedObjects[$c]['publicID'] = $this->getPublicID($propertyIDCollection[$c])['publicID'];
                $returnedObjects[$c]['thumbnail'] = $this->getMainImg($propertyIDCollection[$c])['thumbnailURL'];
                $returnedObjects[$c]['title'] = $this->getTitle($propertyIDCollection[$c], $lang)['title'];
                $returnedObjects[$c]['price'] = $this->getMinPrice($propertyIDCollection[$c], $lang);
                $returnedObjects[$c]['description'] = $this->getShortDesc($propertyIDCollection[$c], $lang)['shortDescription'];
                $returnedObjects[$c]['services'] = $this->getServicesUnique($propertyIDCollection[$c], $lang);
            }
            return $returnedObjects;
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
        private function getMinPrice(int $propertyID){

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
            $fetchPrices = $result->fetch_array();
            return min($fetchPrices);
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