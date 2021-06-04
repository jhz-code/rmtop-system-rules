<?php


namespace RmTop\lib;


class PublishFile
{

    /**
     * 发布到系统
     */
   static function PublishFileToSys(){
        $destination = app_path() . '/database/migrations/';
        if(!is_dir($destination)){
            mkdir($destination, 0755, true);
        }
        $source = __DIR__.'/../../database/migrations/';
        $handle = dir($source);

        while($entry=$handle->read()) {
            if(($entry!=".")&&($entry!="..")){
                if(is_file($source.$entry)){
                    copy($source.$entry, $destination.$entry);
                }
            }
        }

        if (!file_exists(config_path().'rmtop.conf')) {
            copy(__DIR__.'/../../config/rmtop.conf', config_path().'rmtop.conf');
        }
    }

}