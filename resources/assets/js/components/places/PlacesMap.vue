<style lang="scss">
    div#places-map{
        width: 80%;
        height: 500px;
    }
</style>

<template>
    <div id="places-map">

    </div>
</template>


<script>
    import EditMarker from '../popups/EditMarkers.vue';
    export default {
        props: {
            'latitude': {
                type: Number,
                default: function(){
                    return 59.334591
                }
            },
            'longitude': {
                type: Number,
                default: function(){
                    return 18.063240
                }
            },
            'zoom': {
                type: Number,
                default: function(){
                    return 6
                }
            }
        },

        data(){
            return {
                markers: []
            }
        },

        computed: {
            /*
              Gets the places
            */
            places(){
                // return this.$store.getters.getPlaces
                return {
                    markerCoordinates: [{
                        latitude: 58.351307,
                        longitude: 11.885834
                    }, {
                        latitude: 57.751442,
                        longitude: 16.628838
                    }, {
                        latitude: 57.708870,
                        longitude: 11.974560
                    }]
                }
            }
        },

        watch: {
            /*
              Watches the places. When they are updated, clear the markers
              and re build them.
            */
            places(){
                this.clearMarkers();
                this.buildMarkers();
            }
        },

        mounted(){
            /*
              We don't want the map to be reactive, so we initialize it locally,
              but don't store it in our data array.
            */
            this.map = new google.maps.Map(document.getElementById('places-map'), {
                center: {lat: this.latitude, lng: this.longitude},
                zoom: this.zoom
            });

            /*
              Clear and re-build the markers
            */
            this.clearMarkers();
            this.buildMarkers();
            this.clickOnMap();
        },

        methods: {
            /*
              Clears the markers from the map.
            */
            clearMarkers(){
                /*
                  Iterate over all of the markers and set the map
                  to null so they disappear.
                */
                for( var i = 0; i < this.markers.length; i++ ){
                    this.markers[i].setMap( null );
                }
            },

            /*
              Builds all of the markers for the places
            */
            buildMarkers(){
                /*
                  Initialize the markers to an empty array.
                */
                this.markers = [];

                /*
                  Iterate over all of the places
                */
                for( var i = 0; i < this.places.markerCoordinates.length; i++ ){
                    /*
                      Create the marker for each of the cafes and set the
                      latitude and longitude to the latitude and longitude
                      of the cafe. Also set the map to be the local map.
                    */
                    var marker = new google.maps.Marker({
                        position: { lat: parseFloat( this.places.markerCoordinates[i].latitude ), lng: parseFloat( this.places.markerCoordinates[i].longitude ) },
                        map: this.map
                    });

                    /*
                      Push the new marker on to the array.
                    */
                    this.markers.push( marker );
                }
            },
            /*
            Handles event on map click, puts the marker and makes it center aligned on the map
             */
            clickOnMap() {
                var marker;
                var selfMap = this.map;
                var root = this.$root;
                this.map.addListener('click', function(e) {
                    root.showModal = true;
                    marker = new google.maps.Marker({
                        position: e.latLng,
                        map: selfMap
                    });
                    selfMap.panTo(e.latLng);
                });
                this.markers.push(marker);
            }
        }
    }
</script>