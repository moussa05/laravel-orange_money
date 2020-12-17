

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<form method="POST" action="https://api.paiementorangemoney.com"id="myform">
    <input type="hidden" name="S2M_IDENTIFIANT" value="<?php echo $S2M_IDENTIFIANT;?>" >
    <input type="hidden" name="S2M_SITE" value="<?php echo $S2M_SITE;?>">
    <input type="hidden" name="S2M_TOTAL" value="<?php echo $S2M_TOTAL;?>">
    <input type="hidden" name="S2M_REF_COMMANDE" value="<?php echo $S2M_REF_COMMANDE;?>">
    <input type="hidden" name="S2M_COMMANDE" value="<?php echo  $S2M_COMMANDE;?>">
    <input type="hidden" name="S2M_DATEH" value="<?php echo $S2M_DATEH;?>">
    <input type="hidden" name="S2M_HTYPE" value="<?php echo $S2M_HTYPE;?>">
    <input type="hidden" name="S2M_HMAC" value="<?php echo $S2M_HMAC;?>">
</form>
<script type="text/javascript">
  document.getElementById("myform").submit();
</script>

