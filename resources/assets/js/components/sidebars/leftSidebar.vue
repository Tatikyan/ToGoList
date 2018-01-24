<template>
    <div id="left-sidebar">
        <div class="leftSidebarContent">
            <div class="searchBar">
                <input type="search" placeholder="Search places" v-model="search"/>
            </div>
            <ul>
                <li>
                    <div class="placeNameTitle">Place name</div>
                    <div class="VisitedTitle">Visited</div>
                </li>
                <li v-for="place in filteredPlaces" v-on:click="showPlaceOnTheMap(place)">
                    <div class="placeName">{{place.placeName}}</div>
                    <div class="PlaceVisitedCheckbox">
                        <input type="checkbox" v-model="place.visited" v-on:change="changeVisitedStatus(place, place.visited = place.visited)"/>
                    </div>
                    <button class="removePlace" v-on:click="removePlace(place.id)">X</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    /*
    imports app config js
     */
    import TOGOLIST_CONFIG from '../../config.js';
    export default {
        name: "left-sidebar",
        data(){
            return {
                search: "",
                places:[]
            }
        },
        computed:
            {
                /*
                returns filtered result for search
                 */
                filteredPlaces:function()
                {
                    var self = this;
                    return this.places.filter(function(cust){return cust.placeName.toLowerCase().indexOf(self.search.toLowerCase())>=0;});
                }
            },
        created: function () {
            this.$root.$on('places', this.getPlaces);
        },
        /*
        watches getPlaces method and filters places
         */
        watch: {
            getPlaces(){
                this.filteredPlaces();
            }
        },
        methods: {
            /*
            gets places
             */
            getPlaces: function(places){
                this.places = places;
                return places;
            },
            /*
            shows selected places on the map by calling showPlaceOnTheMap method in placesMap component
             */
            showPlaceOnTheMap: function(place){
                var latlng = {
                    lat:Number(place.latitude),
                    lng:Number(place.longitude)
                }
                 this.$root.$emit('showPlaceOnTheMap', latlng);
            },
            /*
            removes place from the data base then updates the map by calling updateMap method in placesMap component
             */
            removePlace: function(id) {
                let uri = TOGOLIST_CONFIG.API_URL + `places/${id}`;
                this.axios.delete(uri);
                this.$root.$emit('updateMap', this.$root.places);
            },
            /*
            changes visited status by calling updateMap method in placesMap component
             */
            changeVisitedStatus: function(place){
                let uri = TOGOLIST_CONFIG.API_URL +`places/${place.id}`;
                this.axios.patch(uri, place).then((response) => {
                      this.$root.$emit('updateMap', this.$root.places);
                });
            }
        }
    }
</script>

<style scoped>
    /*
    styles for the left sidebar component
     */
.searchBar {
    box-shadow: 3px 3px 5px #888888;
    width: 65%;
    margin: 0 auto;
}
.searchBar input {
    margin: 0 auto;
    width: 100%;
    display: block;
}
.leftSidebarContent {
    width: 20%;
    height: 476px;
    float: left;
    min-width: 200px;
    border: 2px solid #a3ccff;
    padding: 10px;
    box-shadow: -2px -3px 19px #cbe6a4;
    overflow: auto;
}
.placeNameTitle {
    width: 65%;
    display: inline-block;
}
.VisitedTitle {
     display: inline-block;
 }
.placeName {
    width: 70%;
    display: inline-block;
    text-align: center;
}
.PlaceVisitedCheckbox {
    width: 10%;
    display: inline-block;
    vertical-align: middle;
}
.removePlace {
    width: 14%;
    cursor: pointer;
    background-color: #f7584e;
}
.leftSidebarContent ul {
    padding:10px;
}
.leftSidebarContent li {
    list-style: none;
    margin-top: 10px;
    cursor: pointer;
    padding: 2px;
}
.leftSidebarContent li:nth-child(even) {
    background: #cbe6a3;
    border-radius: 5px;
}
.leftSidebarContent li:nth-child(odd) {
    background: #a3ccff;
    border-radius: 5px;
}
.placeNameTitle, .VisitedTitle {
    font-size: 20px;
    text-align: center;
}
.leftSidebarContent li:first-child {
    background-color: transparent;
}
</style>