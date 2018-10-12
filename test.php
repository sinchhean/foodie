<?php
//関係ない////////////////////
/*
function isHiragana($str) {
    return preg_match('/[\x{3040}-\x{309F}]/u', $str) > 0;
}
if(isHiragana("a")){echo 'hira';}else{echo 'not hira';}
echo "<br>";
*/
///////////////////////////






?>

<style>
*{
	padding:0;
	margin:0;
}

.menu{ 
	background: #aaa;
	position: fixed;
	height: 100%;
	width: 270px;
} 
.right{
	margin-left: 272px;
	background: #ddd;
}
.right{ 
	display: grid;
	grid-template-rows: 1fr 1fr;
	grid-template-columns: 1fr 1fr;
	grid-gap: 1em;
} 
.right> .lower{
	background: blue;
	
}
.right > .upper{
	background: red;
}
</style> 
<div class="menu">
haaaaaaaaaaaaaaaaaa
</div>
<div class="right">
<div class="upper">hello2</div>
<div class="lower">hello3</div>
</div>

