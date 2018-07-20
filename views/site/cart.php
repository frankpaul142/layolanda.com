<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\web\View;
use app\models\Dhl;
use yii\helpers\Json;
$this->title =Yii::t('bag', 'Shopping Cart');
$paypalurl=Url::to(['shop/paypal']);
$display="block";
$display2="block";
$number=0;
$impuesto1=0;
$shipping=0;
$dhl=0;
$total_weight=0;
$zone=0;
$cost=Yii::$app->cart->getCost(true);
$iva=0.12; 
$number=Yii::$app->cart->getCost(true)*$iva;
$impuesto=number_format((float)$number, 2, '.', '');
   foreach(Yii::$app->cart->positions as $position){
          $total_weight+=$position->weight;
        }
if(!Yii::$app->user->isGuest){
      $dhl1=Dhl::find()->all();
      $dhl=Json::encode($dhl1);
        foreach(Yii::$app->user->identity->deliveryAddresses as $k => $delivery):
                        if($k==0){
                            $zone=$delivery->country->zone;
                        }
        endforeach;
if($zone!=0){
$first_shipping=Dhl::find()->where(['kg'=>$total_weight,'zone'=>$zone])->one();
// $shipping=$first_shipping->value;
$shipping=0;
}else{
$shipping=0;
}
}


$script=<<< JS
$(document).ready(function() {
    var dhl=$dhl;
    var total_weight=$total_weight;
    var cost=$cost;
    var tax=$impuesto;
    $("#paypal").on("click", function(e){
    $("form").attr("action","../shop/paypal").submit();
    });
    $("#billing_id").change(function(){
        var id= $(this).val();
        var aux= "infob-";
        $("[class^="+aux+"]").hide();
        $(".infob-"+id).show();
    });
    $("#delivery_id").change(function(){
        var id= $(this).val();
        var aux= "infod-";
        var zone = $('option:selected', this).attr('zone');
        var shipping = 0;
        var dhl_shipping = 0;
        $("[class^="+aux+"]").hide();
        $(".infod-"+id).show();
        if(dhl !=0){
            for (var i = 0; i < dhl.length; i++){
              if (dhl[i].kg == total_weight && dhl[i].zone==zone){
                dhl_shipping=dhl[i].value;
              }
            }
        }
        console.log(zone);
        if(zone!=0){
            shipping=dhl_shipping;
        }else{
            shipping=25;
        }
          $("#shipping2").html('$'+shipping);
          $("#shipping").val(shipping);
          total=shipping+cost+tax;
          $("#subtotal").val(total);
          $("#subtotal2").html('$'+total);
    });
    $(".change_q").change(function(){
        var aux2= $(this).val();
        var aux= $(this).attr("posid");
        $.get( "updatefromcart", { id: aux, quantity: aux2 } )
          .done(function( data ) {
            alert( "Data Loaded: " + data );
          });
        
    });
});
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<section  class="row">
  <?= $this->render('sidebar') ?>
  <div class="Absolute-Center is-Responsive">
  	<div class="cont-titulos" style="text-align: center;">
      	<h3><?= Yii::t('bag', 'Shopping Cart') ?></h3>
  	</div>
    <div class="cont-formulario">
      <?php $form = ActiveForm::begin(['action' => ['shop/paypal'],'options' => ['method' => 'post']]); ?>
      <div class="table-responsive hidden-xs">
    		<table class="table">
          <thead>
            <tr>
              <th><?= Yii::t('bag', 'Product') ?></th>
              <th><?= Yii::t('bag', 'Description') ?></th>
              <th><?= Yii::t('bag', 'Quantity') ?></th>
              <th><?= Yii::t('bag', 'Unit Price') ?></th>
              <th><?= Yii::t('bag', 'Value') ?></th>
              <th><?= Yii::t('bag', 'Delete') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach(Yii::$app->cart->positions as $position){
                echo $this->render('_cart_item',['position'=>$position]);
              }
            ?>      
          </tbody>
          <tfoot>
    <!--                 <tr>
              <th colspan="4">
              <?= Yii::t('bag', 'Shipping') ?>:
              </th>
              <td  style="text-align: right;" id="shipping2">
              $<?= $shipping ?>
              </td>
              <td></td>
              </tr> -->
              <tr>
              <th colspan="4">
              Subtotal:
              </th>
              <td  style="text-align: right;" id="subtotal2">
              $<?= Yii::$app->cart->getCost(true) ?>
              </td>
              <td></td>
              </tr>
              <tr>
              <th colspan="4">
              IVA(12%):
              </th>
              <td  style="text-align: right;" id="subtotal2">
              $<?= $impuesto ?>
              </td>
              <td></td>
              </tr>
              <tr>
              <th colspan="4">
              Total:
              </th>
              <td  style="text-align: right;" id="subtotal2">
              $<?= Yii::$app->cart->getCost(true)+$impuesto+$shipping ?>
              </td>
              <td></td>
              </tr>
          </tfoot>
        </table>
      </div>
      <div class="shopping-cart visible-xs">

        <div class="column-labels">
          <label class="product-image"><?= Yii::t('bag', 'Product') ?></label>
          <label class="product-details"><?= Yii::t('bag', 'Description') ?></label>
          <label class="product-price"><?= Yii::t('bag', 'Unit Price') ?></label>
          <label class="product-quantity"><?= Yii::t('bag', 'Quantity') ?></label>
          <label class="product-removal"><?= Yii::t('bag', 'Delete') ?></label>
          <label class="product-line-price"><?= Yii::t('bag', 'Value') ?></label>
        </div>
        <?php
          foreach(Yii::$app->cart->positions as $position){
            echo $this->render('_cart_item_mobile',['position'=>$position]);
          }
        ?>  
        <div class="totals row">
          <div class="totals-item">
            <label>Subtotal: </label>
            <div class="totals-value" id="cart-subtotal">$<?= Yii::$app->cart->getCost(true) ?></div>
          </div>
          <div class="totals-item">
            <label>IVA (12%): </label>
            <div class="totals-value" id="cart-tax">$<?= $impuesto ?></div>
          </div>
<!--           <div class="totals-item">
            <label>Shipping</label>
            <div class="totals-value" id="cart-shipping">15.00</div>
          </div> -->
          <div class="totals-item totals-item-total">
            <label>Total: </label>
            <div class="totals-value" id="cart-total"> $<?= Yii::$app->cart->getCost(true)+$impuesto+$shipping ?></div>
          </div>
        </div>
      </div>
      <input id="subtotal" type="hidden" name="subtotal" value="<?= Yii::$app->cart->getCost(true)+$impuesto+$shipping ?>" />
      <input id="shipping" type="hidden" name="shipping" value="<?= $shipping ?>" />
     	<?php if(!Yii::$app->user->isGuest): ?>
        <div id="cont-direccion">
          <div class="direc-50">
              <h3><?= Yii::t('bag', 'Choose delivery information') ?>:</h3>
              <select id="delivery_id" name="delivery" class="selectpicker" data-style="combo-select" >
                  <option value="" disabled><?= Yii::t('bag', 'Select Option') ?></option>
                  <?php foreach(Yii::$app->user->identity->deliveryAddresses as $k => $delivery):
                      if($k==0){
                          $address= $delivery->address_line_1." ".$delivery->address_line_2;
                          $number= $delivery->zip;
                          $city = $delivery->city;
                          $sector= $delivery->country->country_name;
                      }   
                   ?>
                  <option value="<?= $delivery->id ?>" zone="<?= $delivery->country->zone ?>"><?= $delivery->zip ?></option>
                  <?php endforeach; ?>
              </select>
              <div class="info-faturacion">
              <?php foreach(Yii::$app->user->identity->deliveryAddresses as $k => $delivery): ?>
                <?php if($k!=0){ $display2="none"; }  ?>
                
                  <div class="infod-<?= $delivery->id ?>" style="display:<?= $display2; ?>">
                      <strong><?= Yii::t('bag', 'Address') ?>:</strong><div id="billing_address"><?= $delivery->address_line_1." ".$delivery->address_line_2 ?>.</div>
                      <strong><?= Yii::t('bag', 'Zip Code') ?>:</strong><div id="billing_number"><?= $delivery->zip ?></div>
                      <strong><?= Yii::t('bag', 'City') ?>:</strong><div id="billing_city"><?= $delivery->city ?></div>
                      <strong><?= Yii::t('bag', 'Country') ?>:</strong><div id="billing_sector"><?= $delivery->country->country_name ?></div>
                  </div>
                  
              <?php endforeach; ?>
                  <span><?= Yii::t('bag', 'If you do not have Delivery address') ?>. <a href="<?= Url::to(['user/address']) ?>"><?= Yii::t('bag', 'Come Here') ?></a></span>
              </div>
          </div>
        	<div class="direc-50">
            	<h3><?= Yii::t('bag', 'Choose billing information') ?>:</h3>
                <select id="billing_id" name="billing" class="selectpicker" data-style="combo-select" >
                	<option value="" disabled><?= Yii::t('bag', 'Select Option') ?></option>
                    <?php foreach(Yii::$app->user->identity->billingAddresses as $k => $billing):  ?>
                    <option value="<?= $billing->id ?>"><?= $billing->zip ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="info-faturacion">
                <?php foreach(Yii::$app->user->identity->billingAddresses as $k => $billing): ?>
                  <?php if($k!=0){ $display="none"; }  ?>
                  
                    <div class="infob-<?= $billing->id ?>" style="display:<?= $display; ?>">
                        <strong><?= Yii::t('bag', 'Address') ?>:</strong><div id="billing_address"><?= $billing->address_line_1." ".$billing->address_line_2 ?>.</div>
                        <strong><?= Yii::t('bag', 'Zip Code') ?>:</strong><div id="billing_number"><?= $billing->zip ?></div>
                        <strong><?= Yii::t('bag', 'City') ?>:</strong><div id="billing_city"><?= $billing->city ?></div>
                        <strong><?= Yii::t('bag', 'Country') ?>:</strong><div id="billing_sector"><?= $billing->country->country_name ?></div>
                    </div>
                    
                <?php endforeach; ?>
                    <span><?= Yii::t('bag', 'If you do not have Billing address') ?>. <a href="<?= Url::to(['user/address']) ?>"><?= Yii::t('bag', 'Come Here') ?></a></span>
                </div>
            </div>

            <h3><?= Yii::t('bag', 'Observation') ?>:</h3>
            <textarea name="observation" rows="4" cols="50" style="width:100%" placeholder="<?= Yii::t('bag', 'Any extra explanation or requirements you may need can be written here.') ?>"></textarea>
        </div>
      <?php endif; ?>
  		<div class="cont-fpago">
          <p><?= Yii::t('bag', 'By continuing you are accepting shipping and privacy policies.') ?></p>
          <p>Después de su compra, en un plazo de tres días laborables le enviaremos un mail con la tarifa de envío y tiempo de entrega de su pedido.</p>
          <h3><?= Yii::t('bag', 'Pay With') ?>:</h3>
         
          	<a id="paypal" href="#" class="btn-pago"><img class="paylogo" src="<?= URL::base() ?>/images/tarjetas.png" /></a>
                 
      </div>
          	<!-- <input type="submit" value="PAGAR AHORA"/> -->
      <?php ActiveForm::end(); ?>
          
    </div>
  </div>
</section>


<!-- -->