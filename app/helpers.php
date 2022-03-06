<?php

function uploadImage($folder, $image, $optional = null)
{
    if ($optional === "test") {
        $filename = $image->hashName();
        return $filename;
    }

    $x = $image->Store('/', $folder);
    $filename = $image->hashName();
    return $filename;
}


/**
 * Returns the Full path of a Picture
 * @param string $name The Name of the file with its extension at the end
 * @param string $path The Path to the file ex. Image/Vendor
 * @return string full Uri
 */
function getPhotoPath($name, $path){
    return ($name !== null) ? asset("store/".$path.'/'.$name)  : "";
}
