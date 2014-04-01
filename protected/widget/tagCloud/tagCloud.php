<?php
class tagCloud extends SerayuWidget{
    
    public $jumlah = 10;
    public $tagClass = '';
    
    public function buatTag()
    {
            $tags=Tag::model()->findTagWeights($this->jumlah);

            foreach($tags as $tag=>$weight)
            {
                    $link=CHtml::link(CHtml::encode($tag), array('artikel/index','tag'=>$tag));
                    echo CHtml::tag('span', array(
                            'class'=>$this->class,
                            'style'=>"font-size:{$weight}pt",
                    ), $link)."\n";
            }
    }
    
}
