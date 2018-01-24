/*
    Defines the API config we are using.
*/
var api_url = '';
var google_maps_js_api = 'AIzaSyCjsUCu9TfXeAuJmwnSA3nximCb0fZ8vR0';
var TOGOLIST_CONFIG;

switch( process.env.NODE_ENV ){
    case 'development':
        api_url = 'http://localhost:8000/';
    case 'production':
        api_url = 'http://localhost:8000/';
        break;
}
export default TOGOLIST_CONFIG = {
    API_URL: api_url,
    GOOGLE_MAPS_JS_API: google_maps_js_api
}

