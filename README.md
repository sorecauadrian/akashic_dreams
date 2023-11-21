# akashic dreams - lucrare de atestat profesional la informatică

Colegiul Național "Liviu Rebreanu", Bistrița, 2022

Candidat, **Șorecău Adrian-Vasile**, Clasa a XII-a B

Profesor coordonator, **Candale Silviu Titus**

## Argument

Mereu am fost fascinat de vise, de ce se întâmplă la nivel neurologic și
spiritual în momentul în care dormim. Astfel, interesul meu pentru lumea
viselor a început să crească în mod deosebit după ce am avut un vis
lucid (un vis pe care îl puteam controla fiind conștient că visam).
Voiam să retrăiesc experiența de a avea libertate și control deplin.
Astfel, am aflat de jurnalele de vise, care te ajută să visezi lucid
prin identificarea unor secvențe care se repetă în vise.

După aproximativ jumătate de an de scris pe hârtie visele pe care le
aveam, am experimentat doar 6 vise lucide și semi-lucide. Mai apoi am
aflat de la un prieten de o aplicație în care îți poți înregistra visele
(Lucid -- Dream Journal) și de data aceasta chiar s-au văzut rezultate.
Pe lângă faptul că reușeam să visez lucid mai des, mai aveam și o listă
cu vise pe care le puteam analiza singur, găsindu-le semnificații.

Aplicația Web "akashic dreams" a fost creată din dorința de a îmbunătăți
aplicația pe care o folosesc deja ca jurnal de vise. Deși aplicația îmi
satisface dorințele, cred că ar putea fi îmbunătățită, adăugând mai
multe facilități și statistici.

Inițial, am vrut să o dezvolt ca o aplicație mobilă, dar în clasa a
XII-a am învățat să lucrez cu PHP și SQL și astfel am dezvoltat-o ca o
aplicație web, dorind ca pe viitor să cumpăr domeniul
*akashic-dreams.com* și să extind aplicația pentru a putea fi folosită
de cât mai multe persoane.

Consider că lumea ar trebui să afle mai multe despre potențialul viselor
și despre câte se pot face în timpul somnului (Nikola Tesla, Salvador
Dali, Leonardo DiCaprio, Stephen King și Srinivasa Ramanujan ar fi
câteva genii care se foloseau de visele lucide pentru a veni cu idei noi
și pentru a studia cât timp se odihnesc).

Provocări cum ar fi partea de Frontend, sistemul de adăugare a unui vis
sau chiar sistemul de autentificare și înregistrare au fost o motivație
să continui munca deoarece știam că învăț multe lucruri noi exersând și
aplicația va merge în direcția cea bună.

## Prezentarea aplicației

Aplicația Web "akashic dreams" este dedicată celor ce vor să intre în
lumea viselor lucide sau pur și simplu vor să țină evidența viselor.

Aplicația are 3 pagini vizibile de utilizator: cea de înregistrare și
autentificare a utilizatorului, cea a jurnalului, în care utilizatorul
poate să-și vizualizeze visele personale și caracteristici ale acestora
și cea în care adaugă un vis.

În momentul intrării pe site, utilizatorul este direcționat pe pagina de
autentificare și înregistrare, în care poate fie să-și creeze un cont
nou, fie să se autentifice cu unul deja existent.

![](media/image1.png){width="6.5in" height="3.1770833333333335in"}

După autentificare, utilizatorul este redirecționat pe pagina
principală, unde se află jurnalul propriu-zis, alături de un buton de
deconectare și unul de adăugare a visului. Visele pot fi vizualizate
într-un modal, alături de caracteristicile acestora. Visele lucide au un
fundal albastru, cele semi-lucide albastru-transparent, iar cele deloc
lucide au fundal transparent.

![](media/image2.png){width="6.5in" height="3.1666666666666665in"}

În pagina de adăugare a visului, utilizatorul este rugat să completeze
următoarele câmpuri: data, titlul și descrierea visului, precum și
calitatea somnului, cât de bine își amintește visul, starea pe care o
avea după vis și cât de lucid a fost acesta. În urma completării tuturor
câmpurilor, visul și statisticile visului vor putea fi vizualizate în
pagina principală.

![](media/image3.png){width="6.5in" height="3.1277777777777778in"}

## Elemente de conținut

Aplicația Web *akashic dreams* este construită utilizând limbajele de
programare:

> \- **PHP** pentru interacțiunea paginii web cu baza de date.

\- **JavaScript** pentru interacțiunea dinamică a paginii web cu
utilizatorul.

De asemenea, am folosit librăriile:

\- **Bootstrap 5** pentru aspectul aplicației web.

\- **jQuery** pentru o sintaxă mai îngrijită și mai rapidă în scrierea
codului JavaScript.

\- **FontAwesome** pentru includerea iconițelor în site.

Baza de date a aplicației web este alcătuită din 2 tabele care
interacționează între ele în timpul utilizării aplicației.

\- Tabela *users* conține date legate de utilizatorii site-ului.

\- **id** -- cheia primară.

\- **username** -- numele utilizatorului.

\- **password** -- parola criptată.

\- **created\_at** -- data creării contului.

\- Tabela *dreams* conține date legate de visele utilizatorilor.

\- **id** -- cheia primară.

\- **id\_user** -- id-ul utilizatorului care postează visul.

\- **date\_time** -- data publicării visului.

\- **title** -- titlul visului.

\- **story** -- descrierea visului.

\- **sleep\_quality** -- calitatea somului, pe o scară de la 1 la 5.

\- **clarity** -- claritatea visului, pe o scară de la 1 la 5.

\- **mood** -- starea de spirit în urma visului, pe o scară de la 1 la
5.

\- **lucidity** -- luciditatea visului, pe o scară de la 1 la 3 (1 --
deloc lucid, 2 -- semi-lucid, 3 - lucid).

Codul sursă al aplicației este împărțit în 4 foldere categorizate și 2
documente PHP principale, anume **index.php** și **db\_connection.php**.

\- **index.php** este fișierul care gestionează afișarea paginilor web.
Folosindu-ne de paginile din folder-ul "pages", fișierul index.php
include paginile cerute prin metoda **GET**, având grijă să nu fie
accesate decât anumite pagini.

\- **db\_connection.php** realizează conexiunea cu baza de date.

Folder-ul *pages* conține singurele pagini la care utilizatorul are
acces.

\- pagina **login\_signup** are ca scop crearea unui cont sau conectarea
la unul deja existent. Datele sunt verificate prin intermediul
funcțiilor PHP și JavaScript.

\- pagina **main** este pagina principală în care visele sunt afișate.

\- pagina **add\_dream** ajută la adăugarea unui nou vis în baza de
date. Datele sunt verificate prin intermediul funcțiilor PHP și
JavaScript.

\- pagina **logout** are ca rol deconectarea utilizatorului și ștergerea
datelor legate de utilizator din vectorul **\$\_SESSION**.

\- pagina **404** este pagina la care este direcționat utilizatorul în
cazul în care accesează un fișier la care nu are acces.

![](media/image4.PNG){width="6.5in" height="3.428472222222222in"}

Folder-ul *module* conține următoarele fișiere:

\- **navbar.php** care conține bara de navigare a paginii principale, în
care este inclus logo-ul, alături de un buton de ștergere al contului și
unul de deconectare.

\- **variables.php** care conține variabile, folosite în majoritatea
paginilor.

\- **functions.php** conține funcții PHP care ajută la interacțiunea cu
baza de date.

Folder-ul *javascript* conține un fișier cu funcții care modifică
dinamic conținutul paginilor la interacțiunea aplicației web cu
utilizatorul. ![](media/image5.PNG){width="6.5in"
height="3.373611111111111in"}

Folder-ul *css* conține un fișier cu proprietăți ale anumitor elemente
HTML, iar alături de librăriile *Bootstrap 5* și *FontAwesome*
alcătuiesc stilul website-ului. ![](media/image6.PNG){width="6.5in"
height="2.1215277777777777in"}

**Un mare avantaj al aplicației este faptul că este compatibilă cu orice
device. Adică este funcțională și are un aspect plăcut atât pe un
laptop, cât și pe o tabletă sau un telefon.**

Posibilități de dezvoltare

Securitatea este un punct slab al aplicației la momentul de față. Până
și cele mai banale injecții SQL ar putea ajunge la baza de date. Aceasta
ar putea fi îmbunătățită cu ajutorul funcțiilor de validare a inputului
în JavaScript, cât și în PHP.

Înregistrarea și autentificarea cu ajutorul email-ului. Aceasta se poate
realiza prin adăugarea, în primul rând, a unui câmp nou în tabela cu
utilizatori, iar în al doilea rând printr-o verificare asemănătoare cu
cea a username-ului, dar asta ar presupune câte 2 verificări individuale
per autentificare.

Modalitatea de recuperare a parolei. Aceasta se poate face printr-o
verificare prin email, iar după confirmarea identității, utilizatorul va
putea să-și modifice parola.

Modalitatea de a contacta administratorul site-ului prin email. Aceasta
se poate realiza prin introducerea unui formular în care utilizatorul
își va scrie mesajul, iar serverul va trimite prin email mesajul
transmis administratorului.

Editarea viselor. Aceasta se poate realiza prin adăugarea unui buton în
modalul fiecărui vis (fiecărei postări), iar la apăsarea acestuia datele
afișate să se schimbe în input-uri cu valorile inițiale, iar la apăsarea
unui alt buton, datele să se modifice în baza de date.

Ștergerea tuturor viselor. Aceasta se poate realiza printr-un buton și o
comandă SQL care să șteargă toate visele cu id-ul utilizatorului.

O pagină de profil a utilizatorului, în care să-și poată personaliza
profilul (poza de profil, modificarea email-ului, a parolei, a
username-ului).

O pagină de statistici prin care se urmărește calitatea somnului,
claritatea acestuia, starea de după somn și luciditatea pe perioade de o
săptămână, o lună și un an. Aceasta ar presupune grafice și analiza
bazei de date.

O modalitate de a găsi anumite vise prin intermediul unui search bar.
Aceasta ar presupune o căutare a cuvintelor scrise în tabela cu vise.

## Bibliografie

Aplicația a fost realizată cu ajutorul cunoștințelor dobândite în
decursul clasei a XII-a la orele de informatică și al diferitelor
site-uri care oferă răspunsuri sau tutoriale la în domeniul web, cum ar
fi:

StackOverflow - <https://stackoverflow.com/>

Youtube - <https://www.youtube.com/>

TutorialRepublic - <https://www.tutorialrepublic.com/>

MDBootstrap - <https://mdbootstrap.com/>

W3Schools (PHP) - <https://www.w3schools.com/php/>

PHP.net - <https://www.php.net/>

De asemenea, au fost folosite următoarele librării:

Bootstrap 5 - <https://getbootstrap.com/docs/5.0/>

jQuery - <https://jquery.com/>

FontAwesome - <https://fontawesome.com/>

Și nu în ultimul rând, o contribuție majoră la crearea site-ului au
avut-o și site-urile specializate în design-ul site-urilor, crearea
logo-urilor și alegerea paletelor de culori:

Coolors - <https://coolors.co/>

Naldz Graphics - <https://naldzgraphics.net/>



Free Frontend - <https://freefrontend.com/>

Canva - <https://www.canva.com/>
