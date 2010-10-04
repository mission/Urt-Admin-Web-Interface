<?php
function bansearchform() {
echo "<form method='post' action=''><table class='container8'><tr><td>
<table width='294'>
  <tr>
  	<td colspan='2'><div align='center' class='style2'><font size='4'><strong>Ban Search</strong></font></div></td>
  </tr>
  <tr>
    <td><div align='right'><span class='style1'>Players Name:</span></div></td>
    <td><input type='text' class='element text large' maxlength='15' name='name' /></td>
  </tr>
  <tr>
    <td><div align='right'><span class='style1'>Players IP:</span></div></td>
    <td><input type='text' class='element text large' maxlength='15' name='ip' /></td>
  </tr>
  <tr>
    <td><div align='right'><span class='style1'>Ban Creator:</span></div></td>
    <td><input type='text' class='element text large' maxlength='15' name='creator' /></td>
  </tr>
  <tr>
    <td></td>
    <td><input type='hidden' name='search' value='0'></td>
  </tr>
  <tr>
    <td colspan='2'>
      <div align='center'>
        <input type='submit' value='Search' />
        </div></td>
  </tr>
</table></td></tr></table>
</form>";

}
?>