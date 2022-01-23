<?php
$sekcjaDAO = new sekcjaDAO();
                 $sekcje = $sekcjaDAO->pobierzSekcjeDlaRaportu($_GET['rid']);
                 $sekcja = null;
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
                 if($sekcja)
                 {
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
                 else
                 {
                   print("<script>
                          window.alert('Twoja czesc nie została jeszcze utworzona, zostaniesz przeniesiony do widoku dodawania swojej czesci');
                        </script>");
                 }
                 print("<a id='usun' href='index.php?addRaport=Dodaj+nowy+raport' class='btn btn-primary'>Usuń"); 
                }
?>
<script>
      document.getElementById("usun").click();
</script>