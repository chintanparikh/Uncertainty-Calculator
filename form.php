
<center>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" name="UncertaintySolver">

<input type="text" name="N1" value="FirstNumber" onclick="N1.value='';"/> ± <input type="text" name="U1" value="FirstUncertainty" onclick="U1.value='';" />
<br /><br />

<select name="oper">
<option>+</option>
<option>-</option>
<option>*</option>
<option>/</option>
</select>

<br /><br />
<input type="text" name="N2" value="SecondNumber" onclick="N2.value='';"/> ± <input type="text" name="U2" value="SecondUncertainty" onclick="U2.value='';" />

<br /><br />
  Round to how many decimal places?
  <input type="text" name="decp" value="3" onclick="decp.value='';" />

<br /><br />
<input type="submit" name="submitted" value="Work it out!" />
</center>