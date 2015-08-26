(function (window, google) {

    var Mapster = (function(){
        function Mapster(element, opts){
            this.gMap = new google.maps.Map(element, opts);
            this.markers = [];
        };

        Mapster.prototype = {

            zoom: function(level){
                if(level){
                    this.gMap.setZoom(level);
                }else{
                    return this.gMap.getZoom();
                }
            },

            _on: function(opts){
                var self = this;
                google.maps.event.addListener(opts.obj, opts.event, function(e){
                    opts.callback.call(self, e);
                });
            },

            addMarker:function(opts){
                var marker;
                opts.position = {
                    lat: opts.lat,
                    lng: opts.lng
                };
                marker = this._createMarker(opts);
                this._addMarker(marker);

                //add events
                if(opts.event){
                  this._on({
                      obj: marker,
                      event: opts.event.name,
                      callback: opts.event.callback
                  });
                }

                //add infoWindow
                if(opts.content){
                    this._on({
                        obj: marker,
                        event: 'click',
                        callback:function(){
                            var infoWindow = new google.maps.InfoWindow({
                                content : opts.content
                            });
                            infoWindow.open(this.gMap, marker);
                        }
                    })
                }
                return marker;
            },

            //push markers into array
            _addMarker: function(marker){
                this.markers.push(marker);
            },

            //remove markers from array
            _removeMarker: function(marker){
                var indexOf = this.markers.indexOf(marker);
                //check if marker exists inside the array
                if(indexOf != -1){
                    this.markers.splice(indexOf, 1);
                    marker.setMap(null);
                }
            },

            //create Markers
            _createMarker: function(opts){
                opts.map = this.gMap;
                return new google.maps.Marker(opts);
            },
        };

        return Mapster;
    })();

    //factory function (returns an instance of the object)
    Mapster.create = function(element, opts){
        return new Mapster(element, opts);
    };

    window.Mapster = Mapster;

})(window, google);