function makeTags(cats, theForm) {

	if (cats.options) {
		// cats in a select box
		numCats = cats.options.length;
		checkboxes = false;
	} else {
		// cats in checkboxes
		checkboxes = true;
	}
	theTags = theForm.tags;
	currentTags = theTags.value;
	
	// add trailing space if reqd
//	if (currentTags.substring(currentTags.length-1) != " ") {
//		theTags.value = currentTags + " ";
//	}
	
	if (!checkboxes) {	
		for (var i=0; i<numCats; i++) {
			cat = cats.options[i];
			currentTags = theTags.value;
			thisCat = cat.text;
			thisCat = formatTag(thisCat);
			if (cat.selected) {
				if (currentTags.indexOf(thisCat) < 0) {
					comma = (currentTags=="")?"":", ";
					theTags.value = currentTags + comma + thisCat;
				}
			} else {
				catPos = currentTags.indexOf(thisCat);
				if (catPos > -1) {
					tagsFirstHalf = currentTags.substring(0, catPos);
					tagsSecondHalf = currentTags.substring(catPos+thisCat.length+2, currentTags.length);
					theTags.value = tagsFirstHalf + tagsSecondHalf;
				}
			}
		}
	} else if (checkboxes) {
		cats = theForm["category_ids[]"];
		numCats = cats.length;
		
		for (var i=0; i<numCats; i++) {
			cat = cats[i];
			currentTags = theTags.value;
			catLabel = cat.parentNode;
			thisCat = catLabel.lastChild.nodeValue;
			thisCat = formatTag(thisCat);
			if (cat.checked) {
				if (currentTags.indexOf(" " + thisCat + " ") < 0) {
					theTags.value = currentTags + thisCat + " ";
				}
			} else {
				catPos = currentTags.indexOf(" " + thisCat + " ");
				if (catPos > -1) {
					tagsFirstHalf = currentTags.substring(0, catPos);
					tagsSecondHalf = currentTags.substring(catPos+thisCat.length+2, currentTags.length);
					theTags.value = tagsFirstHalf + " " + tagsSecondHalf;
				}
			}
		}
	}
}


function formatTag(tag) {
//	tag = tag.replace(/ /g, "");
	tag = tag.replace(/\&/g, "and");
	tag = tag.replace(/ \| /g, ", ");
//	tag = tag.replace(/\-/g, "");
//	tag = tag.replace(/\//g, "");
	tag = tag.replace(/etc\./g, "");
	return tag;
}