<?php
function BS($item,$a,$l=0,$h=null){
  $h=($h===null)?count($a):$h;
  $m=intdiv(($h+$l),1<<1);
  if($l>= $h)return false;
   if($item == $a[$m]) return $m;
     elseif ($item<$a[$m]) {
        return BS($item, $a, $l, $m);
    } else BS($item,$a,$m+1,$h);
}
