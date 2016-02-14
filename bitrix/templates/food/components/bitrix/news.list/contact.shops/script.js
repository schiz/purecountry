$(function(){
ymaps.ready(function(){
var Map = {
	$centralMap: $('#central-office-map'),
	$shopsMap: $('#shops-map'),
	mapData: eval($("#map-data").text()),
	
	setCentralOffice: function(){
		var app = this,
			office = app.mapData.CENTRAL_OFFICE,
			baloonContent = '<div class="place-info text-center">'
        if(office.ADDRESS) baloonContent += '<p>'+office.ADDRESS+'</p>'
        if(office.PHONE) baloonContent += '<p>'+office.PHONE+'</p>'
        baloonContent += '</div>'
		app.centralMap = new ymaps.Map(app.$centralMap[0], {
			center:[office.COORDS[0],office.COORDS[1]],
			zoom:10
		})
		app.centralMap.controls
			.add('zoomControl')
			.add('typeSelector')
			.add('mapTools')
		app.centralMap.geoObjects.add(new ymaps.Placemark(
			[office.COORDS[0], office.COORDS[1]],
			{
				balloonContentHeader: office.NAME,
				balloonContentBody: baloonContent,
				hintContent: office.NAME
			},
			{
				iconImageHref: '/bitrix/templates/food/images/map_marker_main.png',
				iconImageSize: [34, 50],
				iconImageOffset: [-17,-50]
			}
		))
	},
	setProduction: function(){
		var app = this,
			production = app.mapData.CENTRAL_OFFICE,
			baloonContent = '<div class="place-info text-center">'
        if(production.ADDRESS) baloonContent += '<p>'+production.ADDRESS+'</p>'
        if(production.PHONE) baloonContent += '<p>'+production.PHONE+'</p>'
        baloonContent += '</div>'
		app.centralMap = new ymaps.Map(app.$centralMap[0], {
			center:[production.COORDS[0],production.COORDS[1]],
			zoom:10
		})
		app.centralMap.controls
			.add('zoomControl')
			.add('typeSelector')
			.add('mapTools')
		app.centralMap.geoObjects.add(new ymaps.Placemark(
			[production.COORDS[0], production.COORDS[1]],
			{
				balloonContentHeader: production.NAME,
				balloonContentBody: baloonContent,
				hintContent: production.NAME
			},
			{
				iconImageHref: '/bitrix/templates/food/images/map_marker_main.png',
				iconImageSize: [34, 50],
				iconImageOffset: [-17,-50]
			}
		))
	},
	setShops: function(){
		var app = this,
			mapBounds = {
				minLat:32000,
				minLon:32000,
				maxLat:0,
				maxLon:0
			}

		for(i in app.mapData.SHOPS){
			var lat = parseFloat(app.mapData.SHOPS[i].COORDS[0])
			var lon = parseFloat(app.mapData.SHOPS[i].COORDS[1])
			if(lat>mapBounds.maxLat) mapBounds.maxLat = lat
			if(lat<mapBounds.minLat) mapBounds.minLat = lat
			if(lon>mapBounds.maxLon) mapBounds.maxLon = lon
			if(lon<mapBounds.minLon) mapBounds.minLon = lon
		}
        
		/*app.shopsMap = new ymaps.Map(app.$shopsMap[0],
			ymaps.util.bounds.getCenterAndZoom(
				[[mapBounds.minLat, mapBounds.minLon], [mapBounds.maxLat, mapBounds.maxLon]],
	            [app.$shopsMap.width(), app.$shopsMap.height()]
			)
	    ) 
		app.shopsMap.controls
			.add('zoomControl')
			.add('typeSelector')
			.add('mapTools')
        
         */
		for(i in app.mapData.SHOPS){
			var shop = app.mapData.SHOPS[i],
				baloonContent = '<div class="place-info text-center">'
            if(shop.ADDRESS) baloonContent += '<p>'+shop.ADDRESS+'</p>'
            if(shop.PHONE) baloonContent += '<p>'+shop.PHONE+'</p>'
            baloonContent += '</div>'
            
			app.centralMap.geoObjects.add(new ymaps.Placemark(
				[shop.COORDS[0], shop.COORDS[1]],
				{
					balloonContentHeader: shop.NAME,
					balloonContentBody: baloonContent,
					hintContent: shop.NAME
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
		app.setCentralOffice()
		app.setShops()
	}

}
Map.Init()
})
})