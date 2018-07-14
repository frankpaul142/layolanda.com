<?php 
use yii\helpers\Url;
?>
  	<tr>
     
            <td class="cont-imgthumb">
            	<img src="<?= URL::base() ?>/images/products/<?= $position->product->pictures[0]->description ?>" alt="producto"/>

       
            </td>

            <td >
            	<?= $position->product->title ?>-<?= $position->mesure->description ?>-<?= $position->type->description ?>

            </td>
            <?php if($position->type->description=='ORIGINAL'){ ?>
            <td ><input type="text" class="change_q" readonly="readonly" posid="<?= $position->id ?>" value="<?= $position->quantity ?>" /></td>
            <?php }else{ ?>
            <td ><input type="number" class="change_q" posid="<?= $position->id ?>" value="<?= $position->quantity ?>" /></td>
            <?php } ?>
            <td >
              <span class="valores-p c-blue">$<?= $position->getPrice() ?></span>
             </td>

              <td >$<?= number_format((float)($position->getPrice()*$position->quantity)+($position->getPrice()*$position->quantity*0.12), 2, '.', '') ?></td>
              <td>
                 <a href="<?= Url::to(['site/removefromcart','id'=>$position->id]) ?>">
                    <span id="x">X</span>
                  </a>
              </td>
          
             
    </tr>