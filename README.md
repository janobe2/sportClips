# SportClips

Ein Projekt im Auftrag von der Kantonsschule Frauenfeld, in dem man Videos hochladen, verwalten und anschauen kann.

## Installation

Bevor die Webseite genutzt werden kann, müssen noch ein paar Einstellungen angepasst werden.

### Server

In diesem Beispiel wird von einem XAMPP Server ausgegangen.
Dieser kann kostenlos von folgender Webseite runtergeladen werden.

[XAMPP](https://www.apachefriends.org/de/download.html) -> Version 7.2 oder höher!


### Servereinstellungen

Nach der Installation des Xampp-Servers muss noch eine Einstellungen abgeändert werden. Dazu öffnen Sie die **php.ini** Datei. Diese befindet sich in folgendem Ordner:

```
/Pfad/zu/xampp/php/php.ini
```

Suchen Sie nach folgenden Einstellungen und ändern Sie die Werte wie folgt:

```
file_uploads = On
```
```
post_max_size = 0
```
Folgende Grösse bestimmt, wie gross die Videos sein können, die hochgeladen werden. Sie können diese Zahl beliebig anpassen.
Achten Sie darauf, dass das grosse **M** direkt nach der Zahl kommt. Es darf kein Leerzeichen dazwischen haben.
```
upload_max_filesize = 999M
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

Laden Sie die Webseite herunter und entpacken Sie den Ordner. Öffnen Sie den entpackten Ordner und verschieben Sie den sich darin befindeten Ordner in folgendes Verzeichnis:

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

Es gibt beim erstellen der Seite nur einen Account, und zwar den Admin Account.
```
Benutzername:   admin
Passwort:       admin
```
Viel Spass!
