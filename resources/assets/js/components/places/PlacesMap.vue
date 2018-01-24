<template>
    <div id="places-map">

    </div>
</template>

<script>
    import TOGOLIST_CONFIG from '../../config.js';
    export default {
        // declare the props
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
            },
            'placeName': {
                type: String,
                default: function(){
                    return ""
                }
            },
            'visited': {
                type: Number,
                default: function(){
                    return 0
                }
            },
            'markers': {
                type: Array,
                default: function(){
                    return []
                }
            }
        },
        data(){
            return {
                places: []
            }
        },
        computed: {
        },
        watch: {
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
             this.getPlaces();
             this.clickOnMap();
             this.$root.$on('showPlaceOnTheMap', this.showPlaceOnTheMap);
             this.$root.$on('updateMap', this.getPlaces);
        },

        methods: {
            /*
              Clears the markers from the map.
            */
            clearMarkers(places){
                /*
                  Iterate over all of the markers and set the map
                  to null so they disappear.
                */
                for( var i = 0; i < this.$root.markers.length; i++ ){
                    this.$root.markers[i].setMap( null );
                }
            },

            /*
              Gets all places from data base
            */
            getPlaces(){
                /*
                clears markers
                 */
                this.clearMarkers();
                var places = [];
                var self = this;
                let uri = TOGOLIST_CONFIG.API_URL + 'places';
                /*
                makes ajax call to data base and gets places
                */
                this.axios.get(uri).then((response) => {
                    places = response.data;
                    self.$root.$emit('places', places);
                    self.$root.places = places;
                    self.places = places;
                    /*
                    builds markers
                     */
                    this.buildMarkers(places);
                    return {
                        places: places
                    }
                });
            },
            /*
            Builds markers on the map
             */
            buildMarkers(places){
                /*
                  Iterate over all of the places
                */
                var placeVisitedInfo;
                for( var i = 0; i < places.length; i++ ){
                    if (places[i].visited === 1){
                        placeVisitedInfo = " (Visited)";
                    }else {
                        placeVisitedInfo = "";
                    }
                    var marker = new google.maps.Marker({
                        position: { lat: parseFloat( places[i].latitude ), lng: parseFloat( places[i].longitude ) },
                        label:{
                            text:places[i].placeName + placeVisitedInfo,
                            color:"black"
                        } ,
                        map: this.map
                    });
                    /*
                      Push the new marker on to the array.
                    */
                    this.$root.markers.push(marker);
                }
            },
            /*
            Shows selected place on the map
            */
            showPlaceOnTheMap(latlng){
                 this.$root.map = this.map;
                 this.$root.map.panTo(latlng);
            },
            /*
            Handles event on map click, puts the marker and makes it center aligned on the map
             */
            clickOnMap() {
                var selfMap = this.map;
                var root = this.$root;
                this.map.addListener('click', function(e) {
                    root.showModal = true;
                    root.map = selfMap;
                    root.position = {
                        latlng:e.latLng
                    };
                });
            }
        }
    }
</script>
<style lang="scss">
    /*
    styles for the places map component
     */
    div#places-map{
        height: 500px;
    }
</style>