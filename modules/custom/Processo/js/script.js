jQuery(document).ready(function(){jQuery(document).ready(function () {
	jQuery('.autocomplete-orthanc').typeahead({
			source : function(query, result) {
				jQuery.ajax({
					url : "https://mdws-mdw.193b.starter-ca-central-1.openshiftapps.com/mdw/rest/orthanc",
					data : 'query=' + query,
					dataType : "json",
					type : "GET",
					success : function(data) {
						result(jQuery.map(data, function(item) {
							return item;
						}));
					}
				});
			}
		});
	});
});