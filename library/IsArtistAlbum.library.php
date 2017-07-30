<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IsArtistAlbum
 *
 * @author ginomazzola
 */
class IsArtistAlbum {
    public static function Helper($albumId){
        $albumDb = new AlbumDb();
        return $albumDb->isArtistAlbum($albumId);
    }
}
