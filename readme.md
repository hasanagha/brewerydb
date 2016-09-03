
BreweryDB's API PHP Library
---------------------------
A simple php library to communicate between brewery db's enpoints and custom php application.

Usage
---------------------------

```javascript

$bdo = new BrewerDB(
  array(
    'api_key' => 'brewerydbs_api_key'
  )
);
 
$bdo->sendRequest('beer/random');`


