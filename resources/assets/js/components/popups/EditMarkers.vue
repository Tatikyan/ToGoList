<template>
    <div id="edit-markers">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                Name the place
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                <input type="text" placeholder="Place name" v-model="placeName"/>
                                <label for="checkbox">Visited</label>
                                <input type="checkbox" id="checkbox" v-model="visited">
                                <div v-show="placeNameError" class="placeNameError">Place name can not be blank</div>
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button class="modal-default-button" v-on:click="cancel">
                                    Cancel
                                </button>
                                <button class="modal-default-button" v-on:click="save">
                                    Save
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    /*
    imports app config js
     */
    import TOGOLIST_CONFIG from '../../config.js';
    export default {
        name: "edit-markers",
        data(){
            return {
                placeName:"",
                placeNameError:false,
                visited:false,
                places: []
            }
        },
        methods: {
            /*
            if clicked save button than storing place into data base and adding marker on the map
            */
            save: function (event) {
                if(this.placeName === "") {
                    this.placeNameError = true;
                    return false;
                }
                var placeVisitedInfo;
                var placeObject = {
                    placeName: this.placeName,
                    visited: this.visited,
                    latitude:this.$root.position.latlng.lat(),
                    longitude:this.$root.position.latlng.lng()
                };
                /*
                adds info about visited or not place on the marker
                */
                if (this.visited === true){
                    placeVisitedInfo = " (Visited)";
                }else {
                    placeVisitedInfo = "";
                }
                /*
                creates new google marker
                */
                var marker = new google.maps.Marker({
                    position: this.$root.position.latlng,
                    label: this.placeName + placeVisitedInfo ,
                    map: this.$root.map
                });
                let uri = TOGOLIST_CONFIG.API_URL + 'places';
                /*
                creates ajax call with param placeObject to create marker if status is success than pushes marker to markers array
                */
                this.axios.post(uri, placeObject).then((response) => {
                    if(response.data.success === true){
                        placeObject.id = response.data.last_insert_id;
                        this.$root.map.panTo(this.$root.position.latlng);
                        this.$root.places.push(placeObject);
                        this.$root.markers.push(marker);
                        this.$root.$emit('places', this.$root.places);
                        this.$root.showModal = false;
                    }
                })
            },
            /*
            On cancel hide modal
            */
            cancel: function (event) {
                this.$root.showModal = false;
            }
        }
    }
</script>

<style scoped>
    /*
    styles for the edit markers component
     */
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }
    .modal-footer {
        height: 20px;
    }
    .modal-default-button {
        float: right;
        margin-left: 10px;
        cursor: pointer;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    .placeNameError {
        margin-top: 10px;
        color: #fd4738;
    }
</style>