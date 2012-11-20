<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */
    
namespace QuAdmin\Model;

class QuThumb
{
    protected $PhpThumb;
    protected $Config;

    /**
     * @param $PhpThumb
     * @param $Config
     *
     * @internal param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct($PhpThumb,$Config)
    {
        $this->PhpThumb = $PhpThumb;
        $this->Config   = $Config;
    }

    /**
     * @param $file
     * @param $data
     * @param $type
     *
     * @return array
     */
    public function create($file,$data,$type){

        //define route
        if(count($file) != 0){
            $rout = $this->Config['QuBasePath'].'/'.$type.'/';
            if ( ! is_dir($rout)) {
                mkdir($rout);
                chmod($rout, 0777);
            }
        }

        $cont = '0';
        foreach($file as $ky=>$f){

            $cont++;
            $extension = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
            if($extension!=''){


                if($data['name'] != ''){
                    //Name
                    $nom = $data['name'];
                }else{
                    //Is not name put name title
                    $nom = strtolower(pathinfo($f['name'], PATHINFO_FILENAME));
                    $data['name']  = $nom;
                    $data['title'] = $nom;
                }
                //name and route
                $SubName = $cont.'-'.$data['id'].'-'.$nom.'.'.$extension;

                //key is the name column in db
                $data[$ky] = $SubName;
                $NameFinal = $rout.$data[$ky];

                //Upload file
                move_uploaded_file($f['tmp_name'], $NameFinal);
                @chmod($NameFinal, 0777);
                //is image, generate thumb
                if($extension == 'jpg' or $extension == 'jpeg' or $extension == 'gif' or $extension == 'png'){
                    $thumb = $this->PhpThumb->create($NameFinal);

                    //1300
                    $thumb->adaptiveResize(1300,1300);
                    $thumb->save($rout.$data[$ky]);
                    @chmod($rout.$data[$ky], 0777);

                    //110
                    $thumb->adaptiveResize(110,110);
                    $thumb->save($rout.'s'.$data[$ky]);
                    @chmod($rout.'s'.$data[$ky], 0777);
                }
            }
            $extension = '';
        }

        return $data;
    }

    /**
     * @param $info
     * @param $document
     *
     * @return bool
     */
    public function Delete($info,$document){

        if(isset($info->type) and $info->type != ''){
            $type = $info->type;
        }elseif(isset($info['type']) and $info['type'] != ''){
            $type = $info['type'];
        }else{
            return;
        }

        $delete = $this->Config['QuBasePath'].'/'.$type.'/'.$info->$document;
        if(file_exists($delete)){
            @unlink($delete);
        }
        $deleteSmall = $this->Config['QuBasePath'].'/'.$type.'/s'.$info->$document;
        if(file_exists($deleteSmall)){
            @unlink($deleteSmall);
        }

        return true;
    }

}