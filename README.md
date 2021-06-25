# **Hutsgames**

Hutsgames is een schoolproject van Luuk, Tim, Mika en Stan.

**Hoe installeer je het?**
Wij hebben apache2 met een MariaDB server op een Ubuntu VPS gebruikt.
Omdat dit niet altijd even makkelijk op te zetten is, is de website ook te bezoeken op https://hutsgames.stanexe.com/

We hebben veel verschillende PHP functies geïmplementeerd, bijvoorbeeld:
- De wachtwoorden worden gehashed, op die manier komen bij een eventuele Database leak de wachtwoorden niet open en bloot te liggen. Hiervoor wordt zelfs gebruik gemaakt van een salt, zodat zogenoemde 'Rainbow Tables' ook niet meer werken.
- Het registreren op de site werkt volledig
- Het inloggen op de site werkt volledig
- De mogelijkheid is er om een comment achter te laten op de main page, deze wordt vervolgens voor iedereen onder aan de website gedisplayed
- Het hele proces is vastgelegd, hier op GitHub. We hebben met branches gewerkt zodat iedereen aan zijn eigen stuk kon werken en we elkaar niet in de weg zaten.
