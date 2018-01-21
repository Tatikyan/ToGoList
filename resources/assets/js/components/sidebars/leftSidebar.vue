<template>
    <div id="left-sidebar">
        <div class="leftSidebarContent">
            <div class="searchBar">
                <input type="search" placeholder="Search places"/>
            </div>
            <ul>
                <li>
                    <div class="placeNameTitle">Place name</div>
                    <div class="VisitedTitle">Visited</div>
                </li>
                <li>
                    <div class="placeName">placeName</div>
                    <div class="PlaceVisitedCheckbox">
                        <input type="checkbox"/>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "left-sidebar"
    }
</script>

<style scoped>
.searchBar {
    width: 100%;
}
.searchBar input {
    margin: 0 auto;
    width: 65%;
    display: block;
}
.leftSidebarContent {
    width: 20%;
    height: 500px;
    float: left;
}
.leftSidebarContent ul div {
    width: 49%;
    display: inline-block;
}
.leftSidebarContent ul {
    padding:10px;
}
.leftSidebarContent li {
    list-style: none;
}
.placeNameTitle, .VisitedTitle {
    font-size: 20px;
}
</style>