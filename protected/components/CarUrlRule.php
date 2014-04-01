<?php
class CarUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    {
        switch ($route) {
            case "artikel/index":
                if (isset($params['kategori']))
                    return  'artikel/kategori/'. $params['kategori'];
                else if (isset($params['manufacturer']))
                    return $params['manufacturer'];
                break;
            case "artikel/view":


                break;
            case "halaman/index":


                break;
            case "artikel/index":


                break;

            default:
                break;
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches))
        {
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'
        }
        return false;  // this rule does not apply
    }
}
?>
