<?php

function getCaseStudies( $data ) {
	$result = array();
	foreach( $data['case_studies'] as $slug => $details ) {
		$result[$slug] = getCaseStudy( $slug, $data );
	}
	return $result;
}

function getCaseStudy( $slug, $data ) {
	$result = array();
	if ( isset($data['case_studies'][$slug]) ) {
		$result = $data['case_studies'][$slug];
		$people = $result['people'];
		$activities = $result['activities'];
		$cases = $result['cases'];
		$result['people'] = array();
		$result['activities'] = array();
		$result['cases'] = array();
		foreach( $people as $person ) {
			if ( isset($data['people'][$person]) ) {
				$result['people'][$person] = $data['people'][$person];
			}
		}
		foreach( $activities as $act ) {
			if ( isset($data['activities'][$act]) ) {
				$result['activities'][$act] = $data['activities'][$act];
			}
		}
		foreach( $cases as $case ) {
			if ( isset($data['case_studies'][$case]) ) {
				$result['cases'][$case] = $data['case_studies'][$case];
			}
		}
		return $result;
	}
	return null;
}

function getCaseStudiesForPerson( $person_slug, $data ) {
	$related = array();
	foreach ( $data['case_studies'] as $key => $cs ) {
		if ( in_array( $person_slug, $cs['people']) ) {
			$related[$key] = getCaseStudy($key, $data);
		}
	}
	return $related;
}

function getCaseStudiesForActivity( $activity_slug, $data ) {
	$related = array();
	foreach ( $data['case_studies'] as $key => $cs ) {
		if ( in_array( $activity_slug, $cs['activities']) ) {
			$related[$key] = getCaseStudy($key, $data);
		}
	}
	return $related;
}

function pagination($array, $slug=null) {
	$keys = array_keys($array);
	$pagination = Array();

		    
	if($slug===null) {
		$nextKey = 0;
		$prevKey = count($keys)-1;
	} else {	
	    $pos = array_search($slug, $keys);
		if($pos>-1) {
			$nextKey = ($pos+1 < count($keys))?$pos+1:0;
			$prevKey = ($pos-1 > -1)?$pos-1:count($keys)-1;
		} else {
			$nextKey = 0;
			$prevKey = count($keys)-1;
		}
	}

	$page['nextHref'] = $keys[$nextKey];
	$page['nextTitle'] = $array[$page['nextHref']]['name'];
	$page['prevHref'] = $keys[$prevKey];
	$page['prevTitle'] = $array[$page['prevHref']]['name'];
	return $page;
}
