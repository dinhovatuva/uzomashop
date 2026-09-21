<?php 

namespace Core;

class UploadImg{
	//This method receveid destine path  and file to will upload
	public static function upload($path,$file=array())
	{	
		$ext= substr($file['img']['name'], -3);
		$source=$file['img']['tmp_name'];
		$source_name= $file['img']['name']; 
		if(($source_name<> "none")&& ($source_name <> "") && ($ext==='jpg' || $ext==='png'))
		{
			$image_name = date('YmdHis').'.'.$ext;
			$image = new UploadImg();
			if($image->createThumbnail($source,$ext,$path.$image_name)){
				$_POST["img"]= $path.$image_name;
				echo "imagem carregada com sucesso!";
			}
		}else{
				echo "Erro ao carregar imagem!";
		}
	}
	public function createThumbnail($img,$ext,$dest,$qualityjpg=70,$qualitypng=9)
	{
		//get the image width and height
		list($old_width,$old_height)= getimagesize($img);
		$new_width = floor($old_width*1);
		$new_height = floor($old_height*1);
		$new_image = imagecreatetruecolor($new_width,$new_height);
		// preserve transparency
  		if($ext == "png"){
    		imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
    		imagealphablending($new_image, false);
    		imagesavealpha($new_image, true);
  		}
		switch($ext){
			case 'jpg':
				$old_image = imagecreatefromjpeg($img);
			break;
			case 'png':
				$old_image = imagecreatefrompng($img);
			break;
		}
		imagecopyresampled($new_image,$old_image,0,0,0,0,$new_width,$new_height,$old_width,$old_height);
		switch($ext){
    		case 'jpg': imagejpeg($new_image,$dest,$qualityjpg); break;
    		case 'png': imagepng($new_image, $dest,$qualitypng); break;
        }
        return true;
		
		imagedestroy($old_image);
		imagedestroy($new_image);
	}
}