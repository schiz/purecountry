$(function(){
ymaps.ready(function(){
var Map = {
	$map: $('#farm-map'),
	mapData: eval($("#map-data").text()),
	showMap: function(){
		var app = this,
			mapBounds = {
				minLat:32000,
				minLon:32000,
				maxLat:0,
				maxLon:0
			}
		for(i in app.mapData){
			var lat = parseFloat(app.mapData[i].COORDS[0])
			var lon = parseFloat(app.mapData[i].COORDS[1])
			if(lat>mapBounds.maxLat) mapBounds.maxLat = lat
			if(lat<mapBounds.minLat) mapBounds.minLat = lat
			if(lon>mapBounds.maxLon) mapBounds.maxLon = lon
			if(lon<mapBounds.minLon) mapBounds.minLon = lon
		}
		app.map = new ymaps.Map(app.$map[0],
			ymaps.util.bounds.getCenterAndZoom(
				[[mapBounds.minLat, mapBounds.minLon], [mapBounds.maxLat, mapBounds.maxLon]],
	            [app.$map.width(), app.$map.height()]
			)
	    )
		app.map.controls
			.add('zoomControl')
			.add('typeSelector')
			.add('mapTools')
		for(i in app.mapData){
			app.map.geoObjects.add(new ymaps.Placemark(
				[app.mapData[i].COORDS[0], app.mapData[i].COORDS[1]],
				{
					balloonContentHeader: app.mapData[i].NAME,
					balloonContentBody: app.mapData[i].PLACE,
					hintContent: app.mapData[i].NAME
				},
				{
					iconImageHref: '/bitrix/templates/food/images/map_marker_small.png',
					iconImageSize: [20,30],
					iconImageOffset: [-10,-30]
				}
			))
		}
	},

	Init: function(){
		var app = this
		app.showMap()
	}

}
Map.Init()
})
})