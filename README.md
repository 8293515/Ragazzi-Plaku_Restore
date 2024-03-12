# Ragazzi&Plaku_Restore
 Progetto di informatica
 La parte del codice di sceltaspecie è commentata un po' più delle altre (è leggermente più difficile entrare nella logica ma i commenti dovrebbero bastare).
 Tutti i js sono commentati piuttosto bene.
 Le pagine php sono commentate in ordine alfabetico, nel senso che le prime sono commentate abbastanza e poi in realtà è un ripetersi delle pagine ma in formule diverse
 per cui la logica è più o meno analoga cambia solo lo scopo,ci sono comunque alcuni commenti sporadici qui e lì in alcune pagine.
 Ho utilizzato query parametrizzate in molte delle query (anche quando effettivamente non era necessario).
 Ho utilizzato molto ajax perché ormai sono un tutt'uno con ajax e mi veniva naturale utilizzarlo anche quando non era strettamente necessario dopo averne fatti diversi.
 Home fatta con WebFlow, che è un sito che ti permette di gestire la parte grafica tramite un'interfaccia, dopo aver fatto la home abbiamo notato che non faceva
 molto al caso nostro.
Alcune del css fatto con webflow lo abbiamo adattato e riutilizzato in altre pagine e abbiamo provato a mantenere un po' lo stile dei nomi delle classi(per questo ci sono molti nomi strani e classi composte).
 95% del css by Don Plaku Malato.

Nuove e varie tecnologie utilizzate:
setTimeout(function()){  ---> La funzione serve a ritardare l'esecuzione di una determinata
    blabla                    parte di codice, l'ho utilizzata nel navjs per dare un minimo
},500);                       di animazione alla chiusura del modal di login.

base64_encode(blob immagine preso dal database) ----> utilizzata ogni volta che si deve recuperare un'immagine blob dal database,
                                                      serve a convertire l'immagine binaria memorizzata nel blob in una stringa base64,
                                                      questa poi viene utilizzata per essere concatenata con "data:image/jpeg;base64" 
                                                      per formare l'url completo dell'immagine da visualizzare in html, senza questo
                                                      il dato non è passabile tramite json al javascript e non si visualizzerebbe comunque
                                                      come immagine su html perché sarebbero solo dati binari
                                                        
$variableX = getimagesizefromstring(datibinariimmagine); ----> La funzione getimagesizefromstring prende una stringa contenente dati di un'immagine 
$variabileY= $variabileX['mime'];                              e restituisce un array di informazioni sull'immagine. La funzione restituisce   
                                                                un array associativo che contiene informazioni come larghezza, altezza, tipo di immagine (MIME), e altro.
                                                                Io l'ho utilizzata in alcune pagine per poterla concatenare con "data:image/variabileY;base64" in caso tipo
                                                                ci fossero png e quindi la parte dell'estensione dell'immagine doveva essere variabile , dopo non molto 
                                                                ho però scoperto che anche mantenendo la parte dell'estensione come jpeg fissa le immagini anche di altre estensioni
                                                                tipo png venivano visualizzate correttamente quindi non l'ho più utilizzato.
 
header('Content-Type: application/json');      ----> Quando un client fa una richiesta a un server, l'header Content-Type specifica il tipo di media della risposta. In questo caso, 
                                                     application/json indica che il contenuto della risposta è in formato JSON.
                                                     L'ho usato per risolvere un'errore con il json e ho scoperto che è una pratica comune per indicare il tipo di contenuto della risposta e consentendo al client l'interpretazione corretta del JSON quindi l'ho sempre usato quando ho utilizzato json
                                                     (potrebbe essere che magari non l'ho usato ovunque e dato che non mi ha dato errori non l'ho nemmeno notato, non mi pare però)

echo json_encode(variabile/array);             ----> La funzione json_encode() in PHP viene utilizzata 
                                                     per convertire una variabile o   un array PHP in una stringa JSON. 
                                                     L'ho utilizzata nelle chiamate ajax per passare i dati dal server al client.

xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                    ----> serve a impostare l'intestazione (header) HTTP per la richiesta XMLHttpRequest con il tipo di contenuto "application/x-www-form-urlencoded". Questo indica al server come interpretare i dati inviati nella richiesta.
                                                    Questa è una forma comune di codifica dei dati in cui i dati sono formattati come coppie chiave-valore, separate da "&", e i caratteri speciali sono codificati in modo appropriato (ad esempio, gli spazi diventano "%20").

encodeURIComponent(nomevariabile);  ---->       La funzione encodeURIComponent viene utilizzata per codificare correttamente il valore
                                                della variabile.L'ho utilizzato per inviare con l'xhr.send() per inviare un dato insieme
                                                al corpo della richiesta al server.

Spiegazione elementi particolari by Don Plaku:
Stili particolari utilizzati(che magari è meglio spiegare):
grid-template-columns: Questa proprietà definisce il numero e la dimensione delle colonne nella griglia.
grid-template-rows:   Stessa cosa ma per le righe

repeat(auto-fit, minmax(200px, 1fr)): Questo è un valore specifico per la definizione delle colonne o righe.

auto-fit: Questo è un valore della funzione repeat() che dice al browser di regolare automaticamente il numero di colonne in modo 
                che esse si adattino alla larghezza del contenitore.          
                In altre parole, il browser cercherà di inserire il massimo numero di colonne da 
                200 pixel ciascuna nella larghezza disponibile del contenitore. Al posto di autofit si possono inserire in numero voluto di colonne/righe.

  
minmax(200px, 1fr): Questo indica che la larghezza minima di ogni colonna sarà di 200 pixel, mentre la larghezza massima sarà il massimo possibile
                    (1fr indica la frazione di spazio rimasto). Quindi, se c'è abbastanza spazio, le colonne si espanderanno in modo uniforme fino a occupare tutto lo spazio disponibile.

Classe custom-btn / Classe btn-4:after / Classe btn-4 span:after(il bottone adotta particolare):
                            Sono classi per definire il contenuto del pulsante, 
                            la posizione/alineamento del pulsante e la transizione dell'ombra del pulsante per generare l'effetto di pressione.

Classe btn 4 / btn 4:hover:La prima classe imposta con un colore base il pulsante (background color) e poi da una tonalità lineare, quasi sfumata al pulsante tramite 
                            "gradient". all'interno della parentesi vengono definiti l'angolo da cui parte (in questo caso da basso a sinistra verso l'alto a destra), il colore principale e il colore secondario che caratterizzerà la sfumatura per il 74% della lunghezza lineare del pulsante.
                            Tutte le classi after e before sono complementari con hover:after e hover:before per permettere la transizione con lo spostamento del cursore sopra il pulsante 

Immagine della Home a Sinistra in Sovrimpressione del riquadro nero:
                            Display flex nella classe shop-local-wrapper ci assicura che il riquadro nero sia in centro
                            La posizione dell'immagine si gestisce con attributi top bottom left e right in shop-local-left (la gestiamo manualmente)
                            L'immagine si sovvrasta nella classe shop local left con l'attributo position: absolute.
 
Banner Home "I Parchi":
                            Nella sezione Save Wrapper gli elementi vengono messi nel lato destro con "flex-direction:column" che serve a 
                            specificare come i flex item vengono posizionati , tutti gli elementi all'interno del Save Wrapper sono flex grazie
                            a "display:flex" e con "min-height" regoliamo la posizione verticale delle colonne.
