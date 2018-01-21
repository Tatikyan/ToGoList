<style>
</style>

<template>
    <div id="places" class="page">
        <places-map></places-map>
    </div>
</template>


<script>
    import PlacesMap from '../components/places/PlacesMap.vue';
    // import EditMarker from '../components/popups/EditMarkers.vue';
    // Vue.component('edit-marker', EditMarker);
    export default {
        components: {
            PlacesMap
        }
    }
</script>

EditMarker