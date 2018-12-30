# SportClips

Ein Projekt im Auftrag von der Kantonsschule Frauenfeld, in dem man Videos hochladen, verwalten und anschauen kann.

## Installation

Bevor die Webseite genutzt werden kann, muss noch was angepasst werden.

### Server

In diesem Beispiel wird von einem XAMPP Server ausgegangen.
Dieser kann kostenlos von folgender Webseite runtergeladen werden.

[XAMPP](https://www.apachefriends.org/de/download.html) -> Version 7.2 oder höher!


### Servereinstellungen

Nach der Installation des Xampp-Servers muss noch eine Einstellung abgeändert werden. Dazu öffnen Sie die **php.ini** Datei. Diese befindet sich in folgendem Ordner:

```
/Pfad/zu/xampp/php/php.ini
```

Diese Datei kann mit jedem beliebigen Editor geöffnet und bearbeitet werden.
Nehmen Sie folgende Änderung vor:

Entfernen Sie **;** von folgender Einstellung:
```
;extension=sqlite3
```
Muss dann so sein:
```
extension=sqlite3
```

### Einbindung der Webseite

Laden Sie die Webseite herunter und entpacken Sie den Ordner.
Verschieben Sie den heruntergeladenen Ordner in folgendes Verzeichnis:

```
/Pfad/zu/xampp/htdocs/
```

**Achtung:** Falls Sie Veränderung an der Namensgebung des Ordners vornehmen, müssen Sie diese auch in der Applikationseinstellung übernehmen.
Bearbeiten Sie dazu folgende Datei:

```
/Pfad/zu/xampp/htdocs/NameIhresVerzeichnisses/db/preferences.ini
```
Vermeiden Sie Leerschläge, Umlaute oder andere ähnliche Zeichenformen. 

Beispiel:
```
Neuer Name des Verzeichnisses: sportVideos
```
Muss dann so in der preferences.ini Datei aussehen: 
```
[path]
path = "/sportVideos/"

[php]
upload_size = 1000
max_files_at_once = 20
post_size = 1500
```
Bei nicht Änderung des Ordnernamens, müssen Sie hier keine Einstellungen ändern.

### Sie sind bereit!

Nun sind Sie nur noch einen Schritt vor der Fertigstellung der Vorarbeiten entfernt. Das einzige was Sie noch tun müssen, ist den Server zu starten. 
Öffnen Sie dazu Xampp und starten Sie **Apache**.

Um Ihre Seite aufzurufen, gehen Sie in einen beliebigen Browser und tippen Sie folgendes in die Suchleiste:

```
localhost/NameIhresVerzeichnissesInXampp/
```
Danach sollten Sie auf der Login - Seite landen.
Sie können anfangen die Seite zu benutzen.

Viel Spass!
