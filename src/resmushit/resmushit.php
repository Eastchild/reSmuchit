<?php

namespace resmushit;

/**
 * simple reSmush.it library
 * 
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * 
 * @author Florian Duval <florian.duval.06@gmail.com>
 * @package reSmushit
 * @version 1.0.0
 */
class resmushit 
{
    
    const API = 'http://api.resmush.it/ws.php?img=';
    
    /**
     * Call the reSmush.it API to compress a picture
     * 
     * @param string $sPicture URL of the uploaded picture
     * @param int $nQuality JPG compression level
     * @return string URL of the optimized picture
     * @throws Exception
     */
    public function compress($sPicture, $nQuality = 92) {
        
        //File to compress must exist
        if(!is_file($sPicture)) {
            throw new Exception('No file found');
        }
        
        // level for JPG compression between 0 and 100
        if($nQuality < 0 || $nQuality > 100) {
            throw new Exception('Level for JPG compression must be between 0 and 100, your is : '.$nQuality);
        }
        
        $oCompressedPicture = json_decode(file_get_contents(self::API . $sPicture.'&qlty='.$nQuality));

        if(isset($oCompressedPicture->error)){
            throw new Exception('An error as occuried : '.$oCompressedPicture->error.' - '.$oCompressedPicture->error_long);
        }
        
        return $oCompressedPicture->dest; 
    }
}