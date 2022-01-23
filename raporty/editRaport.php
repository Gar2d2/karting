<?php
$sekcjaDAO = new sekcjaDAO();
                 $sekcje = $sekcjaDAO->pobierzSekcjeDlaRaportu($_GET['rid']);
                 $sekcja;
                 $osobaDAO = new OsobaDAO();
                 $osoba = $osobaDAO->pobierzOsobePoPseudonimie($_SESSION['login']);
                 $osobaID = $osoba->id;
                 if(count($sekcje) > 0)
                 {
                 foreach($sekcje as $s)
                 {

                  if($s->idOsoby == $osobaID)
                  {
                   $sekcja = $s;
                  }
                 }
                 print("<table border='1'>
                              <tbody>
                                <tr>
                                  <td colspan='3'>Edytuj raport</td>
                                </tr>
                                <tr>
                                  <form action='' method='get'>
                                  <td><input readonly name='sid' type='text' value='$sekcja->id'/></td>
                                  <td><input name='tytul' type='text' value='$sekcja->tytul'/></td>
                                  <td><textarea name='tresc' style='height: 500px; width: 1000px'>$sekcja->tresc</textarea></td>
                                </tr>
                                <tr>
                                  <td colspan='3'><input name='saveRaport' type='submit' value='Zapisz zmiany' /></td>
                                </tr>
                                </form>
                              </tbody>
                            </table>");    
                 }
?>
