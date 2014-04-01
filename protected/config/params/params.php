<?php
//------params global-------
$fileGlobal = dirname(__FILE__).'/globalParams.inc';
$contentGlobal = file_get_contents($fileGlobal);
$global = unserialize(base64_decode($contentGlobal));

return CMap::mergeArray(
        $global,
        array(
            "salt"=>"s0195",
        )
    )
;

?>