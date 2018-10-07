<?php 
    Class Activity{
        private $db;
        private $langList = [
            'portuguese' => 'pt', 
            'english' => 'en',
            'italian' => 'it',
            'french' => 'fr', 
            'neutral'=> 'na'
        ];
        private $tableInformation = [
            'city' => [
                'linkTable' => 'city_link',
                'translationTable' => 'city_translation',
                'galleryTable' => 'city_gallery',
                'id' => 'city_link_ID'
            ],
            'poi' => [
                'linkTable' => 'poi_link',
                'translationTable' => 'poi_translation',
                'galleryTable' => 'poi_gallery',
                'id' => 'poi_link_ID'
            ]
        ];

        function __construct($conn){
            $this->db = $conn;
        }
        public function closeConnection(){
            mysqli_close($this->db);
        }

        /* Type 1 - Poi; 2 - City */
        public function fetchAll(string $lang){
            $errorCatcher = [];
            $output = []; 
            $sql = '
                select 
                    activity_translation.nameTranslated as activityName,
                    activity_translation.descriptionTranslated as activityDesc,
                    city_translation.nameTranslated as cityName,
                    activity_link.activity_link_ID
                from
                    activity_link
                left join
                    activity_translation
                on
                    activity_link.activity_link_ID = activity_translation.activity_link_ID
                left join 
                    city_link
                on
                    activity_link.city_link_ID = city_link.city_link_ID
                left join
                    city_translation
                on
                    city_link.city_link_ID = city_translation.city_link_ID
                where 
                    activity_translation.langCode = "'.$lang.'"
                and
                    city_translation.langCode = "'.$lang.'"
            ';

            $query = $this->db->query($sql);
            while($fetcher = $query->fetch_row()){
                $output[] = $fetcher;
                $output[] = $this->fetchGallery($fetcher[3]);
            }
            if($this->db->error)
                return false;
            else
                return $output;
        }
        private function fetchGallery(int $id){
            $output = [];
            $sql = '
                select
                    fullsizeURL
                from
                    activity_gallery
                where
                    activity_link_ID = "'.$id.'"
            ';
            $query = $this->db->query($sql);
            while($r = $query->fetch_object()){
                $output[] = $r->fullsizeURL;
            }
            if($this->db->error)
                return false;
            else
                return $output;
        }
    }
?>