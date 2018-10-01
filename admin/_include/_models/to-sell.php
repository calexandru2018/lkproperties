<?php

    class ToSell{
                
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
					and
						property.isForSale = 1
				';
				$queryResult = $this->db->query($sqlFetchAll);
				while($r=$queryResult->fetch_object()){
					$output[] = $r;
				}
				return ((empty($output))? '' : $output);
            }

            public function fetch(int $propertyID){
				$sqlFetchProperty = '
					select 
						property.*,
						title_translation.title,
						title_translation.langCode as titleLangCode,
						short_desc_translation.shortDescription,
						short_desc_translation.langCode as shortLangCode,
						long_desc_translation.longDescription,
						long_desc_translation.langCode as longLangCode,
						property_city_poi.city_poi_link_ID,
                        property_city_poi.property_city_poi_ID
					from 
						property
					inner join
						title_link
					on
						property.property_ID = title_link.property_ID
					left join
						title_translation
					on
						title_link.title_link_ID = title_translation.title_link_ID
					inner join
						short_desc_link
					on
						property.property_ID = short_desc_link.property_ID
					left join
						short_desc_translation
					on
						short_desc_link.short_desc_link_ID = short_desc_translation.short_desc_link_ID
					inner join
						long_desc_link
					on
						property.property_ID = long_desc_link.property_ID
					left join
						long_desc_translation
					on
						long_desc_link.long_desc_link_ID = long_desc_translation.long_desc_link_ID
					left join 
						property_city_poi
					on	
						property.property_ID = property_city_poi.property_ID
					where
						property.property_ID = "'.$propertyID.'" 
					and
						property.isForSale = 1
				';
				$queryFetchProperty = $this->db->query($sqlFetchProperty);
				if($this->db->error)
					return $this->db->error;

				$c = 0;
				while($r=$queryFetchProperty->fetch_assoc()){
					if($r['titleLangCode'] == $this->langList['portuguese'] || $r['shortLangCode'] == $this->langList['portuguese'] || $r['longLangCode'] == $this->langList['portuguese']){
						$output[$this->langList['portuguese'].'_'.$c][] = $r;
					}elseif($r['titleLangCode'] == $this->langList['english'] || $r['shortLangCode'] == $this->langList['english'] || $r['longLangCode'] == $this->langList['english']){	
						$output[$this->langList['english'].'_'.$c][] = $r;
					}
					$c++;
				}
				return ((empty($output)) ? '':$output);
            }

			public function fetchServiceCommon(int $propertyID){
				$sqlFetch = $this->db->query('
					select 
						common_service_translation.common_service_link_ID,
						common_service_translation.serviceTranslated,
						property_common_service.property_ID
					FROM
						common_service_translation
					RIGHT JOIN
						common_service_link
					ON
						common_service_translation.common_service_link_ID = common_service_link.common_service_link_ID
					right JOIN
						property_common_service
					ON
						common_service_link.common_service_link_ID = property_common_service.common_service_link_ID 
					where 
						property_common_service.property_ID = "'.$propertyID.'" 
					and 
						common_service_translation.langCode = "'.$this->langList['portuguese'].'"
				');

				while($r=$sqlFetch->fetch_assoc()){
						$output[]= $r;
				}
				return ((empty($output)) ? '': $output);;
			}

			public function fetchServiceUnique(int $propertyID){
				$sqlFetch = $this->db->query('
					select 
						unique_service_translation.unique_service_link_ID,
						unique_service_translation.uniqueServiceTranslated,
						property_unique_service.property_unique_service_ID
					FROM
						unique_service_translation
					RIGHT JOIN
						unique_service_link
					ON
						unique_service_translation.unique_service_link_ID = unique_service_link.unique_service_link_ID
					right JOIN
						property_unique_service
					ON
						unique_service_link.unique_service_link_ID = property_unique_service.unique_service_link_ID 
					where 
						property_unique_service.property_ID = "'.$propertyID.'" 
					and 
						unique_service_translation.langCode = "'.$this->langList['portuguese'].'"
				');
				while($r=$sqlFetch->fetch_assoc()){
						$output[]= $r;
				}
				return ((empty($output)) ? '': $output);
			}

			public function fetchPrice(int $propertyID){
				$sqlFetch = $this->db->query('
					select 
						property_price_ID,
						cat1
					from
						property_price
					where
						property_ID = "'.$propertyID.'"
				');

				return $r=$sqlFetch->fetch_row();
			}

            public function insert(array $inputArray){
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
                                "1",
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
									cat10,
									minPrice,
									maxPrice
								)
							values
								(
									"'.$propertyID.'",
									"'.$toRentData['priceList'][0].'",
									"0",
									"0",
									"0",
									"0",
									"0",
									"0",
									"0",
									"0",
									"0",
									"0",
									"0"
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
						'<a href="?edit=to-sell&id='.$propertyID.'" class="btn btn-info btn-xs pull-left"  style="margin-bottom: 15px"><span class="lnr lnr-pencil"></span></a>
						<button class="btn btn-danger btn-xs pull-right" id="delete-poi"><span class="lnr lnr-trash"></span></button>'
				
					];
					return $returnRow;
				}else{
					return $errorCatcher;
				}
            }

            public function delete(int $propertyID, string $basePath){
				$sqlGetURL = '
				select 
					property_gallery_ID
				from
					property_gallery
				where
					property_ID = '.$propertyID.'
				';

				$queryGetURL = $this->db->query($sqlGetURL);

				if($this->db->error)
					return $this->db->error;
				
				while($r=$queryGetURL->fetch_object()){
					$this->deletePhoto($propertyID.'-'.$r->property_gallery_ID, $basePath, true);
				}
				
				if(file_exists($basePath.$propertyID)){
					if(file_exists($basePath.$propertyID.'/fullsize'))
						rmdir($basePath.$propertyID.'/fullsize');
					
					if(file_exists($basePath.$propertyID.'/thumbnail'))
						rmdir($basePath.$propertyID.'/thumbnail');

					if(!rmdir($basePath.$propertyID))
						return false;
				}

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

			public function fetchAllPhotos(string $propertyID){
				$sqlFetch = '
					select 
						*
					from
						property_gallery
					where 
						property_ID = "'.$propertyID.'"
				';
				$queryResult = $this->db->query($sqlFetch);
				while($r=$queryResult->fetch_object()){
					$output[] = $r;
				}
				return ((empty($output)) ? '': $output);
			}

            public function addPhoto(int $propertyID, string $thumbnailURL, string  $fullsizeURL){
				$sqlInsert = '
					insert into
						property_gallery(
							property_ID,
							thumbnailURL,
							fullsizeURL
						)
						values(
							"'.mysqli_real_escape_string($this->db, $propertyID).'",
							"'.mysqli_real_escape_string($this->db, $thumbnailURL).'",
							"'.mysqli_real_escape_string($this->db, $fullsizeURL).'"
						)
				';
				$queryInsert = $this->db->query($sqlInsert);
                if($this->db->error)
                    return $this->db->error;
                else
                    return true;
            }
            public function deletePhoto(string $photoID, string $basePath, int $deleteAll = null){
				$propertyPhotoID = explode('-', $photoID);
				$sqlSearchURL = '
					select 
						fullsizeURL,
						thumbnailURL
					from
						property_gallery
					where 
						property_ID = "'.$propertyPhotoID[0].'"
					and
						property_gallery_ID = "'.$propertyPhotoID[1].'"
				';
				if($queryDelete = $this->db->query($sqlSearchURL)){
					$urlHolder = $queryDelete->fetch_object();
					$sqlDeletePhoto = '
						delete from
							property_gallery
						where   
							property_ID = "'.$propertyPhotoID[0].'"
						and
							property_gallery_ID = "'.$propertyPhotoID[1].'"';
					
					$queryDelete = $this->db->query($sqlDeletePhoto);
					if($deleteAll)
						$basePath = $basePath.'/'.$propertyPhotoID[0].'/';
					if($queryDelete){
						if(unlink($basePath.'fullsize/'.$urlHolder->fullsizeURL) && unlink($basePath.'thumbnail/'.$urlHolder->thumbnailURL))
							return true;
						else 
							return false;
					}else{
						return false;
					}
				}
			}
			
			public function updateName(int $propertyID, array $inputArray){
				$langSortedNames = array();
				$errorCather = array();
				$langCounter = 0;
				foreach($inputArray as $key => $value){
					$holder[] = explode('-', $key);                
					$langSortedNames[strtolower($holder[$langCounter][1])][] = $value[0];
					$langCounter++;
				}
				$fetchTitleLinkID = $this->db->query('
					select 
						title_link_ID
					from
						title_link
					where
						property_ID = "'.$propertyID.'"
				');
				$fetchedObject = $fetchTitleLinkID->fetch_object();
				foreach($langSortedNames as $lang => $name){
					$sqlUpdatepoi = '
						update 
							title_translation 
						set 
							title = "'.mysqli_real_escape_string($this->db, $name[0]).'"
						where 
							langCode = "'.$lang.'"
						and
							title_link_ID = '.$fetchedObject->title_link_ID;
					$queryUpdateDes = $this->db->query($sqlUpdatepoi);
					if($this->db->error)
						$errorCather[] = $this->db->error;
				}
				if(empty($errorCather))
					return true;
				else
					return false;
			} 
			public function updateShortDesc(int $propertyID, array $inputArray){
				$langSortedNames = array();
				$errorCather = array();
				$langCounter = 0;
				foreach($inputArray as $key => $value){
					$holder[] = explode('-', $key);                
					$langSortedNames[strtolower($holder[$langCounter][1])][] = $value[0];
					$langCounter++;
				}
				$fetchTitleLinkID = $this->db->query('
					select 
						short_desc_link_ID
					from
						short_desc_link
					where
						property_ID = "'.$propertyID.'"
				');
				$fetchedObject = $fetchTitleLinkID->fetch_object();
				foreach($langSortedNames as $lang => $name){
					$sqlUpdatepoi = '
						update 
							short_desc_translation 
						set 
							shortDescription = "'.mysqli_real_escape_string($this->db, $name[0]).'"
						where 
							langCode = "'.$lang.'"
						and
							short_desc_link_ID = '.$fetchedObject->short_desc_link_ID;
					$queryUpdateDes = $this->db->query($sqlUpdatepoi);
					if($this->db->error)
						$errorCather[] = $this->db->error;
				}
				if(empty($errorCather))
					return true;
				else
					return false;
			} 
			public function updateLongDesc(int $propertyID, array $inputArray){
				$langSortedNames = array();
				$errorCather = array();
				$langCounter = 0;
				var_dump($inputArray);
				foreach($inputArray as $key => $value){
					$holder[] = explode('-', $key);                
					$langSortedNames[strtolower($holder[$langCounter][1])][] = $value;
					$langCounter++;
				}
				var_dump($langSortedNames);
				$fetchTitleLinkID = $this->db->query('
					select 
						long_desc_link_ID
					from
						long_desc_link
					where
						property_ID = "'.$propertyID.'"
				');
				$fetchedObject = $fetchTitleLinkID->fetch_object();
				foreach($langSortedNames as $lang => $name){
					$sqlUpdatepoi = '
						update 
							long_desc_translation 
						set 
							longDescription = "'.mysqli_real_escape_string($this->db, $name[0]).'"
						where 
							langCode = "'.$lang.'"
						and
							long_desc_link_ID = '.$fetchedObject->long_desc_link_ID;
					$queryUpdateDes = $this->db->query($sqlUpdatepoi);
					if($this->db->error)
						$errorCather[] = $this->db->error;
				}
				if(empty($errorCather))
					return true;
				else
					return false;
			} 
			public function updateService(int $propertyID, array $inputArray){
				$servicesData = $this->sanitizeInput($inputArray);
				print_r($servicesData);
				$errorCatcher = [];
 
				$sqlDropCommonService = '
					delete from
						property_common_service
					where
						property_ID = "'.$propertyID.'"
				';
				$queryDropCommonService = $this->db->query($sqlDropCommonService);
				if($this->db->error)
					$errorCatcher['drop common service'] = $this->db->error; 

				$sqlInsertCommonService = '
					insert into
						property_common_service
							(
								property_ID,
								common_service_link_ID
							)
					values 
				'; 
				for($c = 0; $c < count($servicesData['commonServiceList']); $c++){
					if($c == (count($servicesData['commonServiceList']) - 1))	
						$sqlInsertCommonService = $sqlInsertCommonService.'("'.$propertyID.'","'.$servicesData['commonServiceList'][$c].'")';
					else
						$sqlInsertCommonService = $sqlInsertCommonService.'("'.$propertyID.'","'.$servicesData['commonServiceList'][$c].'"), ';
				}
				$queryInsertCommonService = $this->db->query($sqlInsertCommonService);
				if($this->db->error)
					$errorCatcher['insert common service'] = $this->db->error;

				$sqlDropUniqueService = '
					delete from
						property_unique_service
					where
						property_ID = "'.$propertyID.'"
				';
				$querylDropUniqueService = $this->db->query($sqlDropUniqueService);
				if($this->db->error)
					$errorCatcher['drop unique service'] = $this->db->error; 

				$sqlInsertUniqueService = '
					insert into
						property_unique_service
							(
								property_ID,
								unique_service_link_ID
							)
					values 
				'; 
				for($c = 0; $c < count($servicesData['uniqueServiceList']); $c++){
					if($c == (count($servicesData['uniqueServiceList']) - 1))	
						$sqlInsertUniqueService = $sqlInsertUniqueService.'("'.$propertyID.'","'.$servicesData['uniqueServiceList'][$c].'")';
					else
						$sqlInsertUniqueService = $sqlInsertUniqueService.'("'.$propertyID.'","'.$servicesData['uniqueServiceList'][$c].'"), ';
				}
 				$queryInsertUniqueService = $this->db->query($sqlInsertUniqueService);
				if($this->db->error)
					$errorCatcher['add unique service'] = $this->db->error;

				if(empty($errorCatcher))
					return true;
				else
					return $errorCatcher; 
					// print_r($sqlInsertCommonService);
					// print_r($sqlInsertUniqueService);

			}
			public function updateOther(int $propertyID, array $inputArray){
				var_dump($inputArray);
				$errorCatcher = array();
				$sqlUpdateProperty = '
					update
						property
					set
						propertyType ="'.(int)mysqli_real_escape_string($this->db, $inputArray['to_sellPropertyType'][0]).'",
						viewType ="'.(int)mysqli_real_escape_string($this->db, $inputArray['to_sellViewType'][0]).'",
						hasPoolAccess ="'.(($inputArray['to_sellHasPoolAccess'] == 'checked') ? 1 : 0).'",
						isVisible ="'.(($inputArray['to_sellIsVisible'] == 'checked') ? 1 : 0).'",
						roomAmmount ="'.(int)mysqli_real_escape_string($this->db, $inputArray['to_sellRoomAmmount'][0]).'",
						maxAllowedGuests ="'.(int)mysqli_real_escape_string($this->db, $inputArray['to_sellMaxAllowedGuests'][0]).'",
						beachDistance ="'.(int)mysqli_real_escape_string($this->db, $inputArray['to_sellBeachDistance'][0]).'"
					where
						property_ID = "'.$propertyID.'"
				';
				$queryUpdateProperty = $this->db->query($sqlUpdateProperty);
				if($this->db->error)
					$errorCatcher[] = $this->db->error;

				$explodedID = explode('-', $inputArray['to_sellCityPoi'][0]);
				$sqlUpdatePropertyCityPoi = '
					update
						property_city_poi
					set
						city_poi_link_ID = "'.$explodedID[1].'"
					where
						property_ID = "'.$propertyID.'"
					and
						property_city_poi_ID = "'.$explodedID[0].'"
				';
				$queryUpdatePropertyCityPoi = $this->db->query($sqlUpdatePropertyCityPoi);
				if($this->db->error)
					$errorCatcher[] = $this->db->error;

				if(empty($errorCatcher))
					return true;
				else
					return $errorCatcher;
			}
			public function updatePriceList(int $propertyID, array $inputArray){

				$c = 1;
				$fetchPropertyPriceID = $this->db->query('
					select 
						property_price_ID
					from
						property_price
					where
						property_ID = "'.$propertyID.'"
				');
				$fetchedObject = $fetchPropertyPriceID->fetch_object();
				foreach($inputArray as $key => $value){
					var_dump($key, $value[0], $c);
					$sqlUpdatepoi = '
						update 
							property_price 
						set 
							cat'.$c.' = "'.mysqli_real_escape_string($this->db, $value[0]).'"
						where 
							property_price_ID = '.$fetchedObject->property_price_ID;
						$queryUpdateDes = $this->db->query($sqlUpdatepoi);
						if($this->db->error)
							$errorCather[] = $this->db->error;
					$c++;
				}
 				if(empty($errorCather))
					return true;
				else
					return false;
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
                    if(substr($key, 0, 21) == 'to_sellCommonService_'){
                        $filteredInput['commonServiceList'][] = mysqli_real_escape_string($this->db, $value);
                        unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 21) == 'to_sellUniqueService_'){
                        $filteredInput['uniqueServiceList'][] = mysqli_real_escape_string($this->db, $value);
                        unset($filteredInput[$key]);
                	}elseif(substr($key, 0, 12) == 'to_sellPrice'){
						$filteredInput['priceList'][] = mysqli_real_escape_string($this->db, $value);
						unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 12) == 'to_sellName-'){
						switch(strtolower(substr($key, -2))){
							case $this->langList['portuguese']: $filteredInput['nameList'][$this->langList['portuguese']] = mysqli_real_escape_string($this->db, $value);
								break;
							case $this->langList['english']: 	$filteredInput['nameList'][$this->langList['english']] = mysqli_real_escape_string($this->db, $value);
								break;
						}
						unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 16) == 'to_sellDescLong-'){
						switch(strtolower(substr($key, -2))){
							case $this->langList['portuguese']: $filteredInput['descLongList'][$this->langList['portuguese']] = mysqli_real_escape_string($this->db, $value);
								break;
							case $this->langList['english']: 	$filteredInput['descLongList'][$this->langList['english']] = mysqli_real_escape_string($this->db, $value);
								break;
						}
						unset($filteredInput[$key]);
                    }elseif(substr($key, 0, 17) == 'to_sellDescShort-'){
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
                if($var1 === "to-sell" && is_int($var2)){
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