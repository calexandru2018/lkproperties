<?php

    class ToRent{
                
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
        public function closeConnection($conn){
            mysqli_close($conn);
        }

        /* Database Functions */
            public function fetchAll(){
				$sqlFetchAll = '
					select 
						property.*,
						poi_translation.nameTranslated,
						title_translation.title
					from
						property
					left join
						title_link
					on
						property.property_ID = title_link.property_ID
					left join
						title_translation
					on
						title_link.title_link_ID = title_translation.title_link_ID 
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
					left join
						poi_translation
					on
						poi_link.poi_link_ID = poi_translation.poi_link_ID
					where
						poi_translation.langCode = "'.$this->langList['portuguese'].'"
						and
						title_translation.langCode = "'.$this->langList['portuguese'].'"
				';
				$queryResult = $this->db->query($sqlFetchAll);
				while($r=$queryResult->fetch_object()){
					$output[] = $r;
				}
				return ((empty($output))? '' : $output);
            }

            public function fetchToRent(){

            }

            public function insertToRent(array $inputArray){
                $toRentData = $this->sanitizeInput($inputArray);
                
                $errorCatcher = Array();
				$poiPostalCode = explode('-', $toRentData['property']['cityPoi']);
				$publicID = (int)$this->generatePublicID($poiPostalCode[1]);
                $sqlProperty = '
                    insert into
                        property
                            (
                                isForSale,
                                propertyType,
                                viewType,
                                hasPoolAccess,
                                isVisible,
                                roomAmmount,
                                maxAllowedGuests,
                                beachDistance,
                                publicID
                            )
                        values
                            (
                                "0",
                                "'.$toRentData['property']['propertyType'].'",
                                "'.$toRentData['property']['viewType'].'",
                                "'.$toRentData['property']['hasPoolAccess'].'",
                                "'.$toRentData['property']['isVisible'].'",
                                "'.$toRentData['property']['roomAmmount'].'",
                                "'.$toRentData['property']['maxAllowedGuests'].'",
                                "'.$toRentData['property']['beachDistance'].'",
                                "'.$publicID.'"
                            )
                ';
                $queryProperty = $this->db->query($sqlProperty);
                if($this->db->error){
                    $errorCatcher['Property Table'][$this->generatePublicID($poiPostalCode[1])][] = $this->db->error;
                }else{
					$propertyID = $this->db->insert_id;

					$sqlPropertyTitle = '
						insert into
							title_link
								(
									title_link_ID,
									property_ID,
									dateCreated
								)
							values
								(
									default,
									"'.$propertyID.'",
									default
								)
					';
					$queryPropertyTitle = $this->db->query($sqlPropertyTitle);
					if($this->db->error)
						$errorCatcher['Title Link table'][] = $this->db->error;
						
				/* Insert property title, short and long description link and translations */   
					$titleLinkID = $this->db->insert_id;
					$sqlTitleTranslation = '
						insert into 
							title_translation
								(
									title_link_ID,
									langCode,
									title
								)
							values
								(
									"'.$titleLinkID.'",
									"'.$this->langList['portuguese'].'",
									"'.$toRentData['nameList'][$this->langList['portuguese']].'"
								),
								(
									"'.$titleLinkID.'",
									"'.$this->langList['english'].'",
									"'.$toRentData['nameList'][$this->langList['english']].'"
								)
					';
					$queryTitleTranslation = $this->db->query($sqlTitleTranslation);
					if($this->db->error)
						$errorCatcher['Title Translation table'][] = $this->db->error;
						
					$sqlShortDescLink = '
						insert into
							short_desc_link
								(
									short_desc_link_ID,
									property_ID,
									dateCreated
								)
							values
								(
									default,
									"'.$propertyID.'",
									default
								)
					';
					$queryShortDescLink = $this->db->query($sqlShortDescLink);
					if($this->db->error)
						$errorCatcher['Short description link table'][] = $this->db->error;

					$shortDescLinkID = $this->db->insert_id;
					$sqlShortDescTranslation = '
						insert into
							short_desc_translation
								(
									short_desc_link_ID,
									langCode,
									shortDescription
								)
							values
								(
									"'.$shortDescLinkID.'",
									"'.$this->langList['portuguese'].'",
									"'.$toRentData['descShortList'][$this->langList['portuguese']].'"
								),
								(
									"'.$shortDescLinkID.'",
									"'.$this->langList['english'].'",
									"'.$toRentData['descShortList'][$this->langList['english']].'"
								)
					'; 
					$queryShortDescTranslation = $this->db->query($sqlShortDescTranslation);
					if($this->db->error)
						$errorCatcher['Short Description Translation table'][] = $this->db->error;
						
					$sqlLongDescLink = '
						insert into
							long_desc_link
								(
									long_desc_link_ID,
									property_ID,
									dateCreated
								)
							values
								(
									default,
									"'.$propertyID.'",
									default
								)
					';
					$queryLongDescLink = $this->db->query($sqlLongDescLink);
					if($this->db->error)
						$errorCatcher['Long description link table'][] = $this->db->error;

					$longDescLinkID = $this->db->insert_id;
					$sqlLongDescTranslation = '
						insert into
							long_desc_translation
								(
									long_desc_link_ID,
									langCode,
									longDescription
								)
							values
								(
									"'.$longDescLinkID.'",
									"'.$this->langList['portuguese'].'",
									"'.$toRentData['descLongList'][$this->langList['portuguese']].'"
								),
								(
									"'.$longDescLinkID.'",
									"'.$this->langList['english'].'",
									"'.$toRentData['descLongList'][$this->langList['english']].'"
								)
					'; 
					$queryLongDescTranslation = $this->db->query($sqlLongDescTranslation);
					if($this->db->error)
						$errorCatcher['Long description translation table'][] = $this->db->error;
				/* Insert property title, short and long description link and translations */

					$sqlPropertyCityPoi = '
						insert into
							property_city_poi
								(
									property_ID,
									city_poi_link_ID
								)
							values
								(
									"'.$propertyID.'",
									"'.$poiPostalCode[0].'"
								)
							
					';
					$queryPropertyCityPoi = $this->db->query($sqlPropertyCityPoi);
					if($this->db->error)
						$errorCatcher['propertyCityPoi table'][] = $this->db->error;

					$sqlCommonService = '
						insert into
							property_common_service
								(
									property_ID,
									common_service_link_ID
								)
							values 
					';
					for($c = 0; $c < count($toRentData['commonServiceList']); $c++){
						if($c == (count($toRentData['commonServiceList'])-1))
							$sqlCommonService = $sqlCommonService.'("'.$propertyID.'", "'.$toRentData['commonServiceList'][$c].'")';
						else
							$sqlCommonService = $sqlCommonService.'("'.$propertyID.'", "'.$toRentData['commonServiceList'][$c].'"), ';
					}
					$queryCommonService = $this->db->query($sqlCommonService);
					if($this->db->error)
						$errorCatcher['Common service table'][] = $this->db->error;
						
					$sqlUniqueService = '
						insert into
							property_unique_service
								(
									property_ID,
									unique_service_link_ID
								)
							values 
					';
					for($c = 0; $c < count($toRentData['uniqueServiceList']); $c++){
						if($c == (count($toRentData['uniqueServiceList'])-1))
							$sqlUniqueService = $sqlUniqueService.'("'.$propertyID.'", "'.$toRentData['uniqueServiceList'][$c].'")';
						else
							$sqlUniqueService = $sqlUniqueService.'("'.$propertyID.'", "'.$toRentData['uniqueServiceList'][$c].'"), ';
					}
					$queryUniquenService = $this->db->query($sqlUniqueService);
					if($this->db->error)
						$errorCatcher['Unique service table'][] = $this->db->error;

					$sqlPrice = '
						insert into
							property_price
								(
									property_ID,
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
								)
							values
								(
									"'.$propertyID.'",
									'.$toRentData['priceList'][0].',
									'.$toRentData['priceList'][1].',
									'.$toRentData['priceList'][2].',
									'.$toRentData['priceList'][3].',
									'.$toRentData['priceList'][4].',
									'.$toRentData['priceList'][5].',
									'.$toRentData['priceList'][6].',
									'.$toRentData['priceList'][7].',
									'.$toRentData['priceList'][8].',
									'.$toRentData['priceList'][9].'
								)
					';
					$queryPrice = $this->db->query($sqlPrice);
					if($this->db->error)
						$errorCatcher['Price table'][] = $this->db->error;
				}
				if(empty($errorCatcher)){
					$returnRow = [
						$publicID,
						$toRentData['nameList'][$this->langList['portuguese']],
						'por definir',
						$toRentData['property']['propertyType'],
						$toRentData['property']['viewType'],
						(($toRentData['property']['hasPoolAccess'] == 1) ? 'Sim':'Não'),
						$toRentData['property']['maxAllowedGuests'],
						$toRentData['property']['roomAmmount'],
						$toRentData['property']['beachDistance'],
						(($toRentData['property']['isVisible'] == 1) ? 'Sim':'Não'),
						'Agora',
						'N/A',
						'<button class="btn btn-info btn-xs" id="show-gallery" href="#collapseGallery-'.$propertyID.'" data-toggle="collapse">
							<i class="lnr lnr-plus-circle"></i>
						</button>',
						'<a href="?edit=to-rent&id='.$propertyID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
						<button class="btn btn-danger btn-xs pull-right" id="delete-poi"><span class="lnr lnr-trash"></span></button>'
				
					];
					return $returnRow;
				}else{
					return $errorCatcher;
				}
            }

            public function deleteToRent($propertyID){
				$sqlDelete = '
                delete from 
                    property 
                where 
                    property_ID = '.$propertyID;
            $queryDelete = $this->db->query($sqlDelete);
            if($this->db->error)
                return $this->db->error;
            else
                return true;
            }

            public function addToRentPhoto(){
                
            }
            public function deleteToRentPhoto(){

            }
        /* Database Functions */

        /* Check and attributes new publicID  */
            private function generatePublicID($postalCode){
                $publicID = (int)($postalCode.intval('0'.rand(1,9).rand(0,9).rand(0,9)));
                $CheckExists = $this->db->query('
                    select 
                        publicID 
                    from
                        property
                ');
                while($r=$CheckExists->fetch_object()){
                    if($r->publicID == $publicID)
                        $publicID = (int)($postalCode.intval('0'.rand(1,9).rand(0,9).rand(0,9)));
                }
                return $publicID;
            }
        /* Check and attributes new publicID  */

        /* CONTROL CUSTOM FUNCTIONS */
            private function sanitizeInput(array $inputArray){
                $counter = 0;
                $filteredInput = [];
                foreach ($inputArray as $key => $value) {
                    if(substr($key, 0, 21) == 'to_rentCommonService_'){
                        $filteredInput['commonServiceList'][] = mysqli_real_escape_string($this->db, $value);
                        unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 21) == 'to_rentUniqueService_'){
                        $filteredInput['uniqueServiceList'][] = mysqli_real_escape_string($this->db, $value);
                        unset($filteredInput[$key]);
                	}elseif(substr($key, 0, 10) == 'to_rentCat'){
						$filteredInput['priceList'][] = mysqli_real_escape_string($this->db, $value);
						unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 12) == 'to_rentName-'){
						switch(strtolower(substr($key, -2))){
							case $this->langList['portuguese']: $filteredInput['nameList'][$this->langList['portuguese']] = mysqli_real_escape_string($this->db, $value);
								break;
							case $this->langList['english']: 	$filteredInput['nameList'][$this->langList['english']] = mysqli_real_escape_string($this->db, $value);
								break;
						}
						unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 16) == 'to_rentDescLong-'){
						switch(strtolower(substr($key, -2))){
							case $this->langList['portuguese']: $filteredInput['descLongList'][$this->langList['portuguese']] = mysqli_real_escape_string($this->db, $value);
								break;
							case $this->langList['english']: 	$filteredInput['descLongList'][$this->langList['english']] = mysqli_real_escape_string($this->db, $value);
								break;
						}
						unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 17) == 'to_rentDescShort-'){
						switch(strtolower(substr($key, -2))){
							case $this->langList['portuguese']: $filteredInput['descShortList'][$this->langList['portuguese']] = mysqli_real_escape_string($this->db, $value);
								break;
							case $this->langList['english']: 	$filteredInput['descShortList'][$this->langList['english']] = mysqli_real_escape_string($this->db, $value);
								break;
						}
						unset($filteredInput[$key]);
                    }else{
                        $filteredInput['property'][lcfirst(substr($key, 7))] = mysqli_real_escape_string($this->db, $value);
                    }
                }
                unset($filteredInput['property']['commonService']);
                unset($filteredInput['property']['uniqueService']);
                return $filteredInput;
            }   

            /* Checks if requirments are met to edit the administrator */
            public function showEditPage(string $var1, int $var2, bool $adminExists){
                if($var1 === "administrator" && is_int($var2)){
                    $x = 1;
                }else{ 
                    $x = 0;
                }
                if($adminExists == false){
                    $y = 1;
                }else{ 
                    $y = 0;
                }
                /* if 1 then all ok, if 0 then one of the conditions has failed */
                return $x*$y;
            }
            /* Checks if requirments are met to edit the administrator */

        /* CONTROL CUSTOM FUNCTIONS */
    }
?>