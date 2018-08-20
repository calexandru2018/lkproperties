<?php 
    Class Popular{
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
        public function fetchSingle(string $type, int $id, string $lang){
            if($type === 'poi'){
                $type = 'poi';
            }elseif($type === 'city'){
                $type = 'city';
            }else{
                return false;
            }
            
            foreach($this->langList as $key => $value){
                if($lang == $value){
                    $isPossbile = $key;
                    break;
                }else{
                    $isPossbile = 'english';
                }
            }


            $sql = '
            SELECT 
                videoURL,
                '.$this->tableInformation[$type]['translationTable'].'.nameTranslated,
                '.$this->tableInformation[$type]['translationTable'].'.descriptionTranslated,
                '.$this->tableInformation[$type]['galleryTable'].'.fullsizeURL,
                '.$this->tableInformation[$type]['linkTable'].'.'.$this->tableInformation[$type]['id'].'
            FROM
                '.$this->tableInformation[$type]['linkTable'].'
            LEFT JOIN
                '.$this->tableInformation[$type]['translationTable'].'
            ON
                '.$this->tableInformation[$type]['linkTable'].'.'.$this->tableInformation[$type]['id'].' = '.$this->tableInformation[$type]['translationTable'].'.'.$this->tableInformation[$type]['id'].'
            LEFT JOIN
                '.$this->tableInformation[$type]['galleryTable'].'
            ON
                '.$this->tableInformation[$type]['linkTable'].'.'.$this->tableInformation[$type]['id'].' = '.$this->tableInformation[$type]['galleryTable'].'.'.$this->tableInformation[$type]['id'].'
            WHERE
                '.$this->tableInformation[$type]['linkTable'].'.'.$this->tableInformation[$type]['id'].' = "'.$id.'"
            AND
                '.$this->tableInformation[$type]['linkTable'].'.isPopular = 1
            AND
                '.$this->tableInformation[$type]['translationTable'].'.langCode = "'.$this->langList[$isPossbile].'"
            LIMIT 1
            ';

            $query = $this->db->query($sql);
            if($this->db->error)
                return false;
            else
                return $query->fetch_row();
        }
        public function fetchGallery(string $type, int $id){
            $c = 0;
            if($type === 'poi'){
                $type = 'poi';
            }elseif($type === 'city'){
                $type = 'city';
            }else{
                return false;
            }
            $sql = '
                select
                    fullsizeURL
                from
                    '.$this->tableInformation[$type]['galleryTable'].'
                where
                    '.$this->tableInformation[$type]['id'].' = "'.$id.'"
            ';
            $query = $this->db->query($sql);
            while($r = $query->fetch_object()){
                $output[] = $r->fullsizeURL;
            }
            if($this->db->error)
                return false;
            else
                return ((empty($output)) ? '': $output);
        }
    }
?>