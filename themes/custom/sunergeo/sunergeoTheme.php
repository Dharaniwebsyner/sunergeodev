<?php

/**
 * Implements template_preprocess_page().
 */

function vitero_preprocess_node__wall_tiles(&$variables) {

	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');



	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


   /*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	//echo "<pre>"; print_r($final); echo "</pre>";

	$variables['selected_filters'] = $final;

	/* Get query Strings and count */

	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
		
	/* check to keep ? or & in the URL END*/

   //echo "<pre>"; print_r($query_strings); exit;
   
   /* GET the data - START */
   $nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){

			if( $query_filter_page == 1  && $query_strings == 0){
				//print_r("here"); //exit;
				$variables['f_data_initial'][] = $all_data;
				$nid = $all_data->nid->value;
				$path = '/node/' . (int) $nid;
				$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
				$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
				$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
				$nids[] = $all_data->nid->value;
			}

			if(count($final) == 1 ){

				if($query_filter_category){
					foreach ($all_data->field_product_category as $key => $category_value) {
						if($query_filter_category === $category_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_application){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_size){
					foreach ($all_data->field_product_sizes as $key => $sizes_value) {
						if($query_filter_size === $sizes_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_color){
					foreach ($all_data->field_product_color as $key => $color_value) {
						if($query_filter_color === $color_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_finish){
					foreach ($all_data->field_product_finish as $key => $finish_value) {
						if($query_filter_finish === $finish_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

			}

			if(count($final) == 2 ){

				if($query_filter_category && $query_filter_application){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							$variables['data_first'][] = $all_data;
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_size){
					foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
							if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
								//echo $key; print_r("heaaere");
								$variables['data_first'][] = $all_data;
								//$s_1_nids[] = $all_data->nid->value;
							}
						}
				}

				if($query_filter_category && $query_filter_color){
					
						foreach ($all_data->field_product_color as $key => $color_value) {
							if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
								//echo $key; print_r("heaaere");
								$variables['data_first'][] = $all_data;
								//$s_1_nids[] = $all_data->nid->value;
							}
						}
				}

				if($query_filter_category && $query_filter_finish){
					foreach ($all_data->field_product_finish as $key => $color_value) {
							if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
								//echo $key; print_r("heaaere");
								$variables['data_first'][] = $all_data;
								//$s_1_nids[] = $all_data->nid->value;
							}
						}
				}

				if($query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_application && $query_filter_color){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value){
							foreach ($all_data->field_product_color as $key => $size_value) {
								if($query_filter_color === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_application && $query_filter_finish){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_size){
					foreach ($all_data->field_product_color as $keySF => $color_value) {
						if($query_filter_color === $color_value->value){
							foreach ($all_data->field_product_sizes as $keySF => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_finish && $query_filter_size){
					foreach ($all_data->field_product_finish as $keySF => $finish_value) {
						if($query_filter_finish === $finish_value->value){
							foreach ($all_data->field_product_sizes as $keySF => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_finish){
					foreach ($all_data->field_product_color as $keySF => $color_value) {
						if($query_filter_color === $color_value->value){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}
			}

			if(count($final) == 3 ){

				if($query_filter_category && $query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_color){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_finish){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}

				}

				if($query_filter_color && $query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_finish && $query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_finish && $query_filter_size){
					foreach ($all_data->field_product_color as $keyCS => $color_value) {
						if($query_filter_color === $color_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_application && $query_filter_finish){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_finish && $query_filter_color){
					foreach ($all_data->field_product_color as $keyCS => $color_value) {
						if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}

				}

				if($query_filter_category && $query_filter_finish && $query_filter_size){
					foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
						if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_color && $query_filter_size){
					foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
						if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

			}
			if(count($final) == 4 ){

				if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}	
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
					foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
						if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

				}

			}

			if(count($final) == 5 ){
				if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
					foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											foreach ($all_data->field_product_sizes as $key => $size_value) {
												if($query_filter_size === $size_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
    /* GET the data - END */

	// echo "<pre>"; print_r(count($variables['data_first'])); echo "</pre>";

    /* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category[0]->entity->name->value == "Wall Tiles" || isset($value->field_category[1]))
		{
			$variables['filter_field_cat'][] = $value->field_product_category->value;

			foreach ($value->field_product_finish as $key => $f_value) {
				$variables['filter_field_product_finish'][] = $f_value->value;
			}
			foreach ($value->field_product_sizes as $key => $s_value) {
				$variables['filter_field_product_size'][] = $s_value->value;
			}
			foreach ($value->field_product_color as $key => $d_value) {
				$variables['filter_field_product_colors'][] = $d_value->value;
			}
			foreach ($value->field_room_suitability_floor as $key => $sf_value) {
				$variables['filter_field_product_sus_f'][] = $sf_value->value;
			}
			foreach ($value->field_room_suitability_wall as $key => $sw_value) {
				$variables['filter_field_product_sus_w'][] = $sw_value->value;
			}
		}
	}


   $variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
   $variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
   $variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
   $variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
   $variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
   $variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
   $variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

   /* filters end */

   //get FAQ data
   $faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

  // Get all FAQ node IDs.
  $faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

  // Load all FAQ nodes.
  $faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

  // Pass them to twig.
  $variables['faqs'] = $faq_nodes;

  $variables['faq_data'] = $variables['faqs'];
   foreach ($variables['faq_data'] as $key => $value) {
   	 $variables['faq_data_result'][] = $value;
   }
}

function vitero_preprocess_node__floor_tiles(&$variables) {

	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');



	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


   /*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$variables['selected_filters'] = $final;
	/*echo "<pre>"; print_r($final); echo "</pre>";*/

	/* Get query Strings and count */

	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
		
	/* check to keep ? or & in the URL END*/

   //echo "<pre>"; print_r($query_strings); exit;
   
   /* GET the data - START */
   $nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){

			if( $query_filter_page == 1  && $query_strings == 0){
				//print_r("here"); //exit;
				$variables['f_data_initial'][] = $all_data;
				$nid = $all_data->nid->value;
				$path = '/node/' . (int) $nid;
				$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
				$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
				$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
				$nids[] = $all_data->nid->value;
			}

			if(count($final) == 1 ){

				if($query_filter_category){
					foreach ($all_data->field_product_category as $key => $category_value) {
						if($query_filter_category === $category_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_application){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_size){
					foreach ($all_data->field_product_sizes as $key => $sizes_value) {
						if($query_filter_size === $sizes_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_color){
					foreach ($all_data->field_product_color as $key => $color_value) {
						if($query_filter_color === $color_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

				if($query_filter_finish){
					foreach ($all_data->field_product_finish as $key => $finish_value) {
						if($query_filter_finish === $finish_value->value){
							$variables['data_first'][] = $all_data;
						}
					}
				}

			}

			if(count($final) == 2 ){

				if($query_filter_category && $query_filter_application){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							$variables['data_first'][] = $all_data;
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_size){
					foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
							if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
								//echo $key; print_r("heaaere");
								$variables['data_first'][] = $all_data;
								//$s_1_nids[] = $all_data->nid->value;
							}
						}
				}

				if($query_filter_category && $query_filter_color){
					
						foreach ($all_data->field_product_color as $key => $color_value) {
							if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
								//echo $key; print_r("heaaere");
								$variables['data_first'][] = $all_data;
								//$s_1_nids[] = $all_data->nid->value;
							}
						}
				}

				if($query_filter_category && $query_filter_finish){
					foreach ($all_data->field_product_finish as $key => $color_value) {
							if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
								//echo $key; print_r("heaaere");
								$variables['data_first'][] = $all_data;
								//$s_1_nids[] = $all_data->nid->value;
							}
						}
				}

				if($query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_application && $query_filter_color){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value){
							foreach ($all_data->field_product_color as $key => $size_value) {
								if($query_filter_color === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_application && $query_filter_finish){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
						if($query_filter_application === $color_value->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_size){
					foreach ($all_data->field_product_color as $keySF => $color_value) {
						if($query_filter_color === $color_value->value){
							foreach ($all_data->field_product_sizes as $keySF => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_finish && $query_filter_size){
					foreach ($all_data->field_product_finish as $keySF => $finish_value) {
						if($query_filter_finish === $finish_value->value){
							foreach ($all_data->field_product_sizes as $keySF => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_finish){
					foreach ($all_data->field_product_color as $keySF => $color_value) {
						if($query_filter_color === $color_value->value){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}
			}

			if(count($final) == 3 ){

				if($query_filter_category && $query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_color){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_finish){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}

				}

				if($query_filter_color && $query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_finish && $query_filter_application && $query_filter_size){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_finish && $query_filter_size){
					foreach ($all_data->field_product_color as $keyCS => $color_value) {
						if($query_filter_color === $color_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_color && $query_filter_application && $query_filter_finish){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_finish && $query_filter_color){
					foreach ($all_data->field_product_color as $keyCS => $color_value) {
						if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}

				}

				if($query_filter_category && $query_filter_finish && $query_filter_size){
					foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
						if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
							//echo $key; print_r("heaaere");
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
							
							//$s_1_nids[] = $all_data->nid->value;
						}
					}
				}

				if($query_filter_category && $query_filter_color && $query_filter_size){
					foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
						if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}
					}
				}

			}
			if(count($final) == 4 ){

				if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}	
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
					foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
						if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_sizes as $key => $size_value) {
								if($query_filter_size === $size_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}
				}

				if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

				}

			}

			if(count($final) == 5 ){
				if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
					foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
						if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											foreach ($all_data->field_product_sizes as $key => $size_value) {
												if($query_filter_size === $size_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
    /* GET the data - END */

    
   /* Trim array data for pagination count START */
   $variables['items_count'] = count($variables['f_data_2']);
   
   if($query_filter_page){
   
   	$variables['f_data_2'] = array_slice($variables['f_data_2'], 12*($query_filter_page-1), 12, true);
   	$variables['query_filter_page'] = $query_filter_page;
   }else{
   		$variables['query_filter_page'] = 1;
   }
    
   /* Trim array data for pagination count  END */

   //print_r(count($variables['f_data_2'])); exit;

    /* filters start */

   foreach ($variables['f_data'] as $key => $value) {
   	if($value->field_category[0]->entity->name->value == "Floor Tiles")
		{
			$variables['filter_field_cat'][] = $value->field_product_category->value;
			
			foreach ($value->field_product_finish as $key => $f_value) {
				$variables['filter_field_product_finish'][] = $f_value->value;
			}
			foreach ($value->field_product_sizes as $key => $s_value) {
				$variables['filter_field_product_size'][] = $s_value->value;
			}
			foreach ($value->field_product_color as $key => $d_value) {
				$variables['filter_field_product_colors'][] = $d_value->value;
			}
			foreach ($value->field_room_suitability_floor as $key => $sf_value) {
				$variables['filter_field_product_sus_f'][] = $sf_value->value;
			}
			foreach ($value->field_room_suitability_wall as $key => $sw_value) {
				$variables['filter_field_product_sus_w'][] = $sw_value->value;
			}
		}
	}




   $variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
   $variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
   $variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
   $variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
   $variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
   $variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
   $variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

   /* filters end */

   //get FAQ data
   $faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

  // Get all FAQ node IDs.
  $faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

  // Load all FAQ nodes.
  $faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

  // Pass them to twig.
  $variables['faqs'] = $faq_nodes;

  $variables['faq_data'] = $variables['faqs'];
   foreach ($variables['faq_data'] as $key => $value) {
   	 $variables['faq_data_result'][] = $value;
   }
}


function vitero_preprocess_region__footer1(&$variables) {

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 1 menu items node IDs.
	$nids = $query->condition('type', 'footer_menu_1')->execute();

	// Load all menu footer 1 menu items.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to region--footer1.html.twig.
	$variables['data'] = $nodes;
	$variables['f1_data'] = $variables['data'];
	foreach ($variables['f1_data'] as $key => $value) {
		$variables['f_data'][] = $value;
	}
}

function vitero_preprocess_region__footer2(&$variables) {

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 2 menu items node IDs.
	$nids = $query->condition('type', 'footer_menu_2')->execute();

	// Load all menu footer 2 menu items.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to region--footer2.html.twig.
	$variables['data'] = $nodes;
	$variables['f2_data'] = $variables['data'];
	foreach ($variables['f2_data'] as $key => $value) {
		$variables['f_data'][] = $value;
	}
}

function vitero_preprocess_region__footer3(&$variables) {

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$nids = $query->condition('type', 'footer_menu_3_ft3')->execute();

	// Load all menu footer 3 menu items.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to region--footer3.html.twig.
	$variables['data'] = $nodes;
	$variables['f3_data'] = $variables['data'];
	foreach ($variables['f3_data'] as $key => $value) {
		$variables['f_data'][] = $value;
	}
}

function vitero_preprocess_region__footer4(&$variables) {

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$nids = $query->condition('type', 'footer_section_4')->execute();

	// Load all menu footer 3 menu items.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to region--footer3.html.twig.
	$variables['data'] = $nodes;
	$variables['f4_data'] = $variables['data'];
	foreach ($variables['f4_data'] as $key => $value) {
		$variables['f_data'][] = $value;
	}

 // 	echo "<pre>";
	// print_r("field_category"); print_r($variables['f_data'][0]);
	// print_r("end"); 
	// exit;
}

function vitero_preprocess_region__footer5(&$variables) {

	$sl_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$sl_nids = $sl_query->condition('type', 'social_links')->execute();

	// Load all menu footer 3 menu items.
	$sl_nodes = \Drupal\node\Entity\Node::loadMultiple($sl_nids);

	// Pass them to region--footer3.html.twig.
	$variables['sl_data'] = $sl_nodes;
	$variables['sl_f5_data'] = $variables['sl_data'];
	foreach ($variables['sl_f5_data'] as $key => $value) {
		$variables['f_data_sl'][] = $value;
	}

   // copyright text
	$sl_queryas = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$sl_ssnids = $sl_queryas->condition('type', 'footer_section_5')->execute();

	// Load all menu footer 3 menu items.
	$sl_nasasodes = \Drupal\node\Entity\Node::loadMultiple($sl_ssnids);

	//echo "<pre>"; echo "sass"; print_r($sl_ssnids); exit;

	// Pass them to region--footer3.html.twig.
	$variables['sl__data'] = $sl_nasasodes;
	$variables['sl_f5__data'] = $variables['sl__data'];
	foreach ($variables['sl_f5__data'] as $key => $value) {
		$variables['f_data_sl_f'] = $value;
	}

	// privacy_and_disclaimer_links
	$pd_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all privacy_and_disclaimer_links items node IDs.
	$pd_nids = $pd_query->condition('type', 'privacy_and_disclaimer_links')->execute();

	// Load all privacy_and_disclaimer_links items.
	$pd_nodes = \Drupal\node\Entity\Node::loadMultiple($pd_nids);

	// Pass them to region--footer5.html.twig.
	$variables['pd_data'] = $pd_nodes;
	$variables['pd_f5_data'] = $variables['pd_data'];
	foreach ($variables['pd_f5_data'] as $key => $value) {
		$variables['f_data_pd'] = $value;
	}
	

	//cin_number_1
	$cin_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all privacy_and_disclaimer_links items node IDs.
	$cin_nids = $cin_query->condition('type', 'cin_number_1')->execute();

	// Load all privacy_and_disclaimer_links items.
	$cin_nodes = \Drupal\node\Entity\Node::loadMultiple($cin_nids);

	// Pass them to region--footer5.html.twig.
	$variables['cin_data'] = $cin_nodes;
	$variables['cin_f5_data'] = $variables['cin_data'];
	foreach ($variables['cin_f5_data'] as $key => $value) {
		$variables['f_data_cin'] = $value;
	}
	//echo "<pre>"; echo "sad"; print_r($variables['f_data_cin']); exit;

	$blog_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$blog_nids = $blog_query->condition('type', 'blog')->execute();

	// Load all menu footer 3 menu items.
	$blog_nodes = \Drupal\node\Entity\Node::loadMultiple($blog_nids);

	// Pass them to region--footer3.html.twig.
	$variables['blog_data'] = $blog_nodes;
	$variables['blog_f5_data'] = $variables['blog_data'];
	foreach ($variables['blog_f5_data'] as $key => $value) {
		$variables['f_data_blog'][] = $value;
	}
	//echo "<pre>"; echo "sad"; print_r($variables['f_data_blog']); exit;
}

function vitero_preprocess_region__secondary_navigation(&$variables) {

	$sl_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$sl_nids = $sl_query->condition('type', 'secondary_menu')->execute();

	// Load all menu footer 3 menu items.
	$sl_nodes = \Drupal\node\Entity\Node::loadMultiple($sl_nids);

	// Pass them to region--footer3.html.twig.
	$variables['sl_data'] = $sl_nodes;
	$variables['sl_f5_data'] = $variables['sl_data'];
	foreach ($variables['sl_f5_data'] as $key => $value) {
		$variables['f_data_sl'][] = $value;
	}

	//echo "<pre>"; echo "sad"; print_r($variables['f_data_sl']); exit;
}

function vitero_preprocess_region__primary_navigation(&$variables) {

	$sl_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$sl_nids = $sl_query->condition('type', 'primary_menu')->execute();

	// Load all menu footer 3 menu items.
	$sl_nodes = \Drupal\node\Entity\Node::loadMultiple($sl_nids);

	// Pass them to region--footer3.html.twig.
	$variables['sl_data'] = $sl_nodes;
	$variables['sl_f5_data'] = $variables['sl_data'];
	foreach ($variables['sl_f5_data'] as $key => $value) {
		$variables['f_data_sl'][] = $value;
	}

	//echo "<pre>"; echo "sad"; print_r($variables['f_data_sl']); exit;

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];

	foreach ($variables['f_data'] as $key => $value) {
		$variables['filter_field_cat'][] = $value->field_product_category->value;
		$variables['filter_field_product_sus_w'][] = $value->field_room_suitability_wall->value;
		$variables['filter_field_product_sus_f'][] = $value->field_room_suitability_floor->value;
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_application'] = array_unique(array_merge($variables['filter_field_product_sus_w'], $variables['filter_field_product_sus_f']));
	//echo "<pre>"; echo "sad"; print_r($variables['filter_product_application']); exit;
}

function vitero_preprocess_node__blog_page(&$variables) {
	$variables['#cache']['contexts'][] = 'url.query_args';
	

	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}
	$blog_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get all footer 3 menu items node IDs.
	$blog_nids = $blog_query->condition('type', 'blog')->execute();

	// Load all menu footer 3 menu items.
	$blog_nodes = \Drupal\node\Entity\Node::loadMultiple($blog_nids);
	//$variables['node']->getCreatedTime();
	// Pass them to region--footer3.html.twig.
	$variables['blog_data'] = $blog_nodes;
	$variables['blog_f5_data'] = $variables['blog_data'];
	foreach ($variables['blog_f5_data'] as $key => $value) {
		$variables['f_data_blog'][] = $value;
		$nid = $value->nid->value;
		$path = '/node/' . (int) $nid;
		$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
		$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
		$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
		//$nids[] = $value->nid->value;
	}
	

	$variables['items_count'] = count($variables['f_data_blog']);
	if($query_filter_page){
		$variables['f_data_blog'] = array_slice($variables['f_data_blog'], 6*($query_filter_page-1), 6, true);
		$variables['query_filter_page'] = $query_filter_page;
	}else{
			$variables['query_filter_page'] = 1;
	}
	//echo "<pre>"; echo "sad"; var_dump(count($variables['f_data_blog'])); exit;
}

function vitero_preprocess_node__blog(&$vars) {

	$nid = $vars['node']->nid->value;

	$blog_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get all footer 3 menu items node IDs.
	$blog_nids = $blog_query->condition('type', 'blog')->execute();

	// Load all menu footer 3 menu items.
	$blog_nodes = \Drupal\node\Entity\Node::loadMultiple($blog_nids);
	//$variables['node']->getCreatedTime();
	// Pass them to region--footer3.html.twig.
	$vars['blog_data'] = $blog_nodes;
	$vars['blog_f5_data'] = $vars['blog_data'];
	foreach ($vars['blog_f5_data'] as $key => $value) {
		$vars['f_data_blog'][] = $value;
	}

	//echo "<pre>"; var_dump($vars['f_data_blog']); exit;

	foreach ($vars['f_data_blog'] as $key1 => $value1) {
		if($value1->nid->value == $nid){
			$prev_node = $vars['f_data_blog'][$key1-1];
			$next_node = $vars['f_data_blog'][$key1+1];
			$vars['data_author'] = $value1;
		}
	}
	//echo "<pre>"; var_dump($vars['data_author']); exit;
	/*echo "<pre>"; echo "ssadtttttt"; var_dump($variables['prev_node']->get('title')->value);  
	echo "<pre>"; echo "ssad"; var_dump($variables['prev_node']); 
	echo "<pre>"; echo "ssad"; print_r($variables['next_node']); 
	exit;*/
	$vars['alias_previous'] = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$prev_node->nid->value);
	$vars['alias_next'] = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$next_node->nid->value);
	$vars['title_previous'] ="";
	$vars['title_next']="";
	if($prev_node){
		$vars['title_previous'] = $prev_node->get('title')->value;
		$vars['image_previous'] = $prev_node->field_blog_image->value;

		$blog_prev_nodes = \Drupal\node\Entity\Node::load($prev_node->nid->value);
		//$variables['node']->getCreatedTime();
		// Pass them to region--footer3.html.twig.
		$vars['blog_data_prev'] = $blog_prev_nodes;
		$vars['blog_f5_data_prev'] = $vars['blog_data_prev'];
		foreach ($vars['blog_f5_dataprev'] as $key => $value) {
			$vars['f_data_blog_prev'] = $value;
		}
	}
	if($next_node){
		$vars['title_next'] = $next_node->get('title')->value;
		$vars['image_next'] = $next_node->nid->value;

		//next_node_data
		$blog_next_nodes = \Drupal\node\Entity\Node::load($next_node->nid->value);
		//$variables['node']->getCreatedTime();
		// Pass them to region--footer3.html.twig.
		$vars['blog_data_next'] = $blog_next_nodes;
		$vars['blog_f5_data_next'] = $vars['blog_data_next'];
		foreach ($vars['blog_f5_data_next'] as $key => $value) {
			$vars['f_data_blog_next'] = $value;
		}
	}

   /*	echo "asd"; echo "<pre>"; print_r($vars['f_data_blog_prev']->nid->value);
	echo "11asd11"; echo "<pre>"; print_r($vars['f_data_blog_prev']); exit;*/


	$blog_node = \Drupal\node\Entity\Node::load($nid);
	$vars['node_data'] = $blog_node;
	$vars['blog_f5_daaata'] = $vars['node_data'];

	$vars["next_node"] = $next_node;
	$vars["prev_node"] = $prev_node;
	// echo "asd"; echo "<pre>"; print_r($next_node->nid->value); 
	// echo "asdas"; echo "<pre>"; print_r($next_node->field_banner_image_blog->getValue()); 
	// exit;
        if(isset($vars['node'])) {
            $vars['title'] = $vars['node']->title->value;
            $vars['created'] = $vars['node']->created->value;
        }
        else{
           $vars['title'] =$vars['page']['#title'];
        }
        //echo "<pre>"; echo "ssad"; print_r($vars['node']->created->value); exit;
} 

function vitero_preprocess_node__media_page(&$variables) {
	$variables['#cache']['contexts'][] = 'url.query_args';
	

	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}
	$blog_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get all footer 3 menu items node IDs.
	$blog_nids = $blog_query->condition('type', 'media_articles')->execute();

	// Load all menu footer 3 menu items.
	$blog_nodes = \Drupal\node\Entity\Node::loadMultiple($blog_nids);
	//$variables['node']->getCreatedTime();
	// Pass them to region--footer3.html.twig.
	$variables['blog_data'] = $blog_nodes;
	$variables['blog_f5_data'] = $variables['blog_data'];
	foreach ($variables['blog_f5_data'] as $key => $value) {
		$variables['f_data_blog'][] = $value;
		$nid = $value->nid->value;
		$path = '/node/' . (int) $nid;
		$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
		$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
		$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
		//$nids[] = $value->nid->value;
	}
	//echo "<pre>"; echo "sadaaaaa"; var_dump(count($variables['f_data_blog'])); //exit;
	//echo "<pre>"; echo "sadaa"; var_dump(count($variables['f_data_blog'])); exit;
	$variables['items_count'] = count($variables['f_data_blog']);
	if($query_filter_page ){
		$variables['f_data_blog'] = array_slice($variables['f_data_blog'], 6*($query_filter_page-1), 6, true);
		$variables['query_filter_page'] = $query_filter_page;
	}else{
			$variables['query_filter_page'] = 1;
	}
	//echo "<pre>"; echo "sad"; var_dump(($variables['f_data_blog'])); exit;
	//echo "<pre>"; echo "sad"; var_dump(count($variables['f_data_blog'])); exit;
}

function vitero_preprocess_node__media_articles(&$vars) {
    //exit;
	$nid = $vars['node']->nid->value;

	$blog_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get all footer 3 menu items node IDs.
	$blog_nids = $blog_query->condition('type', 'media_articles')->execute();

	// Load all menu footer 3 menu items.
	$blog_nodes = \Drupal\node\Entity\Node::loadMultiple($blog_nids);
	//$variables['node']->getCreatedTime();
	// Pass them to region--footer3.html.twig.
	$vars['blog_data'] = $blog_nodes;
	$vars['blog_f5_data'] = $vars['blog_data'];
	foreach ($vars['blog_f5_data'] as $key => $value) {
		$vars['f_data_blog'][] = $value;
	}


	foreach ($vars['f_data_blog'] as $key1 => $value1) {
		if($value1->nid->value == $nid){
			$prev_node = $vars['f_data_blog'][$key1-1];
			$next_node = $vars['f_data_blog'][$key1+1];
		}
	}
	/*echo "<pre>"; echo "ssadtttttt"; var_dump($variables['prev_node']->get('title')->value);  
	echo "<pre>"; echo "ssad"; var_dump($variables['prev_node']); 
	echo "<pre>"; echo "ssad"; print_r($variables['next_node']); 
	exit;*/
	$vars['alias_previous'] = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$prev_node->nid->value);
	$vars['alias_next'] = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$next_node->nid->value);
	if($prev_node){
		$vars['title_previous'] = $prev_node->get('title')->value;
	}
	if($next_node){
		$vars['title_next'] = $next_node->get('title')->value;
	}	
	
	$blog_node = \Drupal\node\Entity\Node::load($nid);
	$vars['node_data'] = $blog_node;
	$vars['blog_f5_daaata'] = $vars['node_data'];
        if(isset($vars['node'])) {
            $vars['title'] = $vars['node']->title->value;
            $vars['created'] = $vars['node']->created->value;
        }
        else{
           $vars['title'] =$vars['page']['#title'];
        }
        //echo "<pre>"; echo "ssad"; print_r($vars['node']->created->value); exit;
} 

function vitero_preprocess_node__careers(&$variables){

	$sl_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$sl_nids = $sl_query->condition('type', 'careers_listing')->execute();
	//print_r($sl_nids); exit;
	// Load all menu footer 3 menu items.
	$sl_nodes = \Drupal\node\Entity\Node::loadMultiple($sl_nids);

	// Pass them to region--footer3.html.twig.
	$variables['sl_data'] = $sl_nodes;
	$variables['sl_f5_data'] = $variables['sl_data'];
	foreach ($variables['sl_f5_data'] as $key => $value) {
		$variables['f_data_sl'][] = $value;
	}
	//echo "<pre>"; print_r($variables['f_data_sl']); exit;

	$email_details = \Drupal\node\Entity\Node::load(1427);
	$from_email = $email_details->field_from_email[0]->value;
	$to_email = $email_details->field_to_email[0]->value;

	$email = \Drupal::request()->request->get('email');

	if($email) {

		$mobile = \Drupal::request()->request->get('mobile');
		$alt_mobile = \Drupal::request()->request->get('alt_mobile');
		$tot_exp = \Drupal::request()->request->get('tot_exp');
		$qualification = \Drupal::request()->request->get('qualification');
		$industry = \Drupal::request()->request->get('industry');
		$cur_loc = \Drupal::request()->request->get('cur_loc');
		$firstname = \Drupal::request()->request->get('firstname');
		$lastname  = \Drupal::request()->request->get('lastname');
		$myfile  = \Drupal::request()->request->get('myfile');

		$file = \Drupal::entityTypeManager()->getStorage('file')->load($myfile[0]);

		// echo "fi11r"; print_r($myfile);

		// echo "filr"; print_r($file); exit;
		
		$send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail(); // this is used to send HTML emails
		$message['headers'] = array(
		'content-type' => 'text/html',
		'MIME-Version' => '1.0',
		'reply-to' => $from_email,
		'from' => 'Vitero Tiles <'.$from_email.'>'
		);
		$message['to'] = $to_email;
		$message['subject'] = "Carrers Application Submitted";


		$target_dir = "/uploads/";
		$target_file = $target_dir . basename($myfile["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		var_dump($myfile); exit;

		if (move_uploaded_file($myfile["tmp_name"], $target_file)) {
		    echo "The file ". basename($myfile["name"]). " has been uploaded."; exit;
		  }

		$message['body'] = 'Hello,'. $email. ' has submitted an applicatioon for a job posting. <br/>
		First Name: '.  $firstname . '
		<br/>Last Name : '.  $lastname .'
		<br/>Email: '.  $email .'
		<br/>Phone Number: '.  $mobile .'
		<br/>Current Location: '.  $cur_loc .'.
		<br/>Qualification: '.  $qualification .'.
		<br/>Total Experience: '.  $tot_exp;
		

		$send_mail->mail($message);
	}
}

function vitero_preprocess_node__downloads(&$variables){
	$dwn_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$dwn_nids = $dwn_query->condition('type', 'downloads_brochures')->execute();

	// Load all menu footer 3 menu items.
	$dwn_nodes = \Drupal\node\Entity\Node::loadMultiple($dwn_nids);

	// Pass them to region--footer3.html.twig.
	$variables['dwn_data'] = $dwn_nodes;
	$variables['dwn_f5_data'] = $variables['dwn_data'];
	foreach ($variables['dwn_f5_data'] as $key => $value) {
		$variables['f_data_dwn'][] = $value;
		$variables['cat_data'][] = $value->field_brochure_category->entity->name->value;
	}

	/*$keys = array_keys($arr);
	foreach($keys as $key) {
	    echo($key);
	}*/
	$variables['cat_data'] = array_unique($variables['cat_data']);
	//echo "<pre>"; echo "ssad"; print_r(($variables['cat_data'])); exit;
}

function vitero_preprocess_node__about_us(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';

	$email_details = \Drupal\node\Entity\Node::load(882);
	$from_email = $email_details->field_from_email[0]->value;
	$to_email = $email_details->field_to_email[0]->value;

	$email = \Drupal::request()->request->get('email');

	if($email) {

		$send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail(); // this is used to send HTML emails
		$message['headers'] = array(
		'content-type' => 'text/html',
		'MIME-Version' => '1.0',
		'reply-to' => $from_email,
		'from' => 'Vitero Tiles <'.$from_email.'>'
		);
		$message['to'] = $to_email;
		$message['subject'] = "Newsletter Subscription";

		$message['body'] = 'Hello,'. $email. ' has subscribed to the newsletter.';

		$send_mail->mail($message);
	}
	$dwn_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$dwn_nids = $dwn_query->condition('type', 'awards_and_certification')->execute();

	// Load all menu footer 3 menu items.
	$dwn_nodes = \Drupal\node\Entity\Node::loadMultiple($dwn_nids);

	// Pass them to region--footer3.html.twig.
	$variables['dwn_data'] = $dwn_nodes;
	$variables['dwn_f5_data'] = $variables['dwn_data'];
	foreach ($variables['dwn_f5_data'] as $key => $value) {
		$variables['f_data_dwn'][] = $value;
	}

	  $message = \Drupal::entityTypeManager()
            ->getStorage('contact_message')
            ->create(array(
            'contact_form' => 'newsletter', //ID(Machine name) of form
        ));
        $form = \Drupal::service('entity.form_builder')->getForm($message);
        $variables['application_form'] = $form;
	//echo "<pre>"; echo "ssad"; print_r(($variables['f_data_dwn'])); exit;
}

function vitero_preprocess_node__contact_us(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';

	$email_details = \Drupal\node\Entity\Node::load(892);
	$from_email = $email_details->field_from_email[0]->value;
	$to_email = $email_details->field_to_email[0]->value;

	$email = \Drupal::request()->request->get('email');
	$number = \Drupal::request()->request->get('phone');
	$city = \Drupal::request()->request->get('city');
	$requirement = \Drupal::request()->request->get('requirement');
	$full_name = \Drupal::request()->request->get('full_name');
	$news_email  = \Drupal::request()->request->get('news_email');

	if($email) {

		$send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail(); // this is used to send HTML emails
		$message['headers'] = array(
		'content-type' => 'text/html',
		'MIME-Version' => '1.0',
		'reply-to' => $from_email,
		'from' => 'Vitero Tiles <'.$from_email.'>'
		);
		$message['to'] = $to_email;
		$message['subject'] = "Contact Us - Submission";

		$message['body'] = 'Hello,'. $full_name. ' has submitted a contact us form, here are the details. <br/>
		Name: '.  $full_name .'
		<br/>Email: '.  $email .'
		<br/>Phone Number: '.  $number .'
		<br/>City: '.  $city .'.
		<br/>Requirement: '.  $requirement ;
		

		$send_mail->mail($message);
	}

	if($news_email){
		$email_details = \Drupal\node\Entity\Node::load(882);
		$from_email = $email_details->field_from_email[0]->value;
		$to_email = $email_details->field_to_email[0]->value;
		// print_r("here");
		// print_r($to_email);
		// print_r($from_email);
		$send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail(); // this is used to send HTML emails
		$message['headers'] = array(
		'content-type' => 'text/html',
		'MIME-Version' => '1.0',
		'reply-to' => $from_email,
		'from' => 'Vitero Tiles <'.$from_email.'>'
		);
		$message['to'] = $to_email;
		$message['subject'] = "Newsletter Subscription";

		$message['body'] = 'Hello,'. $news_email. ' has subscribed to the newsletter.';

		$send_mail->mail($message);
	}
}

function vitero_preprocess_node__content_type_products(&$variables){
	
	$nid = $variables['node']->nid->value;

	$field_product_series = $variables['node']->field_product_series->value;
    $field_product_titleSubCategory = $variables['node']->field_product_title->value;
    $field_product_category = $variables['node']->field_product_category->value;
	$field_product_suitability = $variables['node']->field_product_suitability->value;
	

	$dwn_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all footer 3 menu items node IDs.
	$dwn_nids = $dwn_query->condition('type', 'content_type_products')->execute();

	// Load all menu footer 3 menu items.
	$dwn_nodes = \Drupal\node\Entity\Node::loadMultiple($dwn_nids);

	// Pass them to region--footer3.html.twig.
	$all_nodes_data = $dwn_nodes;
	$c_all_nodes_data = $all_nodes_data;
	foreach ($c_all_nodes_data as $key => $value) {
		if($nid != $value->nid->value && $value->field_product_series->value == $field_product_series){

			$path = '/node/' . (int) $value->nid->value;
			$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
			$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
			$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $value->nid->value];
			$variables['related_products_data'][] = $value;
			$nids[] = $value->nid->value;
		}
	}
	$count_related_products_data = count($variables['related_products_data']);
	
	//echo "1"; echo $count_related_products_data; echo "<br/>";
	//print_r($nids); exit;

	if($count_related_products_data < 3){
		foreach ($c_all_nodes_data as $key => $value) {
			if($nid != $value->nid->value && $value->field_product_title->value == $field_product_titleSubCategory){
				if (in_array($value->nid->value, $nids)){ } 
				else {
					$path = '/node/' . (int) $value->nid->value;
					$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
					$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
					$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $value->nid->value];
					$variables['related_products_data'][] = $value;
					$nids[] = $value->nid->value;
			 	}
			}
		}
	}
	$count_related_products_data = count($variables['related_products_data']);
	//echo "2"; echo $count_related_products_data; echo "<br/>";
	if($count_related_products_data < 3){
		foreach ($c_all_nodes_data as $key => $value) {
			if($nid != $value->nid->value && $value->field_product_category->value == $field_product_category){
				if (in_array($value->nid->value, $nids)){ } 
				else {
					$path = '/node/' . (int) $value->nid->value;
					$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
					$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
					$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $value->nid->value];
					$variables['related_products_data'][] = $value;
					$nids[] = $value->nid->value;
				}
			}
		}
	}
	$count_related_products_data = count($variables['related_products_data']);
	//echo "3"; echo $count_related_products_data; echo "<br/>";
	if($count_related_products_data < 3){
		foreach ($c_all_nodes_data as $key => $value) {
			if($nid != $value->nid->value && $value->field_product_suitability->value == $field_product_suitability){
				if (in_array($value->nid->value, $nids)){ } 
				else {
					$path = '/node/' . (int) $value->nid->value;
					$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
					$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
					$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $value->nid->value];
					$variables['related_products_data'][] = $value;
					$nids[] = $value->nid->value;
				}
			}
		}
	}
	//echo "4"; echo count($variables['f_data_path']); echo "<br/>";
	/*var_dump(count($variables['related_products_data'])); 
	print '</pre>';
	exit;*/
}

function vitero_preprocess_page(&$variables){
	$cookie_name = 'fav_nids';
	if(!isset($_COOKIE[$cookie_name])) {
	  $variables['wishlist_count'] = 0;
	  //echo "here"; echo "<pre>"; print_r($wishlist_count); echo "</pre>"; exit;
	  //if($wishlist_count == 0){
	  	 $variables['wishlist_empty'] = "No items in the wishlist";
	 //s }
	} else {
	  $cookie_value = $_COOKIE[$cookie_name];
	  $wishlist_data = explode(",",$cookie_value);
	  $wishlist_data = array_values(array_filter($wishlist_data));
	  $wishlist_count = count($wishlist_data);
	  if($wishlist_count == 0){
	  	 $variables['wishlist_empty'] = "No items in the wishlist";
	  }
	  //echo "in lese jereee"; echo "<pre>"; print_r($wishlist_data);  print_r($wishlist_count); echo "</pre>"; exit;
	  $variables['wishlist_count'] = $wishlist_count;
	}
}

function vitero_preprocess_node__wishlist(&$variables){
	// $entity = $variables['elements']['#node'];
	// $cache_tags = $entity->getCacheTags();
	// \Drupal\Core\Cache\Cache::invalidateTags($cache_tags);

	//drupal_flush_all_caches();  //To clear all cache or

	// $renderCache = \Drupal::service('cache.render');
	// $renderCache->invalidateAll(); 
	// $variables['#cache']['contexts'][] = 'url.';

	// $variables['#cache']['max-age'] = 0;
	$variables['#cache']['contexts'][] = 'url.query_args';
	$cookie_name = 'fav_nids';
	if(!isset($_COOKIE[$cookie_name])) {
	  $variables['wishlist_count'] = 0;
	  //echo "here"; echo "<pre>"; print_r($wishlist_count); echo "</pre>"; exit;
	  //if($wishlist_count == 0){
	  	 $variables['wishlist_empty'] = "No items in the wishlist";
	  //}
	} else {
	  $cookie_value = $_COOKIE[$cookie_name];
	  $wishlist_data = explode(",",$cookie_value);
	  $wishlist_data = array_values(array_filter($wishlist_data));
	  $wishlist_count = count($wishlist_data);
	  if($wishlist_count == 0){
	  	 $variables['wishlist_empty'] = "No items in the wishlist";
	  }
	  //echo "in lese jereee"; echo "<pre>"; print_r($wishlist_data);  print_r($wishlist_count); echo "</pre>"; exit;
	  $variables['wishlist_count'] = $wishlist_count;
	}
	
	if(!isset($_COOKIE[$cookie_name])) {
	  $wishlist_count = 0;
	  $variables['wishlist_empty'] = "No items in the wishlist";
	} else {
		$cookie_value = $_COOKIE[$cookie_name];
		$wishlist_data = explode(",",$cookie_value);
		//echo "aas"; echo "<pre>"; var_dump($wishlist_data); exit;
		$wishlist_nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($wishlist_data);

		foreach ($wishlist_nodes as $node){
			$variables['wishlist_nodes_data'][] = $node;
			$nid = $node->nid->value;
			$path = '/node/' . (int) $nid;
			$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
			$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
			$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
		}

	  //echo "aas"; echo "<pre>"; var_dump($variables['wishlist_empty']); exit;
	}
}

function vitero_preprocess_node__page_privacy_policy(&$variables){
	//print_r("here"); exit;
}

function vitero_preprocess_node__find_a_store(&$variables){

	$variables['#attached']['library'][] = 'vitero/store-locator';
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_city = \Drupal::request()->get('city');
	$sl_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	$sl_nids = $sl_query->condition('type', 'stores')->execute();
	$sl_nodes = \Drupal\node\Entity\Node::loadMultiple($sl_nids);
	$variables['sl_data'] = $sl_nodes;
	$variables['sl_f5_data'] = $variables['sl_data'];
	foreach ($variables['sl_f5_data'] as $key => $value) {

		if($query_filter_city){
			if($query_filter_city == $value->field_city[0]->value){
				$variables['f_data_sl_city'][] = $value;
				$variables['city_selected'] = $query_filter_city;
			}
		}else{
			$variables['f_data_sl'][] = $value;
			$cities[] = $value->field_city[0]->value;
			$variables['cities'] = array_unique($cities);
		}
		
	}

	/*if($query_filter_city){
		foreach ($variables['sl_f5_data'] as $key => $value) {
			if($query_filter_city = $value->field_city[0]->value)
				$variables['f_data_sl_city'][] = $value;
		}
	}*/

	//echo "i"; echo "<pre>"; print_r($variables['f_data_sl']); exit;

	/*foreach ($variables['f_data_sl'] as $key => $value) {
		$cities[] = $value->field_city[0]->value;
	}
	$variables['cities'] = array_unique($cities);*/
	//echo "i"; echo "<pre>"; print_r($cities); exit;
}

function vitero_preprocess_node__become_a_dealer(&$variables){

	$email_details = \Drupal\node\Entity\Node::load(893);
	$from_email = $email_details->field_from_email[0]->value;
	$to_email = $email_details->field_to_email[0]->value;

	$email = \Drupal::request()->request->get('email');
	$number = \Drupal::request()->request->get('phone');
	$city = \Drupal::request()->request->get('city');
	$business_name = \Drupal::request()->request->get('business_name');
	$full_name = \Drupal::request()->request->get('name');
	$note  = \Drupal::request()->request->get('message');

	if($email) {

		$send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail(); // this is used to send HTML emails
		$message['headers'] = array(
		'content-type' => 'text/html',
		'MIME-Version' => '1.0',
		'reply-to' => $from_email,
		'from' => 'Vitero Tiles <'.$from_email.'>'
		);
		$message['to'] = $to_email;
		$message['subject'] = "Dealership Enquiry";

		$message['body'] = 'Hello,'. $full_name. ' has submitted a dealership form, here are the details. <br/>
		Name: '.  $full_name .'
		<br/>Email: '.  $email .'
		<br/>Phone Number: '.  $number .'
		<br/>City: '.  $city .'.
		<br/>Business Name: '.  $business_name .'.
		<br/>Message: '.  $note ;

		$send_mail->mail($message);
	}
}

function vitero_preprocess_page__front(&$variables){

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Banner Image node IDs.
	$nids = $query->condition('type', 'home_page')->execute();

	$cookie_name = 'fav_nids';
	if(!isset($_COOKIE[$cookie_name])) {
	  $variables['wishlist_count'] = 0;
	  //if($wishlist_count == 0){
	  	 $variables['wishlist_empty'] = "No items in the wishlist";
	 // }
	  //echo "here"; echo "<pre>"; print_r($wishlist_count); echo "</pre>"; exit;
	} else {
	  $cookie_value = $_COOKIE[$cookie_name];
	  $wishlist_data = explode(",",$cookie_value);
	  $wishlist_data = array_values(array_filter($wishlist_data));
	  $wishlist_count = count($wishlist_data);
	  if($wishlist_count == 0){
	  	 $variables['wishlist_empty'] = "No items in the wishlist";
	  }
	  //echo "in lese jereee"; echo "<pre>"; print_r($wishlist_data);  print_r($wishlist_count); echo "</pre>"; exit;
	  $variables['wishlist_count'] = $wishlist_count;
	}

	// Load all Banner Image details.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page--front.html.twig.
	$variables['data'] = $nodes;
	$variables['hb_data'] = $variables['data'];
	foreach ($variables['hb_data'] as $key => $value) {
		$variables['f_data'][] = $value;
	}

	/*echo "<pre>";
	print_r($variables['f_data']);
	exit;*/

	$query2 = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get About us node ID.
	$ha_nids = $query2->condition('type', 'home_page_front')->execute();

	// Load About Us data.
	$ha_nodes = \Drupal\node\Entity\Node::loadMultiple($ha_nids);

	// Pass them to page--front.html.twig.
	$variables['data_fa'] = $ha_nodes;
	foreach ($variables['data_fa'] as $key => $value) {
		$variables['ha_data'] = $value;
	}

	/*echo "<pre>";
	print_r($variables['ha_data']);
	exit;*/

	
	$query3 = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get About us node ID.
	$hg_nids = $query3->condition('type', 'home_page_tiles_gallery')->execute();

	// Load About Us data.
	$hg_nodes = \Drupal\node\Entity\Node::loadMultiple($hg_nids);

	// Pass them to page--front.html.twig.
	$variables['data_fg'] = $hg_nodes;
	$variables['hg_data'] = $variables['data_fg'];
	foreach ($variables['hg_data'] as $key => $value) {
		$variables['hg_data_s'][] = $value;
	}

	/*echo "<pre>";
	print_r($variables['hg_data_s']);
	exit;*/

	
	$query4 = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get About us node ID.
	$hbs_nids = $query4->condition('type', 'best_selling_tiles')->execute();

	// Load About Us data.
	$hbs_nodes = \Drupal\node\Entity\Node::loadMultiple($hbs_nids);

	// Pass them to page--front.html.twig.
	$variables['data_hbs'] = $hbs_nodes;
	$variables['hbs_data'] = $variables['data_hbs'];
	foreach ($variables['hbs_data'] as $key => $value) {
		$variables['hbs_data_s'] = $value;
		$term_id = $value->field_products->getValue();
		$linked_document_ids = $value->get('field_products')->getValue();
	}

	$node_storage = \Drupal::entityTypeManager()->getStorage('node');
	foreach ($linked_document_ids as $key => $valuea) {
		$query = $node_storage->getQuery()
			->condition('type', 'content_type_products')
			->condition('status', 1)
		    ->condition('nid', $valuea, '=');
		  $results[] = $query->execute();
	}

	foreach ($results as $key => $value) {
		$array_values[] = ($value);
	}
	foreach ($array_values as $key11 => $value11) {
		$product_node[] = \Drupal\node\Entity\Node::load(array_values($value11)[0]);
		$path = '/node/' . (int) array_values($value11)[0];
		$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
		$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
		$variables['product_node_path'][] = ["path" => $path_alias, "nid" => $nid];
	}
	$variables['product_node'] = $product_node;
	//echo "<pre>"; var_dump(($variables['product_node_path'])); exit;

	$kyt_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get About us node ID.
	$kyt_nids = $kyt_query->condition('type', 'home_page_know_your_tiles')->execute();

	// Load About Us data.
	$kyt_nodes = \Drupal\node\Entity\Node::loadMultiple($kyt_nids);

	// Pass them to page--front.html.twig.
	$variables['data_kyt'] = $kyt_nodes;
	$variables['kyt_data'] = $variables['data_kyt'];
	foreach ($variables['kyt_data'] as $key => $value) {
		$variables['kyt_data_s'] = $value;
		//$variables['hbs_data_s']['field_products'] = 12;

	}
	// echo "<pre>";
	// 	print_r($variables['kyt_data_s']);
	// 	exit;

	//Categories
	$hpc_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get About us node ID.
	$hpc_nids = $hpc_query->condition('type', 'home_page_categories')->execute();

	// Load About Us data.
	$kyt_nodes = \Drupal\node\Entity\Node::loadMultiple($hpc_nids);

	// Pass them to page--front.html.twig.
	$variables['data_hpc'] = $kyt_nodes;
	$variables['hpc_data'] = $variables['data_hpc'];
	foreach ($variables['hpc_data'] as $key => $value) {
		$variables['hpc_data_s'] = $value;
	}

	//echo "<pre>"; print_r($variables['hpc_data_s']); exit;	
	//Blogs and Media
	$blog_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get all footer 3 menu items node IDs.
	$blog_nids = $blog_query->condition('type', 'blog')->execute();


	// Load all menu footer 3 menu items.
	$variables['blog_node'] = \Drupal\node\Entity\Node::load(array_values($blog_nids)[0]);
	$path = '/node/' . (int) array_values($blog_nids)[0];
	$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
	$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
	$variables['blog_node_path'] = ["path" => $path_alias];
	//echo "<pre>"; print_r($variables['blog_node_path']); exit;


	//Blogs and Media
	$media_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get all footer 3 menu items node IDs.
	$media_nids = $media_query->condition('type', 'media_articles')->execute();


	// Load all menu footer 3 menu items.
	$variables['media_node'] = \Drupal\node\Entity\Node::load(array_values($media_nids)[0]);
	$path = '/node/' . (int) array_values($media_nids)[0];
	$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
	$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
	$variables['media_node_path'] = ["path" => $path_alias];

	// Downloads
	$dwn_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();
	// Get About us node ID.
	$dwn_nids = $dwn_query->condition('type', 'downloads_brochures')->execute();

	// Load About Us data.
	$dwn_nodes = \Drupal\node\Entity\Node::loadMultiple($dwn_nids);

	// Pass them to page--front.html.twig.
	$variables['data_dwn'] = $dwn_nodes;
	$variables['dwn_data'] = $variables['data_dwn'];
	foreach ($variables['dwn_data'] as $key => $value) {
		$variables['dwn_data_s'][] = $value;
		//$variables['hbs_data_s']['field_products'] = 12;
	}
	/*echo "<pre>";
	print_r($variables['dwn_data_s']);
	exit;*/

	//$variables['dwn_data_s'] 
	$variables['hp_cat_static'] = array("/glazed-vitrified-tiles", "/double-charged-vitrified-tiles", "/digital-wall-tiles", "/full-body-vitrified-tiles"); 

}

function vitero_preprocess_node__all_products(&$variables){

	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "products"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $value) {

			if($query_strings == 1 && $query_filter_page >0  ){
				$variables['f_data_2'][] = $value;
				$nid = $value->nid->value;
				$path = '/node/' . (int) $nid;
				$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
				$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
				$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
				$nids[] = $value->nid->value;
			}

			if($query_filter_color){
				foreach ($value->field_product_color as $key => $color_value) {
					if($query_filter_color === $color_value->value ){
						$nid = $value->nid->value;
						if (in_array($nid, $nids)){ } 
						else {
			   	 			$variables['f_data_2'][] = $value;
							$path = '/node/' . (int) $nid;
							$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
							$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
							$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
							$nids[] = $value->nid->value;
						}
		   	 		}
				}
			}

			if($query_filter_application){
				foreach ($value->field_room_suitability_wall as $key => $color_value) {
					if($query_filter_application === $color_value->value ){
						$nid = $value->nid->value;
						if (in_array($nid, $nids)){ } 
						else {
			   	 			$variables['f_data_2'][] = $value;
							$path = '/node/' . (int) $nid;
							$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
							$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
							$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
							$nids[] = $value->nid->value;
						}
		   	 		}
				}
				foreach ($value->field_room_suitability_floor as $key => $color_value) {
					if($query_filter_application === $color_value->value ){
						$nid = $value->nid->value;
						if (in_array($nid, $nids)){ } 
						else {
			   	 			$variables['f_data_2'][] = $value;
							$path = '/node/' . (int) $nid;
							$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
							$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
							$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
							$nids[] = $value->nid->value;
						}
		   	 		}
				}
			}

			if($query_filter_size){
				foreach ($value->field_product_sizes as $key => $color_value) {
					if($query_filter_size === $color_value->value ){
						$nid = $value->nid->value;
						if (in_array($nid, $nids)){ } 
						else {
			   	 			$variables['f_data_2'][] = $value;
							$path = '/node/' . (int) $nid;
							$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
							$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
							$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
							$nids[] = $value->nid->value;
						}
		   	 		}
				}
			}

			if($query_filter_finish){
				foreach ($value->field_product_finish as $key => $color_value) {
					if($query_filter_finish === $color_value->value ){
						$nid = $value->nid->value;
						if (in_array($nid, $nids)){ } 
						else {
			   	 			$variables['f_data_2'][] = $value;
							$path = '/node/' . (int) $nid;
							$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
							$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
							$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
							$nids[] = $value->nid->value;
						}
		   	 		}
				}
			}

			if($query_filter_category){
				foreach ($value->field_product_category as $key => $color_value) {
					if($query_filter_category === $color_value->value ){
						$nid = $value->nid->value;
						if (in_array($nid, $nids)){ } 
						else {
			   	 			$variables['f_data_2'][] = $value;
							$path = '/node/' . (int) $nid;
							$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
							$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
							$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
							$nids[] = $value->nid->value;
						}
		   	 		}
				}
			}
		
	}
	/* GET the data - END */
	//echo "<pre>"; var_dump($variables['f_data_2']); exit;
	/*$variables['f_data_2'] = array_unique($variables['f_data_2']);*/
	/* Trim array data for pagination count START */
	$variables['items_count'] = count($variables['f_data_2']);
	if($query_filter_page){
		$variables['f_data_2'] = array_slice($variables['f_data_2'], 12*($query_filter_page-1)+1, 12, true);
		$variables['query_filter_page'] = $query_filter_page;
	}else{
			$variables['query_filter_page'] = 1;
	}
	/* Trim array data for pagination count  END */



	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		$variables['filter_field_cat'][] = $value->field_product_category->value;
		$variables['filter_field_product_finish'][] = $value->field_product_finish->value;
		$variables['filter_field_product_size'][] = $value->field_product_sizes->value;
		$variables['filter_field_product_colors'][] = $value->field_product_color->value;
		$variables['filter_field_product_sus_f'][] = $value->field_room_suitability_floor->value;
		$variables['filter_field_product_sus_w'][] = $value->field_room_suitability_wall->value;
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));



}

//Bathroom Floor tiles
function vitero_preprocess_node__bathroom_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "bathroom-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/


	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){

			foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Bathroom" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Floor Tiles"){
			foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Bathroom" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}

	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//Bathroom Tiles
function vitero_preprocess_node__field_bathroom_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "bathroom-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;

	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Floor Tiles"){

			foreach ($all_data->field_room_suitability_floor as $key => $sf_value) {
				$filter_field_product_sus_f[] = $sf_value->value;
			}
			foreach ($all_data->field_room_suitability_wall as $key => $sw_value) {
				$filter_field_product_sus_w[] = $sw_value->value;
			}

			$filter_product_application = array_unique(array_merge((array)$filter_field_product_sus_f, (array)$filter_field_product_sus_w));
			foreach ($filter_product_application as $key => $bft_application_value) {
				if("Bathroom" === $bft_application_value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
			foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Bathroom" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Kitchen Wall Tiles
function vitero_preprocess_node__field_kitchen_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "kitchen-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1])) {

			foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Kitchen" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1])){
			foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Kitchen" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));


	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Bathroom Wall Tiles
function vitero_preprocess_node__field_bathroom_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "bathroom-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1])){

			foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Bathroom" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1])){
			foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Bathroom" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//Bedroom Wall Tiles
function vitero_preprocess_node__bedroom_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "bedroom-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){

			foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Bedroom" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1])){
			foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Bedroom" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//bedroom Tiles
function vitero_preprocess_node__field_bedroom_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "bedroom-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){

			foreach ($all_data->field_room_suitability_floor as $key => $sf_value) {
				$filter_field_product_sus_f[] = $sf_value->value;
			}
			foreach ($all_data->field_room_suitability_wall as $key => $sw_value) {
				$filter_field_product_sus_w[] = $sw_value->value;
			}

			$filter_product_application = array_unique(array_merge((array)$filter_field_product_sus_f, (array)$filter_field_product_sus_w));
			foreach ($filter_product_application as $key => $bft_application_value) {
				if("Bedroom" === $bft_application_value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
			foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Bedroom" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// Commercial Floor Tiles
function vitero_preprocess_node__commercial_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "commercial-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){

			foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Commercial" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Floor Tiles"){
			foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Commercial" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// Commercial Tiles
function vitero_preprocess_node__field_commercial_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "commercial-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){

			foreach ($all_data->field_room_suitability_floor as $key => $sf_value) {
				$filter_field_product_sus_f[] = $sf_value->value;
			}
			foreach ($all_data->field_room_suitability_wall as $key => $sw_value) {
				$filter_field_product_sus_w[] = $sw_value->value;
			}

			$filter_product_application = array_unique(array_merge((array)$filter_field_product_sus_f, (array)$filter_field_product_sus_w));
			foreach ($filter_product_application as $keyCS => $bft_application_value) {
				if("Commercial" === $bft_application_value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
			if("Commercial" === $bft_application_value->value){
				$variables['filter_field_cat'][] = $value->field_product_category->value;

				foreach ($value->field_product_finish as $key => $f_value) {
					$variables['filter_field_product_finish'][] = $f_value->value;
				}
				foreach ($value->field_product_sizes as $key => $s_value) {
					$variables['filter_field_product_size'][] = $s_value->value;
				}
				foreach ($value->field_product_color as $key => $d_value) {
					$variables['filter_field_product_colors'][] = $d_value->value;
				}
				foreach ($value->field_room_suitability_floor as $key => $sf_value) {
					$variables['filter_field_product_sus_f'][] = $sf_value->value;
				}
				foreach ($value->field_room_suitability_wall as $key => $sw_value) {
					$variables['filter_field_product_sus_w'][] = $sw_value->value;
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//Double Chared Vertified Tiles
function vitero_preprocess_node__double_charged_vertified_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "double-charged-vitrified-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){

			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Double Charged Vitrified Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if("Double Charged Vitrified Tiles" === $value->field_product_category->value){
			$variables['filter_field_cat'][] = $value->field_product_category->value;

			foreach ($value->field_product_finish as $key => $f_value) {
				$variables['filter_field_product_finish'][] = $f_value->value;
			}
			foreach ($value->field_product_sizes as $key => $s_value) {
				$variables['filter_field_product_size'][] = $s_value->value;
			}
			foreach ($value->field_product_color as $key => $d_value) {
				$variables['filter_field_product_colors'][] = $d_value->value;
			}
			foreach ($value->field_room_suitability_floor as $key => $sf_value) {
				$variables['filter_field_product_sus_f'][] = $sf_value->value;
			}
			foreach ($value->field_room_suitability_wall as $key => $sw_value) {
				$variables['filter_field_product_sus_w'][] = $sw_value->value;
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// Full Body Tiles
function vitero_preprocess_node__full_body_vitrified_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "full-body-vitrified-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){

			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Full Body Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if("Full Body Tiles" === $value->field_product_category->value){
			$variables['filter_field_cat'][] = $value->field_product_category->value;

			foreach ($value->field_product_finish as $key => $f_value) {
				$variables['filter_field_product_finish'][] = $f_value->value;
			}
			foreach ($value->field_product_sizes as $key => $s_value) {
				$variables['filter_field_product_size'][] = $s_value->value;
			}
			foreach ($value->field_product_color as $key => $d_value) {
				$variables['filter_field_product_colors'][] = $d_value->value;
			}
			foreach ($value->field_room_suitability_floor as $key => $sf_value) {
				$variables['filter_field_product_sus_f'][] = $sf_value->value;
			}
			foreach ($value->field_room_suitability_wall as $key => $sw_value) {
				$variables['filter_field_product_sus_w'][] = $sw_value->value;
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//Glazed Vitrified Floor Tiles
function vitero_preprocess_node__glazed_vitrified_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "glazed-vitrified-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){

			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Glazed Vitrified Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {

		if($value->field_category->entity->name->value == "Floor Tiles"){
			if("Glazed Vitrified Tiles" === $value->field_product_category->value){
				$variables['filter_field_cat'][] = $value->field_product_category->value;

				foreach ($value->field_product_finish as $key => $f_value) {
					$variables['filter_field_product_finish'][] = $f_value->value;
				}
				foreach ($value->field_product_sizes as $key => $s_value) {
					$variables['filter_field_product_size'][] = $s_value->value;
				}
				foreach ($value->field_product_color as $key => $d_value) {
					$variables['filter_field_product_colors'][] = $d_value->value;
				}
				foreach ($value->field_room_suitability_floor as $key => $sf_value) {
					$variables['filter_field_product_sus_f'][] = $sf_value->value;
				}
				foreach ($value->field_room_suitability_wall as $key => $sw_value) {
					$variables['filter_field_product_sus_w'][] = $sw_value->value;
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// Glazed Vitrified Tiles 
function vitero_preprocess_node__field_glazed_virtified_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "glazed-vitrified-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Floor Tiles"){

			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Glazed Vitrified Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if("Glazed Vitrified Tiles" === $value->field_product_category->value){
			$variables['filter_field_cat'][] = $value->field_product_category->value;

			foreach ($value->field_product_finish as $key => $f_value) {
				$variables['filter_field_product_finish'][] = $f_value->value;
			}
			foreach ($value->field_product_sizes as $key => $s_value) {
				$variables['filter_field_product_size'][] = $s_value->value;
			}
			foreach ($value->field_product_color as $key => $d_value) {
				$variables['filter_field_product_colors'][] = $d_value->value;
			}
			foreach ($value->field_room_suitability_floor as $key => $sf_value) {
				$variables['filter_field_product_sus_f'][] = $sf_value->value;
			}
			foreach ($value->field_room_suitability_wall as $key => $sw_value) {
				$variables['filter_field_product_sus_w'][] = $sw_value->value;
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// Kitchen Floor Tiles
function vitero_preprocess_node__kitchen_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "kitchen-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){
			foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Kitchen" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Floor Tiles"){
			foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Kitchen" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));


	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//Kitchen Tiles
function vitero_preprocess_node__field_kitchen_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "kitchen-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Floor Tiles"){
			foreach ($all_data->field_room_suitability_floor as $key => $sf_value) {
				$filter_field_product_sus_f[] = $sf_value->value;
			}
			foreach ($all_data->field_room_suitability_wall as $key => $sw_value) {
				$filter_field_product_sus_w[] = $sw_value->value;
			}

			$filter_product_application = array_unique(array_merge((array)$filter_field_product_sus_f, (array)$filter_field_product_sus_w));
			foreach ($filter_product_application as $key => $bft_application_value) {
				if("Kitchen" === $bft_application_value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Kitchen" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));


	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Living Room Floor Tiles
function vitero_preprocess_node__living_room_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "living-room-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){
			foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Living Room" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Floor Tiles"){
			foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Living Room" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// Living Room Tiles
function vitero_preprocess_node__field_living_room_tiles_new(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "living-room-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Floor Tiles"){
			foreach ($all_data->field_room_suitability_floor as $key => $sf_value) {
				$filter_field_product_sus_f[] = $sf_value->value;
			}
			foreach ($all_data->field_room_suitability_wall as $key => $sw_value) {
				$filter_field_product_sus_w[] = $sw_value->value;
			}

			$filter_product_application = array_unique(array_merge((array)$filter_field_product_sus_f, (array)$filter_field_product_sus_w));
			foreach ($filter_product_application as $key => $bft_application_value) {
				if("Living Room" === $bft_application_value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		$variables['filter_field_cat'][] = $value->field_product_category->value;

		foreach ($value->field_product_finish as $key => $f_value) {
			$variables['filter_field_product_finish'][] = $f_value->value;
		}
		foreach ($value->field_product_sizes as $key => $s_value) {
			$variables['filter_field_product_size'][] = $s_value->value;
		}
		foreach ($value->field_product_color as $key => $d_value) {
			$variables['filter_field_product_colors'][] = $d_value->value;
		}
		foreach ($value->field_room_suitability_floor as $key => $sf_value) {
			$variables['filter_field_product_sus_f'][] = $sf_value->value;
		}
		foreach ($value->field_room_suitability_wall as $key => $sw_value) {
			$variables['filter_field_product_sus_w'][] = $sw_value->value;
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//OutDoor Floor 
function vitero_preprocess_node__filed_outdoor_tiles_new(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "outdoor-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){
			foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Outdoor" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Floor Tiles"){
			foreach ($value->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Outdoor" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// OutDoor All tiles
function vitero_preprocess_node__field_outdoor_tiles_new(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "outdoor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Floor Tiles"){field_product_suitability
			foreach ($all_data->field_room_suitability_floor as $key => $sf_value) {
				$filter_field_product_sus_f[] = $sf_value->value;
			}
			foreach ($all_data->field_room_suitability_wall as $key => $sw_value) {
				$filter_field_product_sus_w[] = $sw_value->value;
			}

			$filter_product_application = array_unique(array_merge((array)$filter_field_product_sus_f, (array)$filter_field_product_sus_w));

			foreach ($filter_product_application as $keyCS => $bft_application_value) {
				if("Outdoor" === $bft_application_value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		$variables['filter_field_cat'][] = $value->field_product_category->value;

		foreach ($value->field_product_finish as $key => $f_value) {
			$variables['filter_field_product_finish'][] = $f_value->value;
		}
		foreach ($value->field_product_sizes as $key => $s_value) {
			$variables['filter_field_product_size'][] = $s_value->value;
		}
		foreach ($value->field_product_color as $key => $d_value) {
			$variables['filter_field_product_colors'][] = $d_value->value;
		}
		foreach ($value->field_room_suitability_floor as $key => $sf_value) {
			$variables['filter_field_product_sus_f'][] = $sf_value->value;
		}
		foreach ($value->field_room_suitability_wall as $key => $sw_value) {
			$variables['filter_field_product_sus_w'][] = $sw_value->value;
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Polished Glazed virtified floor Tiles
function vitero_preprocess_node__polished_glazed_vitrified_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "polished-glazed-vitrified-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Floor Tiles"){
			//foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Polished Glazed Vitrified Tiles" === $all_data->field_product_category->value){
					//print_r("here2"); 
					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Floor Tiles"){
			//foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Polished Glazed Vitrified Tiles" === $value->field_product_category->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Polished Glazed vitrified Wall tiles
function vitero_preprocess_node__field_polished_glazed_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "polished-glazed-vitrified-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			//foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Polished Glazed Vitrified Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1]) ){
			//foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Polished Glazed Vitrified Tiles" === $value->field_product_category->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}



// Polished Glazed Vitrified Tiles
function vitero_preprocess_node__polished_glazed_vitrified_new(&$variables){


	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "polished-glazed-vitrified-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/


	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			//foreach ($all_data->field_room_suitability_floor as $keyCS => $bft_application_value) {
				if("Polished Glazed Vitrified Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		$variables['filter_field_cat'][] = $value->field_product_category->value;

		foreach ($value->field_product_finish as $key => $f_value) {
			$variables['filter_field_product_finish'][] = $f_value->value;
		}
		foreach ($value->field_product_sizes as $key => $s_value) {
			$variables['filter_field_product_size'][] = $s_value->value;
		}
		foreach ($value->field_product_color as $key => $d_value) {
			$variables['filter_field_product_colors'][] = $d_value->value;
		}
		foreach ($value->field_room_suitability_floor as $key => $sf_value) {
			$variables['filter_field_product_sus_f'][] = $sf_value->value;
		}
		foreach ($value->field_room_suitability_wall as $key => $sw_value) {
			$variables['filter_field_product_sus_w'][] = $sw_value->value;
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}


}


//Bedroom Wall Tiles
function vitero_preprocess_node__field_bedroom_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "bedroom-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1])){
			foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Bedroom" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1])){
			foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Bedroom" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

//outDoor Wall tiles
function vitero_preprocess_node__filed_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "outdoor-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Outdoor" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1]) ){
			foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Outdoor" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Commercial Wall Tiles
function vitero_preprocess_node__field_commercial_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "commercial-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Commercial" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1]) ){
			foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Commercial" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));


	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Glazed Vitrified wall Tiles
function vitero_preprocess_node__glazed_vertified_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "glazed-vitrified-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Glazed Vitrified Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1]) ){
			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Glazed Vitrified Tiles" === $value->field_product_category->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}


// Living Room Wall Tiles
function vitero_preprocess_node__field_living_room_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "living-room-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Living Room" === $bft_application_value->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if($value->field_category->entity->name->value == "Wall Tiles" || isset($value->field_category[1]) ){
			foreach ($value->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Living Room" === $bft_application_value->value){
					$variables['filter_field_cat'][] = $value->field_product_category->value;

					foreach ($value->field_product_finish as $key => $f_value) {
						$variables['filter_field_product_finish'][] = $f_value->value;
					}
					foreach ($value->field_product_sizes as $key => $s_value) {
						$variables['filter_field_product_size'][] = $s_value->value;
					}
					foreach ($value->field_product_color as $key => $d_value) {
						$variables['filter_field_product_colors'][] = $d_value->value;
					}
					foreach ($value->field_room_suitability_floor as $key => $sf_value) {
						$variables['filter_field_product_sus_f'][] = $sf_value->value;
					}
					foreach ($value->field_room_suitability_wall as $key => $sw_value) {
						$variables['filter_field_product_sus_w'][] = $sw_value->value;
					}
				}
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));




	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}

}

//Digital Floor Tiles
function vitero_preprocess_node__digital_floor_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "digital-floor-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	    
	}

	$variables['selected_filters'] = $final;
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	 //exit;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Digital Floor Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if("Digital Floor Tiles" === $value->field_product_category->value){
			$variables['filter_field_cat'][] = $value->field_product_category->value;

			foreach ($value->field_product_finish as $key => $f_value) {
				$variables['filter_field_product_finish'][] = $f_value->value;
			}
			foreach ($value->field_product_sizes as $key => $s_value) {
				$variables['filter_field_product_size'][] = $s_value->value;
			}
			foreach ($value->field_product_color as $key => $d_value) {
				$variables['filter_field_product_colors'][] = $d_value->value;
			}
			foreach ($value->field_room_suitability_floor as $key => $sf_value) {
				$variables['filter_field_product_sus_f'][] = $sf_value->value;
			}
			foreach ($value->field_room_suitability_wall as $key => $sw_value) {
				$variables['filter_field_product_sus_w'][] = $sw_value->value;
			}
		}
	}

	
	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

// Digital Wall Tiles
function vitero_preprocess_node__digital_wall_tiles(&$variables){
	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_category = \Drupal::request()->get('category');
	$query_filter_application = \Drupal::request()->get('application');
	$query_filter_size = \Drupal::request()->get('size');
	$query_filter_color = \Drupal::request()->get('color');
	$query_filter_finish = \Drupal::request()->get('finish');
	$query_filter_page = \Drupal::request()->get('page');

	if($query_filter_page){
		if($query_filter_page <= 0){
			$query_filter_page = 1; $variables['query_filter_page'] = 1;
		}
	}else{
		$query_filter_page = 1; $variables['query_filter_page'] = 1;
	}

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

	// Pass them to page.html.twig.
	$variables['flowers'] = $nodes;

	$variables['f_data'] = $variables['flowers'];


	/*  Remove page from url  START*/
	$uri = explode('?', $_SERVER['REQUEST_URI']);
	$variables['uri_sent'] = explode('/', $_SERVER['REQUEST_URI']);

	$word = "page=";
	if(strpos($variables['uri_sent'][1], $word) !== false){
	    $get_page_in_uri = substr($variables['uri_sent'][1], strpos($variables['uri_sent'][1], "page=") - 1);    

		$variables['append_uri'] =  str_replace($get_page_in_uri,"",$variables['uri_sent'][1]);
	} else{
	    $variables['append_uri'] = $variables['uri_sent'][1];
	}
	/*  Remove page from url END */


	/* check to keep ? or & in the URL  START*/
	if($uri[1] && $variables['append_uri'] != "digital-wall-tiles"){
		$variables['query_filter'] = 1;
		$query_strings = 1;
	}
	else{
		$query_strings = 0; $variables['query_filter'] = 0;
		
	}
	/* check to keep ? or & in the URL END*/

	/* Get query Strings and count */
	$vars = explode('&', $_SERVER['QUERY_STRING']);

	$final = array();

	if(!empty($vars)) {
	    foreach($vars as $var) {
	        $parts = explode('=', $var);

	        $key = $parts[0];
	        $val = $parts[1];

	        if(!empty($val))
	        	$final[$key] = urldecode($val);
	    }
	}
	$query_filter_page = 1; $variables['query_filter_page'] = 1;
	
	$variables['selected_filters'] = $final;
	//echo "<pre>"; print_r($final); echo "</pre>";
	/* GET the data - START */
	$nids = [];
	foreach ($variables['f_data'] as $key => $all_data) {
		//if($all_data->field_category->entity->name->value == "Wall Tiles" || isset($all_data->field_category[1]) ){
			//foreach ($all_data->field_room_suitability_wall as $keyCS => $bft_application_value) {
				if("Digital Wall Tiles" === $all_data->field_product_category->value){

					if( $query_filter_page == 1  && $query_strings == 0){
						//print_r("here"); //exit;
						$variables['f_data_initial'][] = $all_data;
						$nid = $all_data->nid->value;
						$path = '/node/' . (int) $nid;
						$langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
						$path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
						$variables['f_data_path'][] = ["path" => $path_alias, "nid" => $nid];
						$nids[] = $all_data->nid->value;
					}

					if(count($final) == 1 ){

						if($query_filter_category){
							foreach ($all_data->field_product_category as $key => $category_value) {
								if($query_filter_category === $category_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_application){
							foreach ($all_data->field_room_suitability_wall as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_size){
							foreach ($all_data->field_product_sizes as $key => $sizes_value) {
								if($query_filter_size === $sizes_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_color){
							foreach ($all_data->field_product_color as $key => $color_value) {
								if($query_filter_color === $color_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

						if($query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									$variables['data_first'][] = $all_data;
								}
							}
						}

					}

					if(count($final) == 2 ){

						if($query_filter_category && $query_filter_application){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									$variables['data_first'][] = $all_data;
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $color_value) {
									if($query_filter_size === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_color){
							
								foreach ($all_data->field_product_color as $key => $color_value) {
									if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_category && $query_filter_finish){
							foreach ($all_data->field_product_finish as $key => $color_value) {
									if($query_filter_finish === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
										//echo $key; print_r("heaaere");
										$variables['data_first'][] = $all_data;
										//$s_1_nids[] = $all_data->nid->value;
									}
								}
						}

						if($query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_color as $key => $size_value) {
										if($query_filter_color === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $color_value) {
								if($query_filter_application === $color_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_finish as $keySF => $finish_value) {
								if($query_filter_finish === $finish_value->value){
									foreach ($all_data->field_product_sizes as $keySF => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish){
							foreach ($all_data->field_product_color as $keySF => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_finish as $keySF => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}
					}

					if(count($final) == 3 ){

						if($query_filter_category && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_color && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_color && $query_filter_application && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_product_color as $keyCS => $color_value) {
								if($query_filter_color === $color_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}

						}

						if($query_filter_category && $query_filter_finish && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									//echo $key; print_r("heaaere");
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
									
									//$s_1_nids[] = $all_data->nid->value;
								}
							}
						}

						if($query_filter_category && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_product_sizes as $keyCS => $size_value) {
								if($query_filter_size === $size_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_color as $key => $color_value) {
										if($query_filter_color === $color_value->value){
											$variables['data_first'][] = $all_data;
										}
									}
								}
							}
						}

					}
					if(count($final) == 4 ){

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_size && $query_filter_finish){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_finish && $query_filter_application && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_finish as $key => $finish_value) {
												if($query_filter_finish === $finish_value->value){
													foreach ($all_data->field_product_color as $key => $color_value) {
														if($query_filter_color === $color_value->value){
															$variables['data_first'][] = $all_data;
														}
													}	
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_finish && $query_filter_size && $query_filter_color){
							foreach ($all_data->field_product_finish as $keyCS => $finish_value) {
								if($query_filter_finish === $finish_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_sizes as $key => $size_value) {
										if($query_filter_size === $size_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}
						}

						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													$variables['data_first'][] = $all_data;
												}
											}
										}
									}
								}
							}

						}

					}

					if(count($final) == 5 ){
						if($query_filter_category && $query_filter_application && $query_filter_finish && $query_filter_color && $query_filter_size){
							foreach ($all_data->field_room_suitability_floor as $keyCS => $application_value) {
								if($query_filter_application === $application_value->value && $query_filter_category === $all_data->field_product_category->value){
									foreach ($all_data->field_product_finish as $key => $finish_value) {
										if($query_filter_finish === $finish_value->value){
											foreach ($all_data->field_product_color as $key => $color_value) {
												if($query_filter_color === $color_value->value){
													foreach ($all_data->field_product_sizes as $key => $size_value) {
														if($query_filter_size === $size_value->value){
															$variables['data_first'][] = $all_data;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			//}
		//}
	}
	/* GET the data - END */

	/* filters start */

	foreach ($variables['f_data'] as $key => $value) {
		if("Digital Wall Tiles" === $value->field_product_category->value){
			$variables['filter_field_cat'][] = $value->field_product_category->value;

			foreach ($value->field_product_finish as $key => $f_value) {
				$variables['filter_field_product_finish'][] = $f_value->value;
			}
			foreach ($value->field_product_sizes as $key => $s_value) {
				$variables['filter_field_product_size'][] = $s_value->value;
			}
			foreach ($value->field_product_color as $key => $d_value) {
				$variables['filter_field_product_colors'][] = $d_value->value;
			}
			foreach ($value->field_room_suitability_floor as $key => $sf_value) {
				$variables['filter_field_product_sus_f'][] = $sf_value->value;
			}
			foreach ($value->field_room_suitability_wall as $key => $sw_value) {
				$variables['filter_field_product_sus_w'][] = $sw_value->value;
			}
		}
	}


	$variables['filter_tile_categories'] = array_filter(array_unique($variables['filter_field_cat']));
	$variables['filter_product_finish'] = array_filter(array_unique($variables['filter_field_product_finish']));
	$variables['filter_product_size'] = array_filter(array_unique($variables['filter_field_product_size']));
	$variables['filter_product_color'] = array_filter(array_unique($variables['filter_field_product_colors']));
	$variables['filter_product_sus_f'] = array_filter(array_unique($variables['filter_field_product_sus_f']));
	$variables['filter_product_sus_w'] = array_filter(array_unique($variables['filter_field_product_sus_w']));
	$variables['filter_product_application'] = array_unique(array_merge((array)$variables['filter_product_sus_w'], (array)$variables['filter_product_sus_f']));

	//get FAQ data
	$faq_query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all FAQ node IDs.
	$faq_nids = $faq_query->condition('type', 'frequently_asked_questions')->execute();

	// Load all FAQ nodes.
	$faq_nodes = \Drupal\node\Entity\Node::loadMultiple($faq_nids);

	// Pass them to twig.
	$variables['faqs'] = $faq_nodes;

	$variables['faq_data'] = $variables['faqs'];
	foreach ($variables['faq_data'] as $key => $value) {
		$variables['faq_data_result'][] = $value;
	}
}

function vitero_preprocess_search_result(&$variables){

	$variables['#cache']['contexts'][] = 'url.query_args';
	$query_filter_keys = \Drupal::request()->get('keys');
	echo "<pre>"; print_r("hie"); 

	$result = $variables['result'];
	/*$variables['url'] = check_url($result['link']);
	$variables['title'] = check_plain($result['title']);*/
	var_dump($query_filter_keys);

	$query = \Drupal::entityTypeManager()->getStorage('node')->getQuery();

	// Get all Flower node IDs.
	$nids = $query->condition('type', 'content_type_products')->execute();

	// Load all Flower nodes.
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
	$variables['flowers'] = $nodes;
	$variables['f_data'] = $variables['flowers'];

	foreach ($variables['f_data'] as $key => $value) {
		if($query_filter_keys){
			if( preg_match($query_filter_keys, $value->field_product_category->value) ){
				echo "here";
				$variables['data_search'][] = $value;
			}
		}
	}
	print_r(count($variables['data_search']));
	exit;
}
