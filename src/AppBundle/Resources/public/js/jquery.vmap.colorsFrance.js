

// var data = $.getJSON("data.json");
// var test = JSON.parse('{ "departement": 1,"pourcentage_votant": 34,"pourcentage_inscrit": 90,"nombre_voie": 664687 }');


// var s = document.getElementById("selectCandidat");
// var candidatUrl = s.options[s.selectedIndex].value;
// 	// 	window.history.pushState("Details", "Title", document.getElementById("selectCandidat").options[document.getElementById("selectCandidat").selectedIndex].value);




$( document ).ready(function() {

	var map = $('#francemap').vectorMap({
	    map: 'france_fr',
		hoverOpacity: 0,
		hoverColor: "#EC0000",
		backgroundColor: "transparent",
		borderColor: "#000000",
		selectedColor: "#FF0000",
		enableZoom: true,
		showTooltip: true,
	    onRegionClick: function(element, code, region)
	    {
	        var message = 'Département : "'
	            + region 
	            + '" || Code : "'
	            + code
				+ '"';
	        /*alert(message);*/
	    }
	});


	$('select').on('change', function () {
		//alert( this.value );

		if (this.value != null) {

			var candidatColor = new Array();
			while (candidatColor[0] != null) {
				candidatColor.pop();
			}

			switch (this.value) {
				case "1":
					candidatColor.push("#e5edf1", "#b2cbd7", "#80a8bc", "#4d85a1", "#1a6387", "#00496d", "#003955", "#00293d", "#001824", "#00080c"); break;
				case "2":
					candidatColor.push("#e6f1f2", "#b4d7da", "#82bdc2", "#50a3a9", "#1d8991", "#046f77", "#03565d", "#023e42", "#012527", "#000c0d"); break;
				case "3":
					candidatColor.push("#fae7e7", "#f2b8b9", "#e9898b", "#e05a5d", "#d82b2f", "#be1215", "#940e10", "#6a0a0c", "#3f0607", "#150202"); break;
				case "4":
					candidatColor.push("#fdfeef", "#f9fccf", "#f6fbb0", "#f2fa90", "#eef870", "#d5df57", "#a5ad43", "#767c30", "#474a1d", "#171809"); break;
				case "5":
					candidatColor.push("#fae7e7", "#f2b8b9", "#e9898b", "#e05a5d", "#d82b2f", "#be1215", "#940e10", "#6a0a0c", "#3f0607", "#150202"); break;
				case "6":
					candidatColor.push("#e5edf1", "#b2cbd7", "#80a8bc", "#4d85a1", "#1a6387", "#00496d", "#003955", "#00293d", "#001824", "#00080c"); break;
				case "7":
					candidatColor.push("#fae7e7", "#f2b8b9", "#e9898b", "#e05a5d", "#d82b2f", "#be1215", "#940e10", "#6a0a0c", "#3f0607", "#150202"); break;
				case "8":
					candidatColor.push("#fae7e7", "#f2b8b9", "#e9898b", "#e05a5d", "#d82b2f", "#be1215", "#940e10", "#6a0a0c", "#3f0607", "#150202"); break;
				case "9":
					candidatColor.push("#e5edf1", "#b2cbd7", "#80a8bc", "#4d85a1", "#1a6387", "#00496d", "#003955", "#00293d", "#001824", "#00080c"); break;
				case "10":
					candidatColor.push("#e6f1f2", "#b4d7da", "#82bdc2", "#50a3a9", "#1d8991", "#046f77", "#03565d", "#023e42", "#012527", "#000c0d"); break;
				case "11":
					candidatColor.push("#fdfeef", "#f9fccf", "#f6fbb0", "#f2fa90", "#eef870", "#d5df57", "#a5ad43", "#767c30", "#474a1d", "#171809"); break;
				default:
					candidatColor.push("white", "white", "white", "white", "white");
			};

/*

 */

			for (var i = 0; i < 10; i++) {
				$('.color-'+i).css('background-color',candidatColor[i]);
			}

			$.ajax({
              	url: route,
				type: "POST",
				data: { 'id' : this.value }
			})
			.done(function(data){
				data = JSON.parse(data)
				var mapColor = {};
				data.forEach(function(element, index) {
					if (element["pourcentage_votant"] <= 10) {
					 	mapColor[element["departement"]] = candidatColor[0];
					}
					else if (element["pourcentage_votant"] > 10 && element["pourcentage_votant"] <= 20) {
					 	mapColor[element["departement"]] = candidatColor[1];
					}
					else if (element["pourcentage_votant"] > 20 && element["pourcentage_votant"] <= 30) {
					 	mapColor[element["departement"]] = candidatColor[2];
					}
					else if (element["pourcentage_votant"] > 30 && element["pourcentage_votant"] <= 40) {
					 	mapColor[element["departement"]] = candidatColor[3];
					}
					else if (element["pourcentage_votant"] > 40 && element["pourcentage_votant"] <= 50) {
					 	mapColor[element["departement"]] = candidatColor[4];
					}
					else if (element["pourcentage_votant"] > 50 && element["pourcentage_votant"] <= 60) {
					 	mapColor[element["departement"]] = candidatColor[5];
					}
					else if (element["pourcentage_votant"] > 60 && element["pourcentage_votant"] <= 70) {
					 	mapColor[element["departement"]] = candidatColor[6];
					}
					else if (element["pourcentage_votant"] > 70 && element["pourcentage_votant"] <= 80) {
					 	mapColor[element["departement"]] = candidatColor[7];
					}
					else if (element["pourcentage_votant"] > 80 && element["pourcentage_votant"] <= 90) {
					 	mapColor[element["departement"]] = candidatColor[8];
					}
					else if (element["pourcentage_votant"] > 90 && element["pourcentage_votant"] <= 100) {
					 	mapColor[element["departement"]] = candidatColor[9];
					}
				});
				$('#francemap').vectorMap('set', 'colors', mapColor);
			});
		}
	});
});