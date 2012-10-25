<?php
/**
 * 
 * VideoYoutube Class 
 * 
 * El Widget permite mostrar un video de YouTube
 * 
 * @copyright 
 * 
 * Copyright (c) 2012 Jose Oscar Vogel
 * 
 * Se permite el uso, modificacion y distribucion del contenido del mismo
 *
 * Ejemplo de uso:
 * $this->widget('ext.video.VideoYouTube',
 *   	array('htmlOptions'=>array(
 *      	'width'=>640,
 *       	'height'=>480,
 *       	'src'=>'http://www.youtube.com/watch?v=yePBXsH7LhI',
 *   	)));
 */

class VideoYouTube extends CWidget{
	
	public $htmlOptions = array();
	public $defaultHtmlOptions = array();

	public function init(){

		if (!isset($this->htmlOptions['src']))
			throw new CException('Debe setear el atributo "src" en "htmlOptions".');

		$this->defaultHtmlOptions = array('width' => '600', 'height' => '500');

		$this->htmlOptions = CMap::mergeArray($this->defaultHtmlOptions, $this->htmlOptions);
	}

	public function run(){
		$this->RenderContent();
	}


	protected function renderContent()
	{
		echo CHtml::openTag('iframe',array(
				'src'=>'http://www.youtube.com/embed/'. $this->getYouTubeCode($this->htmlOptions['src']) . '?rel=' .
				(isset($this->htmlOptions['rel']) ? $this->htmlOptions['rel'] : '1') . '&border=' .
				(isset($this->htmlOptions['border']) ? $this->htmlOptions['border'] : '0'),
				'type'=>'application/x-shockwave-flash',
				'width'=>$this->htmlOptions['width'],
				'height'=>$this->htmlOptions['height'],
			));

		echo CHtml::closeTag('iframe');
	}

	 /**
         * Obtiene el codigo de YouTube de un link de YouTube
         * @param string link
         * @return string YouTube codigo
         */
    protected function getYouTubeCode($link)
    {
        $pos = strrpos ($link, '/');
        if($pos !== false) 
            return substr($link, $pos);
        else
			return '';
    }
}

?>